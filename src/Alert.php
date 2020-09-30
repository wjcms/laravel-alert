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
        session()->flash('alerts', $this->alerts);

        sleep(3);

        if($callback == 'back'){
            return back();
        }else if(preg_match('/^((https|http)?:\/\/)[^\s]+/', $callback)){
            return redirect()->away($callback);
        }else{
            return redirect()->route($callback);
        }
    }


}
