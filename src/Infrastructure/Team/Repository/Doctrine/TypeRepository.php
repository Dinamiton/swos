<?php

namespace App\Infrastructure\Team\Repository\Doctrine;

use App\Domain\Team\TypeRepository as TypeRepositoryInterface;
use App\Domain\Team\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TypeRepository extends ServiceEntityRepository implements TypeRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    public function findByName(string $name): ?Type
    {
        return $this->findOneByName($name);
    }

    public function save(Type $type): void
    {
        $this->_em->persist($type);
        $this->_em->flush();
    }
}