<?php

namespace App\Http\Services\StarWarsApi\Swapi;

class SwapiApiResponse
{
    private int $resultCount;
    private array $results;

    public function __construct(int $count, array $results)
    {
        $this->resultCount = $count;
        $this->results = $results;
    }

    /**
     * @return int
     */
    public function getResultCount(): int
    {
        return $this->resultCount;
    }

    /**
     * @param int|mixed $resultCount
     */
    public function setResultCount(int $resultCount): void
    {
        $this->resultCount = $resultCount;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults(array $results): void
    {
        $this->results = $results;
    }
}
