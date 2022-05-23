<?php

namespace App\Domain\Common;

interface CountryRepository
{
    public function save(Country $country): void;
    public function findOneByCode(string $code): ?Country;
}