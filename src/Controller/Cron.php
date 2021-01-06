<?php

namespace App\Controller;

Class Cron {

    
    public function get_token()
    {
        $refresh_token = new \App\Controller\Token();
        $refresh_token->get_refresh_token();
    }
}