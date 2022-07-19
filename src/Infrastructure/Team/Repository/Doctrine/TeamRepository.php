<?php

namespace App\Infrastructure\Team\Repository\Doctrine;

use App\Domain\Team\Team;
use App\Domain\Team\TeamRepository as TeamRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TeamRepository extends ServiceEntityRepository implements TeamRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function findByName(string $name): ?Team
    {
        return $this->findOneByName($name);
    }

    public function save(Team $team): void
    {
        $this->_em->persist($team);
        $this->_em->flush();
    }
}