# FuelPHPインストール方法

fuelphp用のディレクトリを作成、移動する。  
```
mkdir Test_Service
cd Test_Service
```

次にfuelphpをダウンロードするため下記コマンドを実行。
```
curl http://fuelphp.com/files/download/28 -o fuelphp-1.7.2.zip
```

zip解凍したら、移動して、名前変える。  
ディレクトリのパーミッションを変更するコマンドを打って、パーミッションを変更。  
ブラウザアクセスして welcome! が表示されればインストール完了。
```
unzip fuelphp-1.7.2.zip
cd fuelphp-1.7.2
mv fuelphp-1.7.2 fuel
php oil refine install
chmod -R 755 fuel
```