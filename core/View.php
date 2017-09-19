<?php


namespace core;


class View
{
    //public $route;
    public $view;
    public $layout;

    public function __construct( $view = null, $layout = null)
    {
        $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
    }

    public function render($vars, $messages)
    {
        // дані для передачі у view
        if(is_array($vars)){
            extract($vars);
        }  else {
            echo "Неправильний формат даних";
        }

        if(is_array($messages)){
            extract($messages);
        }


        // формування змінної content
        $file_view = VIEWS. "/{$this->view}.php";
        if(is_file($file_view)) {
            ob_start();// включаємо буферизацію
            if(is_file($file_view)){
                require $file_view;
            }else{
                echo "<p> The View <b>$file_view</b>> not found </p>";
            }
            //весь збуферизований контент(ціла сторінка View) присвоюємо змінній
            $content = ob_get_clean(); // тепер цю змінну можна виводити у потрібному місці
        }

        // формування layout
        if(false != $this->layout){
            $file_layout = VIEWS. "/{$this->layout}.php";
            if(is_file($file_layout)){
                include $file_layout;
            } else {
                echo "File $file_layout not found";
            }
        }


    }
}