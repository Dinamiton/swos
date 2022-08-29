<?php

namespace App\Application\Team\Command;

use App\Application\CommandHandler;
use App\Domain\Common\CountryNotFoundException;
use App\Domain\Common\CountryRepository;
use App\Domain\Team\Team;
use App\Domain\Team\TeamAlreadyExistsException;
use App\Domain\Team\TeamRepository;
use App\Domain\Team\TypeNotFoundException;
use App\Domain\Team\TypeRepository;

class CreateTeamCommandHandler implements CommandHandler
{
    private TeamRepository $teamRepository;
    private TypeRepository $typeRepository;
    private CountryRepository $countryRepository;

    public function __construct(
        TeamRepository $teamRepository,
        TypeRepository $typeRepository,
        CountryRepository $countryRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->typeRepository = $typeRepository;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @throws CountryNotFoundException
     * @throws TeamAlreadyExistsException
     * @throws TypeNotFoundException
     */
    public function __invoke(CreateTeamCommand $command): void
    {
        if ($this->teamRepository->findByName($command->name())) {
            throw new TeamAlreadyExistsException();
        }

        $type = $this->typeRepository->findByName($command->type());
        if (!$type) {
            throw new TypeNotFoundException();
        }

        $country = $this->countryRepository->findByCode($command->countryCode());
        if (!$country) {
            throw new CountryNotFoundException();
        }

        $team = new Team($command->name(), $type, $country);
        $this->teamRepository->save($team);
    }
}