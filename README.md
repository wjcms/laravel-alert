# laravel-alert

laravel-alert,一个 laravel 信息提示的扩展包（A laravel alert of composer package）

```
//laravel config/app.config
'providers' => [
    //添加如下一行
    wjcms\LaravelAlert\AlertServiceProvider::class,
],
'aliases' => [
        //添加如下一行
        'Alert' => wjcms\LaravelAlert\Facades\Alert::class,
]
```

## 拷贝相关文件到项目文件夹中
```
php artisan vendor:publish --provider="wjcms\LaravelAlert\AlertServiceProvider"
```



## v2.1.0 版本 
**更新** 添加回调
**优化** 优化回调方法

## 使用
1. 在blade模版引入
```
@include('layout.alert.alert')
```
2. 控制器调用
```
use wjcms\LaravelAlert\Facades\Alert;

return Alert::alert('添加成功！','success',route('admin.article.index'));
```


鸣谢：
toastr https://github.com/CodeSeven/toastr
更多样式参考：http://codeseven.github.io/toastr/demo.html

在blade模版中自定义即可。


