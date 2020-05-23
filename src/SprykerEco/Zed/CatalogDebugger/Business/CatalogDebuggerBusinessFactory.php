<?php


namespace SprykerEco\Zed\CatalogDebugger\Business;


use SprykerEco\Client\CatalogDebugger\CatalogDebuggerClientInterface;
use SprykerEco\Zed\CatalogDebugger\Business\Model\CatalogDebugger;
use SprykerEco\Zed\CatalogDebugger\Business\Model\CatalogDebuggerInterface;
use SprykerEco\Zed\CatalogDebugger\CatalogDebuggerDependencyProvider;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class CatalogDebuggerBusinessFactory extends AbstractBusinessFactory
{

    public function createCatalogDebugger(): CatalogDebuggerInterface
    {
        return new CatalogDebugger(
            $this->getCatalogDebuggerClient(),
            $this->getStore(),
            $this->getSharedConfig()
        );
    }

    protected function getCatalogDebuggerClient(): CatalogDebuggerClientInterface
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::CLIENT_NXS_CATALOG_DEBUGGER);
    }

    protected function getStore(): Store
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::STORE);
    }

    protected function getSharedConfig(): Config
    {
        return $this->getProvidedDependency(CatalogDebuggerDependencyProvider::CONFIG);
    }

}