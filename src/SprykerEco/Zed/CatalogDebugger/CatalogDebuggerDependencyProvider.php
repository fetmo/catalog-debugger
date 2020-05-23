<?php


namespace SprykerEco\Zed\CatalogDebugger;


use Spryker\Shared\Config\Config;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CatalogDebuggerDependencyProvider extends AbstractBundleDependencyProvider
{

    const CLIENT_NXS_CATALOG_DEBUGGER = 'nxs catalog debugger client';
    const STORE = 'store';
    const CONFIG = 'config';

    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addDebuggerClient($container);
        $container = $this->addStore($container);
        $container = $this->addConfig($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addDebuggerClient(Container $container)
    {
        $container->set(static::CLIENT_NXS_CATALOG_DEBUGGER, $container->getLocator()->CatalogDebugger()->client());

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStore(Container $container)
    {
        $container->set(static::STORE, Store::getInstance());

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addConfig(Container $container)
    {
        $container->set(static::CONFIG, Config::getInstance());

        return $container;
    }
}
