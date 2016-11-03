######## FuelPHPインストール方法 ########

# fuelphp用のディレクトリを作成、移動し下記コマンドを実行。
curl http://fuelphp.com/files/download/28 -o fuelphp-1.7.2.zip

# 解凍、移動して、名前変えて、必要なパーミッション変えて、
# pei配下ディレクトリのパーミッションも変えて、
# ブラウザアクセスして welcome! が表示されればインストール完了。
```
unzip fuelphp-1.7.2.zip
cd fuelphp-1.7.2
mv fuelphp-1.7.2 fuel
php oil refine install
chmod -R 755 fuel
```