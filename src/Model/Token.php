<?php

namespace App\Model;

Class Token {

    public function put_token($data)
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        file_put_contents($path.'/token_file.json', $data);
    }
}