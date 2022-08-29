<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwRequest;
use App\Services\Contracts\SpeciesServiceInterface;
use App\Transformers\SpeciesTransformer;
use Illuminate\Http\Request;

/**
 * Class SpeciesController
 * @package App\Http\Controllers
 */
class SpeciesController extends BaseController
{
    /**
     * @var SpeciesServiceInterface
     */
    public $speciesService;

    /**
     * SpeciesController constructor.
     *
     * @param SpeciesServiceInterface $speciesService
     */
    public function __construct(SpeciesServiceInterface $speciesService)
    {
        $this->speciesService = $speciesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $species = $this->speciesService->getAll();

        return (new SpeciesTransformer())->transform($species);
    }

    /**
     * Display the species
     *
     * @param  SwRequest  $speciesRequest
     *
     * @return \Illuminate\Http\Response
     */

    public function show(SwRequest $speciesRequest)
    {
        $id = $speciesRequest->get('id');
        $species = $this->speciesService->get($id);

        return (new SpeciesTransformer())->transform($species);
    }
}
