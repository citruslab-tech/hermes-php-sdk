<?php

namespace HermesSdk\Domains;

use HermesSdk\HttpApiClient;
use HermesSdk\Models\Email;
use HermesSdk\Models\Atendia\Tenant;

class Atendia
{
    private const SERVICE = 'atendia';

    public function __construct(
        private HttpApiClient $httpApiClient
    ) {}

    /**
     * @return Email
     */
    public function sendEmail(string $emailId, string $destination, array $params, Tenant $tenant): Email
    {
        $paramsWithTenant = array_merge($params, [
            'tenant_name' => $tenant->getName(),
            'tenant_subdomain' => $tenant->getSubdomain(),
        ]);

        $email = $this->httpApiClient->post('emails', [
            'service' => self::SERVICE,
            'email_id' => $emailId,
            'destination' => $destination,
            'params' => $paramsWithTenant,
        ]);

        return Email::fromArray($email);
    }

    public function sendUserOtp(string $email, string $userName, string $otp, string $otpAction, int $otpExpirationMinutes, Tenant $tenant): Email
    {
        $email = $this->httpApiClient->post('emails', [
            'service' => self::SERVICE,
            'email_id' => 'user_otp',
            'destination' => $email,
            'params' => [
                'tenant_name' => $tenant->getName(),
                'tenant_subdomain' => $tenant->getSubdomain(),
                'user_name' => $userName,
                'otp_code' => $otp,
                'otp_action' => $otpAction,
                'otp_expiration_minutes' => $otpExpirationMinutes,
            ],
        ]);

        return Email::fromArray($email);
    }
}
