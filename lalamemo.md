https://laravel10.wordpress.com/

.envにデータベースの設定
接続確認
php artisan tinker
App\User::all()->toArray();

ユーザのテーブルとか作成
php artisan migrate
このコマンドでマイグレートフォルダの中身が実行される！
すげー

Route::get('about', 'PagesController@about');
php artisan make:controller --plain PagesController
自動で作れる

・マイグレーションを作る
php artisan make:migration create_articles_table
テーブル名指定
php artisan make:migration create_articles_table --create=articles
項目を追加
php artisan make:migration add_published_at_to_articles_table --table=articles

・モデル作成
php artisan make:model Article
からのモデルが直下に出来た
php artisan tinker
DBにデータ入れてセーブできた

モデルでガード外して下記を流した
App\Article::create(['title' => '3cnt', 'body' => 'i am neko', 'published_at' => Carbon\Carbon::now()]);

