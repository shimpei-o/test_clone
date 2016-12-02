<?php

require_once(dirname(__FILE__).'/../../../vendor/autoload.php');

require_once(dirname(__FILE__).'/../../../vendor/twig/twig/lib/Twig/Autoloader.php');

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
        $output_url = View::forge("testform/index");
        $output_url->set("result_url", Uri::create("testform/getdata"));

        return $output_url;
    }

    /**
     * get送信の値を受け取る
     *
     */
    public function get_getdata()
    {
        $client = new Client();

        $form_data = Input::get('keyword');

        $crawling_url = $this::HATEB_SEARCH_URL . urlencode($form_data) . $this::HATEB_BOOKMARK_COUNT_50;

        $crawler = $client->request('GET', $crawling_url);
        sleep(1);

        // タイトルをスクレイプ
        $title = $crawler->filter("h3 a")->each(function($element){
            echo $element->text()."\n";
        });
        // はてぶ数をスクレイプ
        $hatdeb_count = $crawler->filter("span.users a")->each(function($element){
            echo $element->text()."\n";
        });

        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../../views/');
        $twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
        $template = $twig->loadTemplate("base.html.twig");
        $test = Uri::create("testform");
        $template->display(array("title" => "トップページ", "categorytop" => $test));
    }
}