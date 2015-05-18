# laravel
参考
http://www.ois-yokohama.co.jp/oisblog/archives/248

    3  sudo yum install php
    4  sudo curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin
    5  sudo rpm -ivh http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
    6  sudo rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
    7  sudo yum list --enablerepo=remi --enablerepo=remi-php55 | grep php
   14  sudo yum install --enablerepo=remi --enablerepo=remi-php55 php php-opcache php-devel php-mbstring php-mcrypt php-mysqlnd php-phpunit-PHPUnit php-pecl-xdebug
   
   ln -s /vagrant/laravel laravel
   
   composer.phar create-project laravel/laravel --prefer-dist
   
   バーチャルボックスの共有フォルダで/var/www/htmlをしてい
   C:\Users\k-nishiyama\Vagrant\centos01
   var/www/html


git clone https://github.com/248/laravel.git
curl -s http://getcomposer.org/installer | php

パスは最ログインするととおる？さいきどう？
export PATH=$PATH:/usr/local/bin
composer.phar create-project laravel/laravel laravel/server_app --prefer-dist
git add .
git commit -m "install laravel"
$ vi .git/config
url = https://アカウント名@github.com/yk5656/sample.git

chmod -R 777 server_app/storage/

ここまででつながっている
   
