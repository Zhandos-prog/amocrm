<?php

namespace App\Controller;


Class Token {
    
    public function get_refresh_token()
    {
        
        $subdomain = 'testdomain'; 
        $link = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; 
        $path = $_SERVER["DOCUMENT_ROOT"];

        $refresh_token = json_decode(file_get_contents($path.'/token_file.json'));
        
        $data = [
            'client_id' => '82b1bc57-f1d9-436f-899d-8c39d4d29cf7',
            'client_secret' => 'SiQ83w5HZNpRV8izL2IeneznU9hAGjYPHj0pgKJWHStzzGG8vjUHIKWnJVhaBMAz',
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token->refresh_token,
            'redirect_uri' => 'http://test.test.com',
        ]; 

        $curl = curl_init(); 
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER,['Content-Type:application/json']);
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
            /** Выкинем Exception */
            if ($code < 200 || $code > 204) {
                throw new \Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
        }
        catch(\Exception $e)
        {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

        $model = new \App\Model\Token();
        $model->put_token($out);
    }
}