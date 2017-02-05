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
 * @Route("/api/game")
 */
class GameController extends FOSRestController {

    /**
     * @Rest\Get("/getGame/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"getGame"})
     */
    public function getGameAction($id) {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Game')
                ->getGameComplete($id);
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }

    /**
     * @Rest\Get("/getGameByPlatform/{idPlatform}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"getGameByPlatform"})
     */
    public function getGameByPlatform($idPlatform) {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Game')
                ->getAllBaseByPlatform($idPlatform);
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }

}
