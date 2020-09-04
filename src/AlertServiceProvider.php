<?php

namespace wjcms\LaravelAlert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
{

    /**
     * 非延迟加载服务
     */
    protected $defer = false;

    /**
     * 初始化操作，可使用publish命令行复制文件使用
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('alert.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/layout/alert'),
        ], 'views');

        $this->publishes([
            __DIR__.'/../static' => public_path('alert'),
        ], 'public');

        $this->loadViewsFrom(__DIR__ . '/../views', 'alert');
    }

    /**
     * 注册服务
     */
    public function register()
    {
        /**
         * 注册绑定到全局
         */
        $this->app->bind('alert', Alert::class, true);

        /**
         * 这样可以在引用的项目里面修改默认的配置项，但是有时候只想修改其中的少量的配置项，可以合并默认配置项
         */
        $this->mergeConfigFrom(
            __DIR__.'/config.php',
            'alert'
        );
    }
}
