<?php

namespace App\Domain\Common;

class Country
{
    private string $name;
    private string $code;
    private Continent $continent;

    public function __construct(string $name, string $code, Continent $continent)
    {
        $this->name = $name;
        $this->code = $code;
        $this->continent = $continent;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function continent(): Continent
    {
        return $this->continent;
    }
}