<?php

namespace App\Infrastructure\Common\Repository\InMemory;
use App\Domain\Common\Country;
use App\Domain\Common\CountryRepository as CountryRepositoryInterface;

class CountryRepository implements CountryRepositoryInterface
{

    private array $countries;

    public function __construct()
    {
        $this->countries = [];
    }

    public function findByCode(string $code): ?Country
    {
        /** @var Country $country */
        foreach ($this->countries as $country) {
            if ($country->code() === $code) {
                return $country;
            }
        }
        return null;
    }

    public function save(Country $country): void
    {
        $this->countries[] = $country;
    }
}