<?php

namespace App\Application\Team\Command;

class CreateTeamCommand
{
    private string $name;
    private string $type;
    private string $countryCode;

    public function __construct(string $name, string $type, string $countryCode)
    {
        $this->name = $name;
        $this->type = $type;
        $this->countryCode = $countryCode;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function countryCode(): string
    {
        return $this->countryCode;
    }
}