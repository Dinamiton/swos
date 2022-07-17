<?php

namespace App\Domain\Common;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Country
{
    private UuidInterface $id;
    private string $name;
    private string $code;
    private Continent $continent;
    private ?\ArrayObject $teams;

    public function __construct(string $name, string $code, Continent $continent, ?\ArrayObject $teams = null)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->code = $code;
        $this->continent = $continent;
        $this->teams = $teams;
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