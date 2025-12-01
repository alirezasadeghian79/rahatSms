<?php

namespace rahatSms\Drivers;

use GuzzleHttp\Client;
use rahatSms\Contracts\SmsInterface;
use Throwable;

class SmsIr implements SmsInterface
{
    protected $apiKey;
    protected $lineNumber;
    protected $verify_url;
    protected $bulk_url;
    protected $bulk_delete_url;
    public function __construct()
    {
        $config = config('rahatSms.drivers.smsIr');
        $this->apiKey = $config['api_key'];
        $this->lineNumber = $config['line_number'];
        $this->verify_url = $config['routes']['verify'];
        $this->bulk_url = $config['routes']['bulk'];
        $this->bulk_delete_url = $config['routes']['bulk_delete'];
    }

    public function verify($mobile,$templateId,$parameters)
    {
        $client = new Client();
        $result = $client->post($this->verify_url,[
            'headers' => [
                'ACCEPT' =>'application/json',
                'X-API-KEY' => $this->apiKey
            ],
            'json' => [
                'Mobile' => $mobile,
                'TemplateId' => $templateId,
                'Parameters' => $parameters,
            ]
        ]);
        $response = json_decode($result->getBody(), true);
        return $response;
    }

    public function bulk($mobiles,$message,$dateTime = null)
    {
        $client = new Client();
        $result = $client->post($this->bulk_url,[
            'headers' => [
                'ACCEPT' =>'application/json',
                'X-API-KEY' => $this->apiKey
            ],
            'json' => [
                'lineNumber' => $this->lineNumber,
                'MessageText' => $message,
                'Mobiles' => $mobiles,
                'SendDateTime' => $dateTime,
            ]
        ]);
        $response = json_decode($result->getBody(),true);
        return $response;
    }

    public function bulkDelete($packId)
    {
        try {
            $client = new Client();
            $result = $client->delete($this->bulk_delete_url.$packId,[
                'headers' => [
                    'ACCEPT' =>'application/json',
                    'X-API-KEY' => $this->apiKey
                ],
            ]);
            $response = json_decode($result->getBody(),true);
            return $response;
        } catch (Throwable $e) {
            return [
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }
}
