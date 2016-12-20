<?php

use Goutte\Client;

class Controller_Testform extends Controller
{
    const HATEB_SEARCH_URL = "http://b.hatena.ne.jp/search/text";
    const HATEB_KEYWORD_PARAMETER = "?q=";
    const HATEB_BOOKMARK_COUNT_50 = "&users=50";

    /**
     * 入力ページに値をセットする
     *
     */
    public function action_index()
    {
        $input_form_object = View::forge("testform/index");

        // 入力値の出力先URLを生成・セット
        $input_form_object->set("result_url", Uri::create("testform/result"));

        return $input_form_object;
    }

    /**
     * @return object フォーム入力値のオブジェクト
     *
     */
    public function action_keyword()
    {
        $keyword_object = View::forge("testform/result");
        $keyword_object->set("keyword", Input::post('keyword'));

        return $keyword_object;

    }

    /**
     * post送信の値を受け取る
     *
     */
    public function action_result()
    {
        echo $this->action_keyword();

        $client = new Client();

        $pages_url = array();

        $pages_url[] = $this::HATEB_SEARCH_URL . $this::HATEB_KEYWORD_PARAMETER . Input::post('keyword') . $this::HATEB_BOOKMARK_COUNT_50;

        // 1ページ目にアクセスする
        $crawler = $client->request('GET', $pages_url[0]);
        sleep(1);

        // 2ページ目以降のGETパラメータを全てスクレイプする
        $next_pages_parameter = $crawler->filter("div.pager a")->extract("href");

        for($i1=0; $i1<count($next_pages_parameter)-1; $i1++)
        {
            // 2ページ目以降のアクセスURLを生成、配列に追加
            $next_pages_url = $this::HATEB_SEARCH_URL . $next_pages_parameter[$i1];
            array_push($pages_url, $next_pages_url);
        }

        // 1ページ目に掲載の 記事URL をスクレイプ
        $article_url = $crawler->filter("h3 a")->extract("href");

        $article_title = array();
        $article_hateb_count = array();

        // 1ページ目の記事URL件数分の タイトル と はてぶ数 をスクレイプ
        for($i3=0; $i3<count($article_url); $i3++)
        {
            $article_title[] = $crawler->filter("h3 a")->eq($i3)->text();
            $article_hateb_count[] = $crawler->filter("span.users a span")->eq($i3)->text();
        }

        for($i2=1; $i2<count($pages_url); $i2++)
        {
            $next_pages_crawler = $client->request('GET', $pages_url[$i2]);
            sleep(1);

            // 2ページ目以降に記載の 記事URL をスクレイプ
            $next_article_urls = $next_pages_crawler->filter("h3 a")->extract("href");

            // 2ページ目以降の記事URL件数分の タイトル と はてぶ数 を取得
            $i3=0;
            foreach($next_article_urls as $next_article_url)
            {
                $next_title = $next_pages_crawler->filter("h3 a")->eq($i3)->text();
                $next_hateb_count = $crawler->filter("span.users a span")->eq($i3)->text();
                $i3++;

                array_push($article_url, $next_article_url);
                array_push($article_title, $next_title);
                array_push($article_hateb_count, $next_hateb_count);
            }

        }

        $all_data = array();

        for($i4=0; $i4<count($article_title); $i4++)
        {
            $aa = $this->db_url($article_url[$i4]);
            if($aa === true)
            {
                //何もしない
            }
            else
            {
                // DBのカラムにスクレイピングデータをセット
                $data = array(
                    'urls'         => $article_url[$i4],
                    'titles'       => $article_title[$i4],
                    'hateb_counts' => (int)$article_hateb_count[$i4],
                );

                // resultモデルにdataを保存
                $new = Model_Result::forge($data)->save();

                $all_data[] = $data;
            }
        }

        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../../views/');
        $twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
        $template = $twig->loadTemplate("base.html.twig");
        $test = Uri::create("testform");
        $template->display(array("title" => "トップページ", "categorytop" => $test));

    }

    public function db_url($scrape_url)
    {
        $compare_url = false;

        $result = DB::query('select `urls` from `hatebs`')->execute();
        $registered_db_url = $result->as_array();

        $db_url = array();
        foreach($registered_db_url as $value)
        {
            $db_url[] = $value['urls'];
        }

        foreach ($db_url as $url)
        {
            if($url == $scrape_url)
            {
                $compare_url = true;
            }
            else
            {
                // 何もしない
            }
        }

        return $compare_url;
    }
}