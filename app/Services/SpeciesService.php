<?php

namespace App\Services;

use App\Repository\Contract\RepositoryInterface;
use App\Repository\SpeciesRepository;
use App\Services\Contracts\SpeciesServiceInterface;
use App\Transformers\SpeciesTransformer;
use Psr\Http\Message\ResponseInterface;

/**
 * Class SpeciesService.
 */
class SpeciesService extends AbstractService implements SpeciesServiceInterface
{
    /** @var string */
    protected $uri = 'species';

    /** @var RepositoryInterface */
    private $respository;

    /**
     * SpeciesService constructor.
     *
     */
    public function __construct(SpeciesRepository $speciesRepository)
    {
        parent::__construct();
        $this->respository = $speciesRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll(): array
    {
        $listSpecies = $this->respository->all();
        if($listSpecies->count())
        {
            return (new SpeciesTransformer())->transformCollection($listSpecies);
        }

        return parent::getSwAll()['results'];
    }

}
