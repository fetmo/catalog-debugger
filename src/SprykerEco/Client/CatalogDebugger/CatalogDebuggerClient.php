<?php


namespace SprykerEco\Client\CatalogDebugger;


use Spryker\Client\Kernel\AbstractClient;


/**
 * @method \SprykerEco\Client\CatalogDebugger\CatalogDebuggerFactory getFactory()
 */
class CatalogDebuggerClient extends AbstractClient implements CatalogDebuggerClientInterface
{

    /**
     * @param string $searchString
     *
     * @return array|\Elastica\ResultSet
     */
    public function debugCatalogResult(string $searchString)
    {
        return $this->getFactory()
            ->createCatalogDebugger()
            ->executeSearch($searchString);
    }

}