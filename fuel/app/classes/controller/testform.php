<?php

use Goutte\Client;

class Controller_Testform extends Controller
{
    const HATEB_SEARCH_URL = "http://b.hatena.ne.jp/search/text?q=";
    const HATEB_BOOKMARK_COUNT_50 = "&users=50";

    /**
     * 入力ページに値をセットする
     *
     */
    public function action_index()
    {
        // 入力値の出力先URLを生成・セット
        $testform_object = View::forge("testform/index");
//        var_dump($testform_object);
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

        $crawling_url = $this::HATEB_SEARCH_URL . urlencode(Input::get('keyword')) . $this::HATEB_BOOKMARK_COUNT_50;

        $crawler = $client->request('GET', $crawling_url);
        sleep(1);

        // はてぶ 1ページのURLを取得
        $url = $crawler->filter("h3 a")->extract("href");

        $title = array();
        $hateb_count = array();

        // URL件数分の タイトル と はてぶ数 を取得
        for($i=0; $i<count($url); $i++)
        {
            $title[] = $crawler->filter("h3 a")->eq($i)->text();
            $hateb_count[] = $crawler->filter("span.users a")->eq($i)->text();
        }

        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../../views/');
        $twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
        $template = $twig->loadTemplate("base.html.twig");
        $test = Uri::create("testform");
        $template->display(array("title" => "トップページ", "categorytop" => $test));
    }
}