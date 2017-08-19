<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;
use AppBundle\Entity\GameRoot;

/**
 * GameRoot controller.
 *
 * @Route("/gameroot")
 */
class GameRootController extends Controller {

    /**
     * Lists all GameRoot entities.
     *
     * @Route("/", name="gameroot")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:GameRoot')->createQueryBuilder('e');
        $queryBuilder = $em->getRepository('AppBundle:GameRoot')->getList();

        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($gameRoots, $pagerHtml) = $this->paginator($queryBuilder, $request);

        dump($gameRoots);

        return $this->render('gameroot/index.html.twig', array(
                    'gameRoots' => $gameRoots,
                    'pagerHtml' => $pagerHtml,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Search and list all Game entities.
     *
     * @Route("/search/{search_string}", name="game_search")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request, $search_string = "") {

        if ($this->get('kernel')->getEnvironment() == 'dev')
            dump($search_string);

        $finder = $this->container->get('fos_elastica.finder.opengamedb.gameroot');

        // Option 1. Returns all users who have example.net in any of their mapped fields
        $results = $finder->find($search_string, 320);

        // replace this example code with whatever you need
        return $this->render('gameroot/search.html.twig', [
                    'gameRoots' => $results,
        ]);
    }

    /**
     * Create filter form and process filter request.
     *
     */
    protected function filter($queryBuilder, Request $request) {
        $session = $request->getSession();
        $filterForm = $this->createForm('AppBundle\Form\GameRootFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('GameRootControllerFilter');
        }

        // Filter action
        if ($request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->handleRequest($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('GameRootControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('GameRootControllerFilter')) {
                $filterData = $session->get('GameRootControllerFilter');

                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }

                $filterForm = $this->createForm('AppBundle\Form\GameRootFilterType', $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
     * Get results from paginator and get paginator view.
     *
     */
    protected function paginator($queryBuilder, Request $request) {
        //sorting
        $sortCol = $queryBuilder->getRootAlias() . '.' . $request->get('pcg_sort_col', 'id');
        $queryBuilder->orderBy($sortCol, $request->get('pcg_sort_order', 'desc'));
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->get('pcg_show', 10));

        try {
            $pagerfanta->setCurrentPage($request->get('pcg_page', 1));
        } catch (\Pagerfanta\Exception\OutOfRangeCurrentPageException $ex) {
            $pagerfanta->setCurrentPage(1);
        }

        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me, $request) {
            $requestParams = $request->query->all();
            $requestParams['pcg_page'] = $page;
            return $me->generateUrl('gameroot', $requestParams);
        };

        // Paginator - view
        $view = new TwitterBootstrap3View();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'previous',
            'next_message' => 'next',
        ));

        return array($entities, $pagerHtml);
    }

    /**
     * Finds and displays a GameRoot entity.
     *
     * @Route("/{id}", name="gameroot_show")
     * @Method("GET")
     */
    public function showAction(GameRoot $gameRoot) {
        return $this->render('gameroot/show.html.twig', array(
                    'gameRoot' => $gameRoot,
        ));
    }

}
