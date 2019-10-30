数据库结构比对工具
======

这个扩展用来比对两个数据库表结构的差异，在工具页面填入两个数据库的连接配置信息，即可对比两个数据库中表结构的差异，**前提是保证两个数据库都能正常连接**，运行效果参考下面的截图。

## 截图
![db-diff](https://user-images.githubusercontent.com/1479100/50831059-abc5f980-1384-11e9-9ad3-aa6a961fe7ec.png)

## 安装

安装包解压之后放到`storage/db-diff`目录下（安装完成之后可以删除），然后在`composer.json`中增加下面的配置

```json
    "repositories": [
        {
            "type": "path",
            "url": "storage/db-diff",
            "options": {
              "symlink": false
            }
        }
    ]
```
运行下面的命令安装扩展包
```bash
$ composer require laravel-admin-ext/db-diff -vvv
```

如果运行上面命令的过程中出现下面的错误：
```bash
[InvalidArgumentException]
  Could not find package laravel-admin-ext/db-diff at any version for your minimum-stability (dev). Check the package spelling or your minimum-stability
```
这是由于`composer`的最小稳定性设置不满足，建议在`composer.json`里面将`minimum-stability`设置为`dev`，另外`prefer-stable`设置为true, 这样给你的应用安装其它package的时候，还是会倾向于安装稳定版本, 
`composer.json`的修改如下
```json
{
    ...
    "minimum-stability": "dev",
    "prefer-stable": true,
    ...
}
```

然后运行下面的命令发布资源文件

```bash
php artisan vendor:publish --provider="Encore\Admin\DBDiff\DBDiffServiceProvider"
```

最后运行下面的命令添加左侧菜单项

```bash
php artisan admin:import db-diff
```

浏览器打开`http://localhost/admin/db-diff`访问这个工具，

## 配置

打开配置文件`config/admin.php`，找到`extensions`部分, 按照你的情况添加下面的配置：

```php

    'extensions' => [

        'db-diff' => [
        
            // 如果要关闭这个工具，设置为false
            'enable' => true,
            
            // 对比结果页面的配置
            'options' => [
            
                // 设置为'line-by-line'或者'side-by-side', 来调整结果页面的对比形式，默认为'side-by-side'
                'outputFormat' => 'side-by-side',
                
                // 是否在结果部分显示文件列表, 默认为true
                'showFiles' => true,
            ]
        ]
    ]

```

## 知识产权声明

请尊重作者知识产权, 勿传播他人使用。






