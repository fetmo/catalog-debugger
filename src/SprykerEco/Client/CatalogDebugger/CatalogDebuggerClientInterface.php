<?php


namespace SprykerEco\Client\CatalogDebugger;


interface CatalogDebuggerClientInterface
{
    /**
     * @param string $searchString
     *
     * @return array|\Elastica\ResultSet
     */
    public function debugCatalogResult(string $searchString);
}
