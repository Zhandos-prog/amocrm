<?php

namespace App\Controller;

Class Home {

    public function run()
    {
        $view = new \App\View\Home();
        $view->render();
    }
}