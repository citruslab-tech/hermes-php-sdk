<?php

namespace HermesSdk\Domains;

use HermesSdk\HttpApiClient;
use HermesSdk\Models\Email;
use HermesSdk\Models\Scolaris\Tenant;

class Scolaris
{
    private const SERVICE = 'scolaris';

    public function __construct(
        private HttpApiClient $httpApiClient
    ) {}

    /**
     * @return Email
     */
    public function sendWelcomeUserMail(string $email, string $userName, Tenant $tenant): Email
    {
        $email = $this->httpApiClient->post('emails', [
            'service' => self::SERVICE,
            'email_id' => 'user_welcome',
            'destination' => $email,
            'params' => [
                'user_name' => $userName,
                'tenant_name' => $tenant->getName(),
                'tenant_subdomain' => $tenant->getSubdomain(),
            ],
        ]);

        return new Email(
            $email['id'],
            $email['service'],
            $email['email_id'],
            $email['destination'],
            $email['params'],
            $email['status'],
            $email['created_at'],
            $email['sent_at'] ?? '',
            $email['error'] ?? '',
            $email['error_trace'] ?? '',
        );
    }
}
