<?php

namespace App\Transformers;

use App\Services\PlanetService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

/**
 * Class PlanetTransformer.
 */
class PlanetTransformer extends TransformerAbstract
{

    /** @var PlanetService $planetService */
    private $planetService;

    /**
     * OfferTransformer constructor.
     *
     * @param Request $request
     */
    public function __construct()
    {
        $this->planetService = app(PlanetService::class);
        $this->config = config('vodafone');
    }

    /**
     * @param array $results
     *
     * @return array
     */
    public function transformCollection($listPlanet)
    {
        $list = [];
        foreach($listPlanet as $planet) {
            $people = $planet->people;
            $peopleList = [];
            if ($people) {
                $peopleList = $this->getPeople($people);
            }

            $list[] = [
                'name' => $planet->name,
                'rotation_period' => $planet->rotation_period,
                'oribital_period' => $planet->oribital_period,
                'diameter' => $planet->diameter,
                'climate' => $planet->climate,
                'gravity' => $planet->gravity,
                'surface_water' => $planet->surface_water,
                'population' => $planet->population,
                'residents' => $peopleList,
                'created' => $planet->created_at,
                'updated' => $planet->updated_at,
                'url' => $this->config['swapi']['url'].'/planets/'.$planet->id

            ];
        }

        return $list;
    }

    /**
     * @param array
     *
     * @return array
     */
    public function transform($result)
    {
        return $result;
    }

    /**
     * @param Collection $planet
     *
     * @return array
     */
    private function getPeople($people)
    {
        $peopleList = [];
        $peopleListIds = $people->pluck('id');
        if (count($peopleListIds)) {
            foreach($peopleListIds as $peopleId) {
                $peopleList[] = $this->config['swapi']['url'].'/people/'.$peopleId;
            }
        }

        return $peopleList;
    }
}
