<?php

namespace App\Controller;

Class Task {

    public function addTask()
    {
        if ($_POST) {
            $name = trim($_POST['name']);
            $type = trim($_POST['type']);
            $date = trim($_POST['date']);

            $data = ['name'=>$name, 'type'=>$type, 'date'=> strtotime($date)];

            $model = new \App\Model\Task();
            $model->addTask($data);
        }
    }

}