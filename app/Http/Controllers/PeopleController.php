<?php

namespace App\Http\Controllers;

use App\Http\Requests\SwRequest;
use App\Services\Contracts\PeopleServiceInterface;
use App\Transformers\PeopleTransformer;
use Illuminate\Http\Request;

/**
 * Class PeopleController
 * @package App\Http\Controllers
 */
class PeopleController extends BaseController
{
    /**
     * @var PeopleServiceInterface
     */
    public $peopleService;

    /**
     * PeopleController constructor.
     *
     * @param PeopleServiceInterface $peopleService
     */
    public function __construct(PeopleServiceInterface $peopleService)
    {
        $this->peopleService = $peopleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $people = $this->peopleService->getAll();

        return (new PeopleTransformer())->transform($people);
    }

    /**
     * Display the people.
     *
     * @param SwRequest  $peopleRequest
     *
     * @return \Illuminate\Http\Response
     */

    public function show(SwRequest $peopleRequest)
    {
        $id = $peopleRequest->get('id');
        $people = $this->peopleService->get($id);

        return (new PeopleTransformer())->transform($people);
    }
}
