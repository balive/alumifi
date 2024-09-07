<?php

namespace App\Integrations;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ChatGPT
{
    protected $httpService;

    protected $headers;

    protected $authorization;

    protected $token;

    protected $engine;

    protected $url = "https://api.openai.com/v1/chat/completions";

    public function __construct($engine = 'gpt-3.5-turbo')
    {
        $this->engine  = $engine;
        $this->token  = env('OPENAI_APIKEY');
    }

    public function ask($message)
    {
        $headers  = [
            'Accept'            => 'application/json',
            'Content'           => 'application/json',
            'Authorization' => 'Bearer '.$this->token,
        ];

        $params  = [
            'model' => $this->engine,
//            'model' => 'gpt-4',
//            'model' => 'gpt-3.5-turbo',
//            'model' => 'gpt-3.5-turbo-16k',
//            'model' => 'gpt-4-1106-preview',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message,
                ]
            ]
        ];

        $client = new Client();
        try {
            $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' =>$headers,
                'json' =>$params
            ]);

            $response_array = [
                'status_code'=> $response->getStatusCode(),
                'body'   => json_decode($response->getBody()->getContents(), true)

            ];

            return $response_array['body'];

        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
    }

    public function sendMessage($message, $json = false)
    {
        $headers  = [
            'Accept'            => 'application/json',
            'Content'           => 'application/json',
            'Authorization' => 'Bearer '.$this->token,
        ];

        $params  = [
            'model' => $this->engine,
//            'model' => 'gpt-3.5-turbo',
//            'model' => 'gpt-4',
//            'model' => 'gpt-4-vision-preview',
//            'model' => 'gpt-4-1106-preview',
            'messages' => [
//                [
//                    'role' => 'system',
//                    'content' => "You only return messages in json format , don't add any other extra words other than the json response ",
//                ],
                [
                    'role' => 'user',
                    'content' => $message,
                ]
            ],
//            'temperature' => 0.6
        ];

        if($json){
            $params["response_format"] = ["type"=> "json_object"];
        }

        $client = new Client();
        try {
            $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
                'headers' =>$headers,
                'json' =>$params
            ]);

            $response_array = [
                'status_code'=> $response->getStatusCode(),
                'body'   => json_decode($response->getBody()->getContents(), true)

            ];

            return $response_array['body'];

        } catch (GuzzleException $e) {
            return $e->getMessage();
        }


    }

}