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

・13 SEEDING
Faker
composer.jsonに下記の追加
	"require-dev": {
		"phpunit/phpunit": "~4.0",
		"phpspec/phpspec": "~2.1",
		"fzaninotto/faker": "v1.4.0"←これ
	},
composer.phar updateでダウンロードされる

vendor/compiled.phpを削除すると直るみたいです。
PHP Fatal error:  Call to undefined method Illuminate\Foundation\Application::getCachedCompilePath() in /vagrant/develop/laravel/server_app/vendor/laravel/framework/src/Illuminate/Foundation/Console/ClearCompiledCommand.php on line 28

ファイルを元に戻す
一部だけ戻したい時はパス名を指定する。
git checkout -f Gemfile

database/seeds/ArticlesTableSeeder.phpをつくる
下記を実行
$ composer.phar dump-autoload　←こっちかな
//もしくは
$ php artisan optimize

php artisan db:seed --class="ArticlesTableSeeder"

・14MVC
コントローラー作る
php artisan make:controller ArticlesController --plain

・16FORMの作成
illuminate/htmlのインストール
下記に追加してcomposer.phar update
	"require": {
		"laravel/framework": "5.0.*",
		"illuminate/html": "~5.0"　←これ
	},

・18FORMREQUEST
app/Http/Requests/ArticleRequest.phpをつくる
php artisan make:request ArticleRequest

・22HELPER
composer.jsonにヘルパーをオートロードできるように追加
composer.phar dump-autoloadをする

・30ミドルウェア
これでミドルウェア作れるけどまだ自前ではよくわからない
php artisan make:middleware MyMiddleware

・31リレーション
マイグレーションで外部キーを追加し、下記のコマンドを実行
php artisan migrate:refresh
データは全部消える
※マイグレーションテーブルにアーティクルがなかったから、全部作り直した
外部キーを追加するときに、ユーザID追加を忘れていて、マイグレートが失敗
結果テーブルにも正しくデータが登録されていないからだった
その後リフレッシュもちゃんと動く

ユーザテーブルとにシードを追加して
php artisan db:seed

・番外
認証システムを入れてみる
http://blog.fagai.net/2014/05/27/laravel4-sentry-auth-tutorial/
コンポーザに追加
"cartalyst/sentry": "2.1.*"
composer.phar updateする
5.0には公式のドキュメントも対応していなかったので断念

こっちにチャレンジ
http://qiita.com/zaburo/items/2ebc725e29657206d7d9
php artisan make:migration add_role_to_users_table --table=users
追加ファイル作るとカラムの位置がコントロールできなさそうだから、usersのマイグレーションに追記して
php artisan migrate:refresh
外部キーの制約で上手くドロップできないから、下記のように修正
消す順番が大事
	public function down()
	{
		Schema::drop('article_tag');
		Schema::drop('tags');
	}
※これも書いてあることがよくわからん

最終的に外部キーでrollテーブルから権限を取得して、それに応じた処理をした方が良いかもしれない


・集計コントローラ
php artisan make:controller AggregateController
php artisan make:request AggregateRequest

これを参考にビジネスロジックとかの追加をしていこう
http://qiita.com/niiyz/items/83770cfa6d6bb33c10ab
php artisan make:provider CsvServiceProvider

publicのhtaccessに下記を記載してIP制限
<pre>
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On

    # Redirect Trailing Slashes...
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

order deny,allow
deny from all
allow from 202.143.92.128/26
</pre>
