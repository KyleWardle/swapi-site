<?php

namespace App\Http\Controllers;

use App\Http\Services\StarWarsApi\StarWarsApiException;
use App\Http\Services\StarWarsApi\StarWarsService;
use App\Http\Services\StarWarsApi\Swapi\SwapiApiException;
use Illuminate\Contracts\View\View;

class FilmsController extends Controller
{
    /**
     * @var StarWarsService
     */
    private StarWarsService $starWarsAPIService;

    /**
     * FilmsController constructor.
     * @param StarWarsService $starWarsAPIService
     */
    public function __construct(StarWarsService $starWarsAPIService)
    {
        $this->starWarsAPIService = $starWarsAPIService;
    }

    /**
     * @throws SwapiApiException
     */
    public function index(): View
    {
        $response = $this->starWarsAPIService->getFilms();

        return view('index', [
            'groupedFilms' => $response->getResults(6)
        ]);
    }
}
