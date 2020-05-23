<?php


namespace SprykerEco\Client\CatalogDebugger\Debugger;

use Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin;
use Spryker\Client\Search\SearchClientInterface;

class CatalogDebugger implements CatalogDebuggerInterface
{
    /**
     * @var \Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin
     */
    private $searchQuery;

    /**
     * @var \Spryker\Client\Search\SearchClientInterface
     */
    private $searchClient;

    /**
     * @var array
     */
    private $searchExpanders;

    /**
     * @param \Spryker\Client\Search\SearchClientInterface $searchClient
     * @param \Spryker\Client\Catalog\Plugin\Elasticsearch\Query\CatalogSearchQueryPlugin $searchQuery
     * @param array $searchExpanders
     */
    public function __construct(SearchClientInterface $searchClient, CatalogSearchQueryPlugin $searchQuery, array $searchExpanders = [])
    {
        $this->searchClient = $searchClient;
        $this->searchQuery = $searchQuery;
        $this->searchExpanders = $searchExpanders;
    }

    /**
     * @param string $searchString
     *
     * @return array|\Elastica\ResultSet
     */
    public function executeSearch(string $searchString)
    {
        $this->searchQuery->setSearchString($searchString);

        $searchQuery = $this->searchClient->expandQuery($this->searchQuery, $this->searchExpanders);
        $result = $this->searchClient->search($searchQuery);

        return $result;
    }
}
