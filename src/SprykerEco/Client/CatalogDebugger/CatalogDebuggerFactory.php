<?php


namespace SprykerEco\Client\CatalogDebugger;


use SprykerEco\Client\CatalogDebugger\Debugger\CatalogDebugger;
use SprykerEco\Client\CatalogDebugger\Debugger\CatalogDebuggerInterface;
use Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Search\SearchClientInterface;

class CatalogDebuggerFactory extends AbstractFactory
{

    public function createCatalogDebugger(): CatalogDebuggerInterface
    {
        return new CatalogDebugger(
            $this->getSearchClient(),
            $this->getSearchQuery(),
            $this->getQueryExpander()
        );
    }

    /**
     * @return \Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin
     */
    protected function getSearchQuery(): CatalogSearchQueryPlugin
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::CATALOG_SEARCH_QUERY_PLUGIN);
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    protected function getSearchClient(): SearchClientInterface
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::CLIENT_SEARCH);
    }

    /**
     * @return array|\Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function getQueryExpander(): array
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::CATALOG_SEARCH_QUERY_EXPANDER_PLUGINS);
    }
}
