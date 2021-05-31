<?php

namespace App\Http\Services\StarWarsAPI;

class StarWarsAPIService
{
    /**
     * @var StarWarsAPIClient
     */
    private StarWarsAPIClient $client;

    private string $baseUri;

    public function __construct(StarWarsAPIClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int|null $id
     * @return StarWarsAPIResponse
     * @throws StarWarsApiException
     */
    public function getFilms(?int $id = null): StarWarsAPIResponse
    {
        return $this->client->queryApi(StarWarsResourceEnum::FILMS, $id);
    }
}
