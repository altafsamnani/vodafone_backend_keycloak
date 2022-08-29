<?php

namespace App\Services;

use App\Repository\Contract\RepositoryInterface;
use App\Repository\PlanetRepository;
use App\Services\Contracts\PlanetServiceInterface;
use App\Transformers\PlanetTransformer;

/**
 * Class PlanetService.
 */
class PlanetService extends AbstractService implements PlanetServiceInterface
{
    /** @var string */
    protected $uri = 'planets';

    /** @var RepositoryInterface */
    private $respository;

    /**
     * PlanetService constructor.
     *
     */
    public function __construct(PlanetRepository $planetRepository)
    {
        parent::__construct();
        $this->respository = $planetRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array
    {
        $listPlanet = $this->respository->all();
        if($listPlanet->count())
        {
            return (new PlanetTransformer())->transformCollection($listPlanet);
        }

        return parent::getSwAll()['results'];
    }

    /**
     * Save people to database.
     *
     * @param array $people
     *
     * @return int
     */
    private function save(array $people): int
    {
        $peopleSavedCounter = 0;
        foreach($people as $person) {
            $parsedUrl = parse_url($person['url'], PHP_URL_PATH);
            $personPath = explode('/', $parsedUrl);
            $person['id'] = $personPath[3];

            $parsedPlanetUrl = parse_url($person['homeworld'], PHP_URL_PATH);
            $planetPath = explode('/', $parsedPlanetUrl);
            $person['planet_id'] = 1;

            $this->respository->create($person);
            $peopleSavedCounter++;

        }

        return $peopleSavedCounter;
    }
}
