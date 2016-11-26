<?php

require_once('/Users/shimpei/vagrant/Test_Service/fuel/vendor/autoload.php');
//require_once('/Users/shimpei/vagrant/Test_Service/fuel/vendor/Twig_cp/Autoloader.php');

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
        $layout = View::forge('common/tmphtml');

        // 入力ページのタイトルをセット
        $layout->set("page_title", "入力フォーム");

        // 入力値の出力先URLを生成・セット
        $layout->contents = View::forge("testform/index");
        $layout->contents->set("result_url", Uri::create("testform/getdata"));

        return $layout;
    }

    /**
     * get送信の値を受け取る
     *
     */
    public function get_getdata()
    {
        $layout = View::forge('common/tmphtml');

        $client = new Client();

        $layout->set_global("categorytop", '<a href="' . Uri::create("testform") . '">フォームへ戻る</a>', false);

        // 結果ページベースになるHTMLにデータセット
        $layout->set("page_title", "結果ページ");

        // メインコンテンツのデータを取得し、セットする
        $layout->contents = View::forge("testform/getdata");
        $layout->contents->set("method", "keyword");

        $form_data = Input::get('keyword');

        $crawling_url = $this::HATEB_SEARCH_URL . urlencode($form_data) . $this::HATEB_BOOKMARK_COUNT_50;

        $crawler = $client->request('GET', $crawling_url);
        sleep(1);

       // タイトルをスクレイプ
//        $title = $crawler->filter("h3 a")->each(function($element){
//            echo $element->text()."\n";
//        });
       // はてぶ数をスクレイプ
//        $hateb_count = $crawler->filter("span.users a")->each(function($element){
//            echo $element->text()."\n";
//        });

        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem("/Users/shimpei/vagrant/Test_Service/fuel/app/views/");
        $twig = new Twig_Environment($loader, array("cache" => "cache/", "debug" => true));
        $template = $twig->loadTemplate("base.html.twig");
        $test = Uri::create("testform");
        $template->display(array("title" => "トップページ", "categorytop" => $test));

        return $layout;
    }
}