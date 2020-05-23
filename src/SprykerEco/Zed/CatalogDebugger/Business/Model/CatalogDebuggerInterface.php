<?php


namespace SprykerEco\Zed\CatalogDebugger\Business\Model;


interface CatalogDebuggerInterface
{
    /**
     * @return array
     */
    public function getStoresWithLocales(): array;

    /**
     * @param string $query
     * @param string $store
     *
     * @return array
     */
    public function fetchResultsForQueryAndStore(string $query, string $store): array;
}
