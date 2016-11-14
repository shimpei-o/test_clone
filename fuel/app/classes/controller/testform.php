<?php

require_once('/Users/shimpei/vagrant/Test_Service/fuel/vendor/autoload.php');
//use Symfony\Component\DomCrawler\Crawler;
use Goutte\Client;


class Controller_Testform extends Controller
{
    public function action_index()
    {
        $layout = View::forge('common/tmphtml');

        // ベースになるHTMLにデータセット
        $layout->set("pagetitle", "入力フォーム");

        // メインコンテンツのデータを取得し、セットする
        $layout->contents = View::forge("testform/index");
        $layout->contents->set("result_url", Uri::create("testform/getdata"));

        return $layout;
    }

    // get送信の値を受け取る
    public function get_getdata() {
        $layout = View::forge('common/tmphtml');

        $client = new Client();

        $layout->set_global("categorytop", '<a href="' . Uri::create("testform") . '">フォームへ戻る</a>', false);

        // ベースになるHTMLにデータセット
        $layout->set("pagetitle", "フォーム");

        // メインコンテンツのデータを取得し、セットする
        $layout->contents = View::forge("testform/getdata");
        $layout->contents->set("method", "keyword");

        $formdata = Input::get('keyword');
        $url = "http://b.hatena.ne.jp/search/text?q=";
        $hateb_user_count = "&users=50";

        $h_url = $url.$formdata.$hateb_user_count;

        $crawler = $client->request('GET', $h_url);

        $test = $crawler->filter("h3")->nextAll();
var_dump($test);

        return $layout;
    }
}