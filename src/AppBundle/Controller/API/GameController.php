<?php

namespace AppBundle\Controller\API;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View; // Utilisation de la vue de FOSRestBundle
use AppBundle\Entity\Game;

/**
 * API Game controller.
 *
 */
class GameController extends FOSRestController {

    /**
     * @Rest\Get("/getGames")
     */
    public function indexAction(Request $request) {

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
     * @Rest\Get("/getGame/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true)
     */
    public function getGameAction($id) {

//        $game = new Game();

//        $game = $this->get('doctrine.orm.entity_manager')
//                ->getRepository('AppBundle:Game')
//                ->findById(42286);

//        $game->setId(1);
//        $game->setTitle("my game name");

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Game')
                ->getGameComplete($id);
        $game = $queryBuilder->getQuery()->getResult();

//                $game = $this->get('doctrine.orm.entity_manager')
//                ->getRepository('AppBundle:Game')
//                ->findById(42286);

        // Création d'une vue FOSRestBundle
        $view = View::create($game);
        $view->setFormat('xml');

        return $view;
    }

}