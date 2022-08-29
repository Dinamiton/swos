<?php

namespace App\Domain\Common;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Continent
{
    private UuidInterface $id;
    private string $name;
    private ?\ArrayObject $countries;

    public function __construct(string $name, ?\ArrayObject $countries = null)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->countries = $countries;
    }

    public function name(): string
    {
        return $this->name;
    }
}