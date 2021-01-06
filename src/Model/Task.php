<?php

namespace App\Model;

Class Task {

    private $data = [];

    public function addTask($data)
    {
        $this->data = $data;

        $subdomain = 'testdomain'; 
        $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/tasks'; 
        $path = $_SERVER["DOCUMENT_ROOT"];

        $get_token = json_decode(file_get_contents($path.'/token_file.json'));
        $access_token = $get_token->access_token;

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token
        ];
        
        $data = [
            [
                'task_type_id' => (int)$this->data['type'],
                'text' => (string)$this->data['name'],
                "complete_till" => $this->data['date']
            ]
        ];
        
        $curl = curl_init(); 
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        $out = curl_exec($curl); 
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        

        $code = (int)$code;
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];

        try
        {

            if ($code < 200 || $code > 204) {
                throw new \Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        }
        catch(\Exception $e)
        {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

        print_r(json_decode($out));
    }
}