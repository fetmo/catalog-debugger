<?php

namespace SprykerEco\Client\CatalogDebugger;

use Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class CatalogDebuggerDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'search client';
    public const CATALOG_SEARCH_QUERY_PLUGIN = 'catalog search query plugin';
    public const CATALOG_SEARCH_QUERY_EXPANDER_PLUGINS = 'catalog search query expander plugins';

    /**
     * {@inheritDoc}
     */
    public function provideServiceLayerDependencies(Container $container)
    {
        $container = $this->addSearchClient($container);
        $container = $this->addCatalogSearchQueryPlugin($container);
        $container = $this->addCatalogSearchQueryExpanderPlugins($container);

        return $container;
    }


    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addSearchClient(Container $container)
    {
        $container[static::CLIENT_SEARCH] = function (Container $container) {
            return $container->getLocator()->search()->client();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCatalogSearchQueryPlugin(Container $container)
    {
        $container[static::CATALOG_SEARCH_QUERY_PLUGIN] = function () {
            return $this->createCatalogSearchQueryPlugin();
        };

        return $container;
    }

    /**
     * @param \Spryker\Client\Kernel\Container $container
     *
     * @return \Spryker\Client\Kernel\Container
     */
    protected function addCatalogSearchQueryExpanderPlugins(Container $container)
    {
        $container[static::CATALOG_SEARCH_QUERY_EXPANDER_PLUGINS] = function () {
            return $this->createCatalogSearchQueryExpanderPlugins();
        };

        return $container;
    }

    /**
     * @see \Spryker\Client\Catalog\CatalogDependencyProvider::createCatalogSearchQueryPlugin
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryInterface
     */
    protected function createCatalogSearchQueryPlugin()
    {
        return new CatalogSearchQueryPlugin();
    }

    /**
     * @see \Spryker\Client\Catalog\CatalogDependencyProvider::createCatalogSearchQueryExpanderPlugins
     *
     * @return \Spryker\Client\Search\Dependency\Plugin\QueryExpanderPluginInterface[]
     */
    protected function createCatalogSearchQueryExpanderPlugins()
    {
        return [];
    }

}