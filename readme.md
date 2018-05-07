基于Lraravel + X-admin编写

环境配置
-------
##### Linux + Apache + PHP + MYSQL 启动环境
##### PHP >=7.1.4
##### 数据库建议使用mariadb


安装说明：
--------
####1.用Git下载软件包

<code>git clone https://gitee.com/hades1996/OA.git </code>

####2.将目录下的storage目录设置为777

####3.用composer安装所需的包

<code>composer  install</code>

####4.重命名配置文件

<code> mv .env.example .env </code>

####5.修改配置文件

######DB_DATABASE=数据库名
######DB_USERNAM=数据库用户名
######DB_PASSWORD=数据库密码
######KDN_APP_ID=快递鸟APP_ID
######KDN_APP_KEY=快递鸟APP_KEY


####6.生成APP_KEY
<code> php artisan key:generate </code>





