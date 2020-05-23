<?php


namespace SprykerEco\Zed\CatalogDebugger\Business;


use Spryker\Zed\Kernel\Business\AbstractFacade;


/**
 * @method \SprykerEco\Zed\CatalogDebugger\Business\CatalogDebuggerBusinessFactory getFactory()
 */
class CatalogDebuggerFacade extends AbstractFacade implements CatalogDebuggerFacadeInterface
{
    /**
     * @return array
     */
    public function getStoresWithLocales()
    {
        return $this->getFactory()->createCatalogDebugger()->getStoresWithLocales();
    }

    /**
     * @param string $query
     * @param string $store
     *
     * @return array
     */
    public function fetchResultsForQueryAndStore(string $query, string $store): array
    {
        return $this->getFactory()->createCatalogDebugger()->fetchResultsForQueryAndStore($query, $store);
    }
}