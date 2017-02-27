<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

/**
 * Game controller.
 *
 * @Route("/stats")
 */
class StatController extends Controller {

    private function initBreadcrumbs() {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->prependRouteItem("Home", "homepage");
        $breadcrumbs->addRouteItem("Stats", "stats");
        return $breadcrumbs;
    }

    /**
     * Stats
     *
     * @Route("/", name="stats")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();

        return $this->render('stat/index.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Stats
     *
     * @Route("/game", name="stats_game")
     * @Method("GET")
     */
    public function gameAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem("Game", "stats_game");
        return $this->render('stat/game.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Stats
     *
     * @Route("/platform", name="stats_platform")
     * @Method("GET")
     */
    public function platformAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem("Platform", "stats_platform");
        return $this->render('stat/platform.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Stats
     *
     * @Route("/art", name="stats_art")
     * @Method("GET")
     */
    public function artAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem("Art", "stats_art");
        return $this->render('stat/art.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Stats
     *
     * @Route("/company", name="stats_company")
     * @Method("GET")
     */
    public function companyAction(Request $request) {
        $breadcrumbs = $this->initBreadcrumbs();
        $breadcrumbs->addRouteItem("Company", "stats_company");
        return $this->render('stat/company.twig', array(
//                    'games' => $games,
//                    'pagerHtml' => $pagerHtml,
//                    'filterForm' => $filterForm->createView(),
        ));
    }

}
