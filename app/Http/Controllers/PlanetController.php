<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwRequest;
use App\Services\Contracts\PlanetServiceInterface;
use App\Transformers\PlanetTransformer;
use Illuminate\Http\Request;

/**
 * Class PlanetController
 * @package App\Http\Controllers
 */
class PlanetController extends BaseController
{
    /**
     * @var PlanetServiceInterface
     */
    public $planetService;

    /**
     * PlanetController constructor.
     *
     * @param PlanetServiceInterface $planetService
     */
    public function __construct(PlanetServiceInterface $planetService)
    {
        $this->planetService = $planetService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $planet = $this->planetService->getAll();

        return (new PlanetTransformer())->transform($planet);
    }

    /**
     * Display the planet
     *
     * @param  SwRequest  $planetRequest
     *
     * @return \Illuminate\Http\Response
     */

    public function show(SwRequest $planetRequest)
    {
        $id = $planetRequest->get('id');
        $planet = $this->planetService->get($id);

        return (new PlanetTransformer())->transform($planet);
    }
}
