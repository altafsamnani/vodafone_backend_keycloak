<?php

namespace App\Services;

use App\Models\Person;
use App\Repository\Contract\EloquentRepositoryInterface as RepositoryInterface;
use App\Repository\PeopleRepository;
use App\Services\Contracts\PeopleServiceInterface;
use App\Transformers\PeopleTransformer;

/**
 * Class PeopleService.
 */
class PeopleService extends AbstractService implements PeopleServiceInterface
{
    /** @var string */
    protected $uri = 'people';

    /** @var RepositoryInterface */
    private $respository;

    /**
     * PeopleService constructor.
     *
     */
    public function __construct(PeopleRepository $peopleRepository)
    {
        parent::__construct();
        $this->respository = $peopleRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array
    {
        $listPeople = $this->respository->all();
        if($listPeople->count())
        {
           return (new PeopleTransformer())->transformCollection($listPeople);
        }

        $results = $this->getSwAll()['results'];

        $this->save($results);

        return $results;
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $id): mixed
    {
        $listPeople = $this->respository->find($id);
        if($listPeople)
        {
            return (new PeopleTransformer())->transform($listPeople);
        }
        $person = parent::get($id);

        $this->savePerson($person);

        return $person;
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
            $this->savePerson($person);
            $peopleSavedCounter++;

        }

        return $peopleSavedCounter;
    }

    private function savePerson($person)
    {
        $parsedUrl = parse_url($person['url'], PHP_URL_PATH);
        $personPath = explode('/', $parsedUrl);
        $person['id'] = $personPath[3];

        $parsedPlanetUrl = parse_url($person['homeworld'], PHP_URL_PATH);
        $planetPath = explode('/', $parsedPlanetUrl);
        $person['planet_id'] = 1;

        $this->respository->create($person);
    }
}
