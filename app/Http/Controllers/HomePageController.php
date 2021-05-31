<?php

namespace App\Http\Controllers;

use App\Http\Services\StarWarsApi\StarWarsService;
use App\Http\Services\StarWarsApi\Swapi\SwapiApiException;
use Illuminate\Contracts\View\View;

class HomePageController extends Controller
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
        return view('homepage.index', [
            'groupedFilms' => $this->starWarsAPIService->getFilms()->getResults(6),
            'groupedPeople' => $this->starWarsAPIService->getPeople()->getResults(6),
        ]);
    }
}
