<?php

namespace AppBundle\API\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View; // Utilisation de la vue de FOSRestBundle
use AppBundle\Entity\Platform;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * API Game controller.
 */
class PlatformController extends FOSRestController {

    /**
     * @ApiDoc(
     *    description="Get a list of all platforms"
     * )
     * @Rest\Get("/getPlatformList")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"getPlatformList"})
     */
    public function GetPlatformListAction() {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Platform')
                ->getAllBase();
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }

    /**
     * @ApiDoc(
     *    description="Get a platform data"
     * )
     * @Rest\Get("/getPlatform/{id}")
     * @Rest\View(serializerEnableMaxDepthChecks=true, serializerGroups={"getPlatform"})
     */
    public function GetPlatformAction($id) {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Platform')
                ->getPlatformComplete($id);
        $result = $queryBuilder->getQuery()->getResult();

        return $result;
    }

}
