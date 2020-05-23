<?php


namespace SprykerEco\Zed\CatalogDebugger\Business\Model;

use SprykerEco\Client\CatalogDebugger\CatalogDebuggerClientInterface;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Kernel\Store;

class CatalogDebugger implements CatalogDebuggerInterface
{
    private const GLUE = '###';

    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    private $store;

    /**
     * @var \Spryker\Shared\Config\Config
     */
    private $config;

    /**
     * @var \SprykerEco\Client\CatalogDebugger\CatalogDebuggerClientInterface
     */
    private $catalogDebuggerClient;

    /**
     * @param \SprykerEco\Client\CatalogDebugger\CatalogDebuggerClientInterface $catalogDebuggerClient
     * @param \Spryker\Shared\Kernel\Store $store
     * @param \Spryker\Shared\Config\Config $config
     */
    public function __construct(CatalogDebuggerClientInterface $catalogDebuggerClient, Store $store, Config $config)
    {
        $this->store = $store;
        $this->config = $config;
        $this->catalogDebuggerClient = $catalogDebuggerClient;
    }

    /**
     * @return array
     */
    public function getStoresWithLocales(): array
    {
        return array_map(function ($storeName) {
            return [
                'label' => $storeName,
                'locales' => array_map(function ($locale) use ($storeName) {
                    return [
                        'index' => sprintf('%s%s%s', $storeName, static::GLUE, $locale),
                        'label' => $locale
                    ];
                }, $this->store->getLocalesPerStore($storeName))
            ];
        }, $this->store->getAllowedStores());
    }

    /**
     * @param string $query
     * @param string $store
     *
     * @return array
     */
    public function fetchResultsForQueryAndStore(string $query, string $store): array
    {
        $storeConfig = explode(static::GLUE, $store);

        $origStore = $this->store->getStoreName();
        $origLocale = $this->store->getCurrentLocale();

        $this->loadStoreAndConfig($storeConfig[0], $storeConfig[1]);

        $searchResult = $this->catalogDebuggerClient->debugCatalogResult($query);

        $result = array_map(function ($entry) {
            return $entry->getHit();
        }, $searchResult->getResults());

        //dump($result);

        $this->loadStoreAndConfig($origStore, $origLocale);

        return $result;
    }

    /**
     * @param string $storeName
     * @param string $storeLocale
     *
     * @throws \Exception
     */
    protected function loadStoreAndConfig(string $storeName, string $storeLocale): void
    {
        $this->store->initializeSetup($storeName);
        $this->store->setCurrentLocale($storeLocale);
        $this->config::init();
    }
}
