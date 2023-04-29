<?php

namespace Hmoradian\FhSms;

//use GuzzleHttp\Client as HttpClient;

class Sms
{
    //protected $client;
    /** @var int */
    protected $connect_timeout;
    protected $encode_options;

    /** @var string */
    protected $user_name;
    protected $password;
    protected $phone_number;

    protected $url_get_data;
    protected $url_send_sms_one_to_many;
    protected $url_send_sms_many_to_many;
    protected $url_get_status;
    protected $url_get_messages;

    /**
     * Sms constructor.
     *
     * @param string $user_name
     * @param string $password
     * @param string $phone_number
     */
    public function __construct($user_name, $password, $phone_number)
    {
        $this->user_name = $user_name;
        $this->password = $password;
        $this->phone_number = $phone_number;

        $this->connect_timeout = 15;  //second
        $this->encode_options = JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE;

        // $base_url = 'http://185.4.28.100/class/sms/restful/';
        // read from config in new version
        $base_url = app('config')['fhsms.services']['base_url'];
        if(substr($base_url , -1) !== '/') {
            $base_url = $base_url . '/';
        }

        $this->url_get_data              = $base_url.'getData.php';
        $this->url_send_sms_one_to_many  = $base_url.'sendSms_OneToMany.php';
        $this->url_send_sms_many_to_many = $base_url.'sendSms_ManyToMany.php';
        $this->url_get_status            = $base_url.'getStatus.php';
        $this->url_get_messages          = $base_url.'getMessages.php';

        /*$this->client = new HttpClient([
            'timeout'         => 10,
            'connect_timeout' => 10,
        ]);*/
    }


    private function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->connect_timeout);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);
        return json_decode($result,true);
    }


    public function getData()
    {
        $params = [
            'uname' => $this->user_name,
            'pass'  => $this->password,
        ];

        //$response = $this->client->request('POST', $this->url_get_data, ['form_params' => $params]);
        //$response = \json_decode((string) $response->getBody(), true);
        header('Content-Type: application/json; charset=utf-8');
        try {
            $response = $this->CallAPI('POST', $this->url_get_data, json_encode($params, $this->encode_options));
        } catch (\JsonException $e) {
        }

        return $response;
    }


    public function getStatus($unique_id)
    {
        $params = [
            'uname'      => $this->user_name,
            'pass'       => $this->password,
            'uniqueID'   => $unique_id,
            'ManyToMany' => '', //1 برای پیام نظیر به نظیر
        ];

        header('Content-Type: application/json; charset=utf-8');
        try {
            $response = $this->CallAPI('POST', $this->url_get_status, json_encode($params, $this->encode_options));
        } catch (\JsonException $e) {
        }

        return $response;
    }


    public function sendSms($reciver_numbers, $text_message)
    {
        if (is_string($reciver_numbers)) {
            $reciver_numbers = [$reciver_numbers];
        }

        $params = [
            'uname' => $this->user_name,
            'pass'  => $this->password,
            'from'  => $this->phone_number,
            'to'    => $reciver_numbers,
            'msg'   => $text_message,
        ];

        header('Content-Type: application/json; charset=utf-8');
        try {
            $response = $this->CallAPI('POST', $this->url_send_sms_one_to_many, json_encode($params, $this->encode_options));
        } catch (\JsonException $e) {
        }

        return $response;
    }


    public function sendSms2(array $reciver_numbers, array $text_messages)
    {
        $count = count($reciver_numbers);
        if ($count !== count($text_messages)) {
            return null;
        }
        $content = [];
        for ($i = 0; $i < $count; $i++) {
            $content[] = [
                'to'  =>  $reciver_numbers[$i],
                'msg' => $text_messages[$i],
            ];
        }

        $params = [
            'uname'   => $this->user_name,
            'pass'    => $this->password,
            'from'    => $this->phone_number,
            'content' => $content,
            'to'      => $reciver_numbers,
            'msg'     => $text_messages,
        ];

        header('Content-Type: application/json; charset=utf-8');
        try {
            $response = $this->CallAPI('POST', $this->url_send_sms_many_to_many, json_encode($params, $this->encode_options));
        } catch (\JsonException $e) {
        }

        return $response;
    }


    public function getMessages()
    {
        $params = [
            'uname' => $this->user_name,
            'pass'  => $this->password,
        ];

        header('Content-Type: application/json; charset=utf-8');
        try {
            $response = $this->CallAPI('POST', $this->url_get_messages, json_encode($params, $this->encode_options));
        } catch (\JsonException $e) {
        }

        return $response;
    }

}
