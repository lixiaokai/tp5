# 运行环境

- php: >=5.4.0 && <= 7.1.x
    - PDO PHP Extension
    - MBstring PHP Extension
    - CURL PHP Extension

> 注意：没有测试过是否支持 php 7.2.x, 7.3.x, 7.4.x


# 项目初始化

## 1. composer 依赖更新

项目克隆到本地后，需要运行 composer 安装依赖

```
# 1. 进入项目目录，根据自己的情况而定
cd tp5

# 2. 更新依赖
composer update
```

# Todo

## 1. 批量插入或更新实现 ( ON DUPLICATE KEY UPDATE ) InsertOnDuplicateKey

参考文章 ( 实现前，打开下面的全部参考后再实现 )：
- https://github.com/top-think/thinkphp/blob/master/ThinkPHP/Library/Think/Db/Driver/Mysql.class.php
- https://github.com/top-think/think-orm/blob/2.0/src/db/builder/Mysql.php
- http://www.04007.cn/article/490.html
- https://dev.mysql.com/doc/refman/8.0/en/insert-on-duplicate.html
- https://jiajunhuang.com/articles/2019_11_19-mysql_duplicate_key_update.md.html

# HTTP 常见状态码

- 200 
OK - [GET]：服务器成功返回用户请求的数据。

- 201
CREATED - [POST/PUT/PATCH]：用户新建或修改数据成功。

- 202
Accepted - [*]：表示一个请求已经进入后台排队（异步任务）

- 204
NO CONTENT - [DELETE]：用户删除数据成功。

- 400
INVALID REQUEST - [POST/PUT/PATCH]：用户发出的请求有错误，服务器没有进行新建或修改数据的操作，该操作是幂等的。

- 401
Unauthorized - [*]：表示用户没有权限（令牌、用户名、密码错误）。

- 403
Forbidden - [*] 表示用户得到授权（与 401 错误相对），但是访问是被禁止的。

- 404
NOT FOUND - [*]：用户发出的请求针对的是不存在的记录，服务器没有进行操作，该操作是幂等的。

- 406
Not Acceptable - [GET]：用户请求的格式不可得（比如用户请求 JSON 格式，但是只有 XML 格式）。

- 410
Gone -[GET]：用户请求的资源被永久删除，且不会再得到的。

- 422
Unprocesable entity - [POST/PUT/PATCH] 当创建一个对象时，发生一个验证错误。

- 500
INTERNAL SERVER ERROR - [*]：服务器发生错误，用户将无法判断发出的请求是否成功。

