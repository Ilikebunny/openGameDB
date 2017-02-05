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
use AppBundle\Entity\Platform;

/**
 * API Game controller.
 * @Route("/api/platform")
 */
class PlatformController extends FOSRestController {

    /**
     * @Rest\Get("/getPlatform/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"getPlatform"})
     */
    public function GetPlatform($id) {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Platform')
                ->getPlatformComplete($id);
        $game = $queryBuilder->getQuery()->getResult();

        // Création d'une vue FOSRestBundle
        $view = View::create($game);
        $view->setFormat('xml');

        return $view;
    }

}
