<?php

namespace HermesSdk\Models;

class Email
{
    /**  @var array<Email> */
    private array $retries = [];

    public function __construct(
        private string $id,
        private string $service,
        private string $emailId,
        private string $destination,
        private array $params = [],
        private string $status,
        private string $createdAt,
        private string $sentAt = '',
        private string $error = '',
        private string $errorTrace = '',
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getEmailId(): string
    {
        return $this->emailId;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getSentAt(): string
    {
        return $this->sentAt;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getErrorTrace(): string
    {
        return $this->errorTrace;
    }

    public function addRetry(Email $email): void
    {
        $this->retries[] = $email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'service' => $this->service,
            'email_id' => $this->emailId,
            'destination' => $this->destination,
            'params' => $this->params,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'error' => $this->error,
            'error_trace' => $this->errorTrace,
            'retries' => array_map(fn($email) => $email->toArray(), $this->retries),
        ];
    }

    public static function fromArray(array $data): self
    {
        $email = new self(
            $data['id'],
            $data['service'],
            $data['email_id'],
            $data['destination'],
            $data['params'] ?? [],
            $data['status'],
            $data['created_at'],
            $data['sent_at'] ?? '',
            $data['error'] ?? '',
            $data['error_trace'] ?? '',
        );

        foreach ($data['retries'] ?? [] as $retry) {
            $email->addRetry(self::fromArray($retry));
        }

        return $email;
    }
}
