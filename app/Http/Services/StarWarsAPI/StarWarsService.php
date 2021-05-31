<?php

namespace App\Http\Services\StarWarsApi;

use App\Http\Services\ImageSearch\ImageSearchService;
use App\Http\Services\StarWarsApi\Swapi\SwapiApiClient;

class StarWarsService
{
    /**
     * @var SwapiApiClient
     */
    private SwapiApiClient $swapiApiClient;
    /**
     * @var ImageSearchService
     */
    private ImageSearchService $imageSearchService;

    /**
     * StarWarsApiService constructor.
     * @param SwapiApiClient $swapiApiClient
     * @param ImageSearchService $imageSearchService
     */
    public function __construct(SwapiApiClient $swapiApiClient, ImageSearchService $imageSearchService)
    {
        $this->swapiApiClient = $swapiApiClient;
        $this->imageSearchService = $imageSearchService;
    }

    /**
     * @param int|null $id
     * @return StarWarsResponse
     * @throws Swapi\SwapiApiException
     */
    public function getFilms(?int $id = null): StarWarsResponse
    {
        $filmResponse = $this->swapiApiClient->getResource(StarWarsResourceEnum::FILMS, $id);
        $films = [];

        foreach ($filmResponse->getResults() as $film) {
            $imageSearchTerm = 'star wars ' . $film['title'] . ' video film cover';
            $film['image'] = $this->imageSearchService->searchForImage($imageSearchTerm);
            $films[] = $film;
        }

        return new StarWarsResponse($films);
    }
}
