<?php

namespace wjcms\LaravelAlert;

class Alert
{
    protected $alerts = [];
    protected $types = [];


    /**
     * 构造函数，读取alert相关配置文件
     */
    public function __construct()
    {
        $this->types = config('alert.types');
    }

    /**
     * 这里使用魔术方法自动调用来实现自定义配置中指定的类型
     */
    public function __call($method, $args)
    {
        if (array_key_exists($method, $this->types)) {
            call_user_func_array([$this, 'alert'], $args);
        } else {
            throw new \BadMethodCallException('系统没有配置该类型消息提示"' . $method . '"');
        }
    }

    /**
     * success类型实现
     */
    public function success($message,$callback)
    {
        $this->alert($message, $this->types['success']);

        $this->callback($callback);

        return $this;
    }

    /**
     * error类型实现
     */
    public function error($message,$callback)
    {
        $this->alert($message, $this->types['error']);

        $this->callback($callback);

        return $this;
    }

    /**
     * warning类型实现
     */
    public function warning($message,$callback)
    {
        $this->alert($message, $this->types['warning']);

        $this->callback($callback);

        return $this;
    }


    /**
     * info类型实现
     */
    public function info($message,$callback)
    {
        $this->alert($message, $this->types['info']);

        $this->callback($callback);

        return $this;
    }


    /**
     * 消息展示后的回调
     */
    public function callback($callback){
       if ($callback=='back') {
            return back();
       }else if(preg_match('/^route(*$)/',$callback){
            return redirect()->$callback;
       }else if(preg_match("/^(http:\/\/)?([^\/]+)/i", $callback){
            return redirect()->away($callback);
       }

       return $this;
    }

    /**
     * 这里创建消息方法
     */
    public function alert($message, $type = null,$callback='back')
    {
        if (!isset($type)) {
            $type = $this->types['default'];
        }

        array_push($this->alerts, [            
            'type' => $type,
            'message' => $message,
            'callback' => $callback
        ]);
        $this->flash();

        return $this;
    }

    /**
     * 清空闪存信息
     */
    public function clear()
    {
        $this->alerts = [];
        $this->flash();

        return $this;
    }

    
    /**
     * 将错误信息进行闪存
     */
    private function flash()
    {
        session()->flash('alerts', $this->alerts);
    }
}
