<?php


namespace SprykerEco\Zed\CatalogDebugger\Communication\Controller;


use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class IndexController
 *
 * @method \SprykerEco\Zed\CatalogDebugger\Communication\CatalogDebuggerCommunicationFactory getFactory()
 * @method \SprykerEco\Zed\CatalogDebugger\Business\CatalogDebuggerFacade getFacade()
 *
 * @package SprykerEco\Zed\CatalogDebugger\Communication\Controller
 */
class IndexController extends AbstractController
{

    public function indexAction()
    {
        $stores = $this->getFacade()->getStoresWithLocales();

        return $this->viewResponse([
            'stores' => $stores
        ]);
    }

    public function searchAction(Request $request)
    {
        $storeSetting = $request->get('search_store', 'DE###de_DE');
        $searchQuery = $request->get('search_string', '');

        $searchResult = $this->getFacade()->fetchResultsForQueryAndStore($searchQuery, $storeSetting);

        return $this->jsonResponse($searchResult);
    }
}
