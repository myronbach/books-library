<?php


namespace core;


class Flash
{
    protected static $instance;
    protected $type;
    protected $message = [];
    protected function __construct($type)
    {
        $this->type = $type;
        $this->message = &$_SESSION[$this->type];
    }
    public static function instance($type = 'flash' )
    {
        if(self::$instance === null){
            self::$instance = new self($type);
        }
        return self::$instance;
    }

    public function hasMessage()
    {
       return count($this->message) !== 0; //return true if count > 0
    }

    public function addMessage($message, $status = 'success')
    {
        $message = ['message' => $message, 'status' => $status];
        $this->message[] = $message ;
    }

    public function getMessage()
    {
        $message = $this->message;
        unset($_SESSION[$this->type]);
        return $message;
    }

    public function clearMessage()
    {
        unset($_SESSION[$this->type]);
    }

}