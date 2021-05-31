<?php

namespace App\Http\Services\StarWarsAPI;

class StarWarsAPIResponse
{
    private int $resultCount;
    private array $results;

    public function __construct(int $count, array $results)
    {
        $this->resultCount = $count;
        $this->results = $results;
    }

    /**
     * @return int|mixed
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
     * @param int|null $groupBy - Splits the results into groups of a size of this variable
     * @return array|mixed
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
