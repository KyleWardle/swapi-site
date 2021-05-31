<?php

namespace App\Http\Controllers;

use App\Http\Services\StarWarsAPI\StarWarsApiException;
use App\Http\Services\StarWarsAPI\StarWarsAPIService;
use Illuminate\Contracts\View\View;

class FilmsController extends Controller
{
    /**
     * @var StarWarsAPIService
     */
    private StarWarsAPIService $starWarsAPIService;

    /**
     * FilmsController constructor.
     * @param StarWarsAPIService $starWarsAPIService
     */
    public function __construct(StarWarsAPIService $starWarsAPIService)
    {
        $this->starWarsAPIService = $starWarsAPIService;
    }

    /**
     * @throws StarWarsApiException
     */
    public function index(): View
    {
        $response = $this->starWarsAPIService->getFilms();

        return view('index', [
            'groupedFilms' => $response->getResults(3)
        ]);
    }
}
