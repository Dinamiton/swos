<?php

namespace App\Domain\Team;

use App\Domain\Common\Country;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Team
{
    private UuidInterface $id;
    private string $name;
    private Type $type;
    private Country $country;

    public function __construct(string $name, Type $type, Country $country, ?UuidInterface $id = null)
    {
        $this->id = $id ?: Uuid::uuid4();
        $this->name = $name;
        $this->type = $type;
        $this->country = $country;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): Type
    {
        return $this->type;
    }

    public function country(): Country
    {
        return $this->country;
    }
}