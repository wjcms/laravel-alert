<?php

if (!function_exists('alert')) {
    /**
     * alert助手函数，方便调用直接alert()->success('操作成功！')
     *
     * @param string $message
     * @return \wjcms\LaravelAlert\Alert
     */
    function alert($message = null, $title = null)
    {
        $instance = app('alert');

        if (!isset($instance)) {
            $instance = app()->make('wjcms\LaravelAlert\Alert');
        }
        
        return $instance;
    }
}
