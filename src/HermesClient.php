<?php

namespace HermesSdk;

use HermesSdk\Domains\Admin;
use HermesSdk\Domains\Atendia;
use HermesSdk\Domains\Scolaris;

class HermesClient
{
    private HttpApiClient $httpApiClient;

    public function __construct(string $apiKey, string $apiUrl)
    {
        $this->httpApiClient = new HttpApiClient();
        $this->httpApiClient->setHeaders([
            'Authorization' => "ApiKey $apiKey",
        ]);
        $this->httpApiClient->setBaseUrl($apiUrl);
    }

    public function admin(): Admin
    {
        return new Admin($this->httpApiClient);
    }

    public function scolaris(): Scolaris
    {
        return new Scolaris($this->httpApiClient);
    }

    public function atendia(): Atendia
    {
        return new Atendia($this->httpApiClient);
    }
}
