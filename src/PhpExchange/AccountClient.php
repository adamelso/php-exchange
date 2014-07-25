<?php

namespace PhpExchange;

use GuzzleHttp\Client;

class AccountClient
{
    private $domain;
    private $username;
    private $password;
    private $version;

    public function __construct($domain, $username, $password, $version = ExchangeVersion::EXCHANGE_2007)
    {
        $this->domain = $domain;
        $this->username = $username;
        $this->password = $password;
        $this->version = $version;
    }

    public function connect()
    {
        $client = new Client([
            'base_url' => sprintf('https://%s/EWS/Services.wsdl', $this->domain),
        ]);

        $response = $client->get('/', [
            'config' => [
                'curl' => [
                    CURLOPT_USERPWD  => sprintf('%s:%s', $this->username, $this->password),
                ]
            ]
        ]);

        return $response->getBody()->getContents();

        return (int) $response->getStatusCode();
    }
}

//    $domain = '';
//    $user = '';
//    $password = '';
//    $ch = curl_init('https://'.$domain.'/EWS/Services.wsdl');
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_HEADER, 0);
//    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//    curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$password);
//    $response = curl_exec($ch);
//    $info = curl_getinfo( $ch );
//    $error =  curl_error ($ch);
//    print_r(array($response,$info,$error));

