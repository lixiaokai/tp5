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

1. 批量插入或更新实现 ( ON DUPLICATE KEY UPDATE ) InsertOnDuplicateKey

参考 ( 实现前，打开下面的全部参考后再实现 )：
- https://github.com/top-think/thinkphp/blob/master/ThinkPHP/Library/Think/Db/Driver/Mysql.class.php
- https://github.com/top-think/think-orm/blob/2.0/src/db/builder/Mysql.php
- http://www.04007.cn/article/490.html
- https://dev.mysql.com/doc/refman/8.0/en/insert-on-duplicate.html
- https://jiajunhuang.com/articles/2019_11_19-mysql_duplicate_key_update.md.html

