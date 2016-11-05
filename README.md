### 開発環境作成
Bitbucket([https://bitbucket.org/nesah/test_service](https://bitbucket.org/nesah/test_service))からソースをクローンする．
```
$ git clone git@bitbucket.org:nesah/test_service.git
```

ディレクトリを移動し、 一部ディレクトリのパーミッションを変更する．
ブラウザにアクセス(localhost:8000)してトップページが表示されればインストール完了．
```
$ cd test_service
$ composer install
$ php oil refine install
$ php oil server
```

MySQLを brew でインストールし、サーバーが立ち上がり、
アクセスできればインストール完了
```
$ brew install mysql
$ mysql.server start
$ mysql -uroot
```

MySQLのバージョンは下記コマンドで確認する
```
$ brew info mysql
```

Couchbase を brew でインストールし、
ブラウザにアクセス(localhost:8091)すると、セットアップ画面が表示される。
セットアップが終わり管理画面が表示されればインストール完了
```
$ brew install Caskroom/cask/couchbase-server-community
$ open ./Applications/Couchbase\ Server.app
$ ブラウザで確認．
$ http://localhost:8091/index.html
```

### 開発ブランチ
下記の目的で各ブランチを使用する．
```
master: 本番リリース用
dev: 開発ソースマージ，STG環境確認用 (dev_YOURNAMEからはコチラのブランチにPRを出す)
dev_YOURNAME: 個々人のローカル環境での開発ブランチ
```
