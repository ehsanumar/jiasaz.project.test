<?php

namespace App\Controllers;

class Controller
{
    public function view($name = '', $args = [])
    {
        $filename = str_replace('.php', '', $name);
        $path = BASE_PATH . "/app/views/$filename.php";

        $data = array();

        foreach ($args as $key => $value) {
            $data[$key] = $value;
        }

        ob_start();
        include($path);
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }
}