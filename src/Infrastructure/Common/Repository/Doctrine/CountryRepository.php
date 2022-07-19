<?php

namespace App\Infrastructure\Common\Repository\Doctrine;

use App\Domain\Common\Country;
use App\Domain\Common\CountryRepository as CountryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CountryRepository extends ServiceEntityRepository implements CountryRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function findByCode(string $code): ?Country
    {
        return $this->findOneByCode($code);
    }

    public function save(Country $country): void
    {
        $this->_em->persist($country);
        $this->_em->flush();
    }
}