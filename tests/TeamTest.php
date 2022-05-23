<?php

namespace App\Tests;

use App\Domain\Common\Continent;
use App\Domain\Common\Country;
use App\Domain\Common\CountryNotFoundException;
use App\Domain\Team\TeamAlreadyExistsException;
use App\Domain\Team\Type;
use App\Domain\Team\TypeNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Application\Team\Command\CreateTeamCommand;
use App\Application\Team\Command\CreateTeamCommandHandler;
use App\Domain\Team\TeamRepository;
use App\Domain\Team\TypeRepository;
use App\Domain\Common\CountryRepository;
use App\Domain\Team\Team;

class TeamTest extends KernelTestCase
{
    private ?object $createTeamCommandHandler;
    private ?object $typeRepository;
    private ?object $countryRepository;
    private ?object $teamRepository;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $this->createTeamCommandHandler = $container->get(CreateTeamCommandHandler::class);
        $this->typeRepository = $container->get(TypeRepository::class);
        $this->countryRepository = $container->get(CountryRepository::class);
        $this->teamRepository = $container->get(TeamRepository::class);
    }

    public function testCreateTeam(): void
    {
        $type = new Type("club");
        $this->typeRepository->save($type);
        $country = new Country("Italia", "it", new Continent("Europa"));
        $this->countryRepository->save($country);

        $createTeamCommand = new CreateTeamCommand(
            'Juventus',
            $type->name(),
            $country->Code()
        );

        $this->createTeamCommandHandler->__invoke($createTeamCommand);

        /** @var Team $team */
        $team = $this->teamRepository->findOneByName('Juventus');

        $this->assertEquals('Juventus', $team->name());
    }

    public function testTypeNotFound()
    {
        $createTeamCommand = new CreateTeamCommand(
            'Juventus',
            'patata',
            'it'
        );

        $this->expectException(TypeNotFoundException::class);
        $this->createTeamCommandHandler->__invoke($createTeamCommand);
    }

    public function testCountryNotFound()
    {
        $type = new Type("club");
        $this->typeRepository->save($type);
        $createTeamCommand = new CreateTeamCommand(
            'Juventus',
            $type->name(),
            'ita'
        );

        $this->expectException(CountryNotFoundException::class);
        $this->createTeamCommandHandler->__invoke($createTeamCommand);
    }

    public function testTeamAlreadyExists()
    {
        $type = new Type("club");
        $this->typeRepository->save($type);
        $country = new Country("Italia", "it", new Continent("Europa"));
        $this->countryRepository->save($country);

        $createTeamCommand = new CreateTeamCommand(
            'Juventus',
            $type->name(),
            $country->Code()
        );

        $this->expectException(TeamAlreadyExistsException::class);
        $this->createTeamCommandHandler->__invoke($createTeamCommand);
        $this->createTeamCommandHandler->__invoke($createTeamCommand);
    }

}
