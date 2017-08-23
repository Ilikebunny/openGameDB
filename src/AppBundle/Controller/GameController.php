<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;
use AppBundle\Entity\Game;

/**
 * Game controller.
 *
 * @Route("/game")
 */
class GameController extends Controller {

    private function initBreadcrumbs() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->prependRouteItem("Home", "homepage");
        $breadcrumbs->addRouteItem("Games", "game");
        return $breadcrumbs;
    }

    /**
     * Lists all Game entities.
     *
     * @Route("/", name="game")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Game')->createQueryBuilder('e');

        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($games, $pagerHtml) = $this->paginator($queryBuilder, $request);

        return $this->render('game/index.html.twig', array(
                    'games' => $games,
                    'pagerHtml' => $pagerHtml,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Lists all Game entities.
     *
     * @Route("/calendar", name="game_calendar")
     * @Method("GET")
     */
    public function calendarAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();

//        $em = $this->getDoctrine()->getManager();
//        $queryBuilder = $em->getRepository('AppBundle:Game')->createQueryBuilder('e');

        return $this->render('game/calendar.html.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Search and list all Game entities.
     *
     * @Route("/search/{search_string}", name="game_search")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request, $search_string = "") {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addItem("Search");

        dump($search_string);

        $finder = $this->container->get('fos_elastica.finder.opengamedb.game');

        // Option 1. Returns all users who have example.net in any of their mapped fields
        $results = $finder->find($search_string, 320);

        // replace this example code with whatever you need
        return $this->render('game/search.html.twig', [
                    'games' => $results,
        ]);
    }

    /**
     * Create filter form and process filter request.
     *
     */
    protected function filter($queryBuilder, Request $request) {
        $session = $request->getSession();
        $filterForm = $this->createForm('AppBundle\Form\GameFilterType');

        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('GameControllerFilter');
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
                $session->set('GameControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('GameControllerFilter')) {
                $filterData = $session->get('GameControllerFilter');

                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }

                $filterForm = $this->createForm('AppBundle\Form\GameFilterType', $filterData);
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
            return $me->generateUrl('game', $requestParams);
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
     * Displays a form to create a new Game entity.
     *
     * @Route("/new", name="game_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addItem("New");

        $game = new Game();
        $form = $this->createForm('AppBundle\Form\GameType', $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $editLink = $this->generateUrl('game_edit', array('id' => $game->getId()));
            $this->get('session')->getFlashBag()->add('success', "<a href='$editLink'>New game was created successfully.</a>");

            $nextAction = $request->get('submit') == 'save' ? 'game' : 'game_new';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('game/new.html.twig', array(
                    'game' => $game,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Game entity.
     *
     * @Route("/{id}", name="game_show")
     * @Method("GET")
     */
    public function showAction(Game $game) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem($game->getTitle(), "game_show", [
            'id' => $game->getId(),
        ]);

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Game')->getGameComplete($game->getId());
        $game = $queryBuilder->getQuery()->getResult()[0];

//        dump($game);

        $deleteForm = $this->createDeleteForm($game);
        return $this->render('game/show.html.twig', array(
                    'game' => $game,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     * @Route("/{id}/edit", name="game_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Game $game) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem($game->getTitle(), "game_show", [
            'id' => $game->getId(),
        ]);
        $breadcrumbs->addItem("Edit");

        $deleteForm = $this->createDeleteForm($game);
        $editForm = $this->createForm('AppBundle\Form\GameType', $game);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('game_edit', array('id' => $game->getId()));
        }
        return $this->render('game/edit.html.twig', array(
                    'game' => $game,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     * @Route("/editroot/{id}", name="game_edit_root")
     * @Method({"GET", "POST"})
     */
    public function editRootAction(Request $request, Game $game) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem($game->getTitle(), "game_show", [
            'id' => $game->getId(),
        ]);
        $breadcrumbs->addItem("Edit Root");

        $editForm = $this->createForm('AppBundle\Form\GameEditRootType', $game);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('game_edit', array('id' => $game->getId()));
        }
        return $this->render('game/edit_root.twig', array(
                    'game' => $game,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Game entity.
     *
     * @Route("/{id}/editArts", name="game_edit_arts")
     * @Method({"GET", "POST"})
     */
    public function editArtAction(Request $request, Game $game) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem($game->getTitle(), "game_show", [
            'id' => $game->getId(),
        ]);
        $breadcrumbs->addItem("EditArts");

        return $this->render('game/edit_arts.twig', array(
                    'game' => $game,
        ));
    }

    /**
     * Deletes a Game entity.
     *
     * @Route("/{id}", name="game_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Game $game) {

        $form = $this->createDeleteForm($game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($game);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Game was deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Game');
        }

        return $this->redirectToRoute('game');
    }

    /**
     * Creates a form to delete a Game entity.
     *
     * @param Game $game The Game entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Game $game) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('game_delete', array('id' => $game->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Delete Game by id
     *
     * @Route("/delete/{id}", name="game_by_id_delete")
     * @Method("GET")
     */
    public function deleteByIdAction(Game $game) {
        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($game);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Game was deleted successfully');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Game');
        }

        return $this->redirect($this->generateUrl('game'));
    }

    /**
     * Bulk Action
     * @Route("/bulk-action/", name="game_bulk_action")
     * @Method("POST")
     */
    public function bulkAction(Request $request) {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:Game');

                foreach ($ids as $id) {
                    $game = $repository->find($id);
                    $em->remove($game);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'games was deleted successfully!');
            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the games ');
            }
        }

        return $this->redirect($this->generateUrl('game'));
    }

}
