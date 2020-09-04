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

```
php artisan vendor:publish --provider="wjcms\LaravelMessage\ServiceProvider" --tag="config"
```

```
php artisan vendor:publish --provider="wjcms\LaravelMessage\ServiceProvider" --tag="views"
```

```
php artisan vendor:publish --provider="wjcms\LaravelMessage\ServiceProvider" --tag="public"
```
