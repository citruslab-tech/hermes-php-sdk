<?php

namespace HermesSdk\Domains;

use HermesSdk\HttpApiClient;
use HermesSdk\Models\Email;

class Admin
{
    private const SERVICE = 'admin';

    public function __construct(
        private HttpApiClient $httpApiClient
    ) {}

    /**
     * @return Email
     */
    public function sendWelcomeUserMail(string $email, string $userName, string $password, bool $changePasswordAtNextLogin = false): Email
    {
        $email = $this->httpApiClient->post('emails', [
            'service' => self::SERVICE,
            'key' => 'user_welcome',
            'destination' => $email,
            'params' => [
                'user_name' => $userName,
            ],
        ]);

        return new Email(
            $email['id'],
            $email['service'],
            $email['key'],
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
