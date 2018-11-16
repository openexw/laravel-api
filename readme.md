# Laravel+JWT+Dingo构建API

**说明**
+ Laravel：`5.6.*`
+ tymon/jwt-auth: `dev-develop`
+ dingo/api: `2.0.0-alpha1`

该项目可以快速搭建`Laravel+JWT+Dingo`环境，免去了自己填坑。

# 项目配置

## 下载项目

```bash
$ git clone https://github.com/openexw/laravel-api.git
```

## 更新`composer`

```bash
$ composre update
```

## 生成项目的`key`

```bash
$ php artisan key:generate
```

## 生成jwt的`secret`

```bash
$ php artisan jwt:secret
```

# 使用

> 注意在`.env`中配置正确的数据库

## 生成数据库

```bash
$ php artisan migrate
```

## 使用`tinker`数据生成

```bash
$ php artisan tinker
```

填充数据：

```bash
Psy Shell v0.9.9 (PHP 7.2.1 — cli) by Justin Hileman
>>> factory('App\User')->create()
>>> factory('App\Models\News', 20)->create()
```

# 测试

## 查看所有的路由

```bash
$ php artisan api:routes
  +------+----------+--------------------+------+------------------------------------------------+-----------+------------+----------+------------+
  | Host | Method   | URI                | Name | Action                                         | Protected | Version(s) | Scope(s) | Rate Limit |
  +------+----------+--------------------+------+------------------------------------------------+-----------+------------+----------+------------+
  |      | GET|HEAD | /api/news          |      | App\Api\Controllers\v1\NewsController@index    | No        | v1         |          |            |
  |      | GET|HEAD | /api/news/{id}     |      | App\Api\Controllers\v1\NewsController@show     | No        | v1         |          |            |
  |      | POST     | /api/user/login    |      | App\Api\Controllers\v1\AuthController@login    | No        | v1         |          |            |
  |      | POST     | /api/user/register |      | App\Api\Controllers\v1\AuthController@register | No        | v1         |          |            |
  |      | GET|HEAD | /api/user/me       |      | App\Api\Controllers\v1\AuthController@profile  | No        | v1         |          |            |
  +------+----------+--------------------+------+------------------------------------------------+-----------+------------+----------+------------+
```

## 使用postman请求数据

自测

# 文档生成

```bash
$ php artisan api:docs --version v1 --output-file User.md
```

> 在项目的根目录就会生`User.md`文档。

