<?php 


namespace App;


class Config
{

    protected $config;

    public function __construct()
    {
        $this->config = [
            'db' => [
                'host'      => $_ENV['DB_HOST'],
                'username'  => $_ENV['DB_USER'],
                'password'  => $_ENV['DB_PASSWORD'],
                'database'  => $_ENV['DB_NAME'],
                'driver'    => $_ENV['DB_DRIVER'] ?? 'mysql',
            ],
            'braintree' => [
                'environment' => $_ENV['braintree_sandbox'],
                'merchantId' => $_ENV['merchantId_sandbox'],
                'publicKey' => $_ENV['publicKey_sandbox'],
                'privateKey' => $_ENV['privateKey_sandbox']
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}