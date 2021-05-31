<?php

namespace App\Http\Services\StarWarsApi;

class StarWarsResponse
{
    private array $results;

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * @param int|null $groupBy - Splits the results into groups of a size of this variable
     * @return array
     */
    public function getResults(?int $groupBy = null): array
    {
        if ($groupBy === null) {
            return $this->results;
        }

        $groupedResult = [];

        $iterations = count($this->results) / $groupBy;

        for ($i = 0; $i < $iterations; $i++) {
            $offset = $i * $groupBy;
            $groupedResult[$i] = array_slice($this->results, $offset, $groupBy);
        }

        return $groupedResult;
    }

    /**
     * @param array|mixed $results
     */
    public function setResults(array $results): void
    {
        $this->results = $results;
    }
}
