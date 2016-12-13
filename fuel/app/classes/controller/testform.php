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
        $testform_object = View::forge("testform/index");

        // 入力値の出力先URLを生成・セット
        $testform_object->set("result_url", Uri::create("testform/getdata"));

        return $testform_object;
    }

    /**
     * get送信の値を受け取る
     *
     */
    public function get_getdata()
    {
        $client = new Client();

        $crawling_url = array();
        // 1ページ目のURLをセットする
        $crawling_url[] = $this::HATEB_SEARCH_URL . $this::HATEB_KEYWORD_PARAMETER . urlencode(Input::get('keyword')) . $this::HATEB_BOOKMARK_COUNT_50;

        $crawler = $client->request('GET', $crawling_url[0]);
        sleep(1);

        // 「次のページ」のURLを全部スクレイプする
        $next_pages = $crawler->filter("div.pager a")->extract("href");

        for($i1=0; $i1<count($next_pages)-1; $i1++)
        {
            $crawling_url[$i1+1] = $this::HATEB_SEARCH_URL . $next_pages[$i1];
        }

        $title = array();
        $hateb_count = array();

        for($i2=0; $i2<count($crawling_url); $i2++)
        {
            $crawler = $client->request('GET', $crawling_url[$i2]);
            sleep(1);

            // 記事のURLをスクレイプ
            $url = $crawler->filter("h3 a")->extract("href");

            // URL件数分の タイトル と はてぶ数 を取得
            for($i3=0; $i3<count($url); $i3++)
            {
                $title[] = $crawler->filter("h3 a")->eq($i3)->text();
                $hateb_count[] = $crawler->filter("span.users a")->eq($i3)->text();
            }
        }

        $data = array(
            'url'         => "a",
            'title'       => "b",
            'hateb_count' => "c",
        );
        // resultモデルにdataを保存
        $new = Model_Result::forge($data)->save();

        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../../views/');
        $twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
        $template = $twig->loadTemplate("base.html.twig");
        $test = Uri::create("testform");
        $template->display(array("title" => "トップページ", "categorytop" => $test));

    }
}