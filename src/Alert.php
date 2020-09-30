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
    public function success($message)
    {
        $this->alert($message, $this->types['success']);

        return $this;
    }

    /**
     * error类型实现
     */
    public function error($message)
    {
        $this->alert($message, $this->types['error']);

        return $this;
    }

    /**
     * warning类型实现
     */
    public function warning($message)
    {
        $this->alert($message, $this->types['warning']);

        return $this;
    }


    /**
     * info类型实现
     */
    public function info($message)
    {
        $this->alert($message, $this->types['info']);

        return $this;
    }


    /**
     * 消息展示后的回调
     */
    public function callback($callback){
       if ($callback=='back') {
            return back();
       }else if(preg_match("/^(http:\/\/)?([^\/]+)/i", $callback){
            return redirect()->away($callback);
       }else{
            return redirect()->route($callback);
       }
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
            'message' => $message,
            'type' => $type
        ]);
        $this->flash();
        
        $this->callback($callback);
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
