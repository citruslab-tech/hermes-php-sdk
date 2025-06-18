<?php

namespace HermesSdk\Models\Atendia;

class Tenant
{
    public function __construct(
        private string $name,
        private string $subdomain,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubdomain(): string
    {
        return $this->subdomain;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'subdomain' => $this->subdomain,
        ];
    }
}
