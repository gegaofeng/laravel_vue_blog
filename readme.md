#  Blog

基于[PJ Blog](https://pigjian.com/)二次开发

`Laravel 5.*` and `Vuejs 2.*` combined with the establishment of a good response and quickly dashboard, the dashboard made through the `Vuejs` component development.


## Basic Features

- Manage users, articles, discussions and media
- Statistical tables
- Categorize articles
- Label classification
- Content moderation
- Own comments system
- Multi-language switching
- Markdown Editor
- and more...


## Server Requirements

- PHP >= 7.1.0
- Node >= 6.x
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Preview

![New Blog]()


## Install

### 1. Clone the source code or create new project.

```shell
git clone https://github.com/gegaofeng/laravel_vue_blog.git
```

### 2. Set the basic config

```shell
cp .env.example .env
```

Edit the `.env` file and set the `database` and other config for the system after you copy the `.env`.example file.

### 2. Install the extended package dependency.

Install the `Laravel` extended repositories: 

```shell
composer install -vvv
```

Install the `Vuejs` extended repositories: 

```shel
npm install
```

Compile the js code: 

```shel
npm run dev

// OR

npm run watch

// OR

npm run production
```

### 3. Run the blog install command, the command will run the `migrate` command and generate test data.

```shell
php artisan blog:install  //运行前请确保.env已配置完成
```
```shell
php artisan blog:admin //创建管理员账号
```

## Contributors

- 

## Thanks

- 


## License

The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

