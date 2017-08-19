<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SearchController extends Controller {

    /**
     * Create filter form and process filter request.
     * @Method({"GET", "POST"})
     */
    public function search_formAction(Request $request) {

        $filterForm = $this->createForm('AppBundle\Form\SearchType', null, array(
            'action' => $this->generateUrl('search_process'),
            'method' => 'GET',
        ));

        //If a search was performed, set values
//        $params = $request->query->get('search');
//        dump($params);
//        $searchstring = $params['searchstring'];
//        $search_type = $params['type'];
//        $filterForm->get('searchstring')->setData("halo");
//        $filterForm->get('type')->setData("2");
        // render
        return $this->render('layout/searchbar.html.twig', [
                    'form_search' => $filterForm->createView(),
        ]);
    }

    /**
     * Search and list all Game entities.
     *
     * @Route("/search/{search_string}", name="search_process")
     * @Method({"GET", "POST"})
     */
    public function searchAction(Request $request, $search_string = "") {

        $params = $request->query->get('search');
        $searchstring = $params['searchstring'];
        $search_type = $params['type'];

        switch ($search_type) {
            case 0: //game
//                $response = $this->forward('AppBundle:Game:Search', array(
//                    'search_string' => $searchstring,
//                ));
                $response = $this->forward('AppBundle:GameRoot:Search', array(
                    'search_string' => $searchstring,
                ));
                break;
            case 1: //platform
                $response = $this->forward('AppBundle:Platform:Search', array(
                    'search_string' => $searchstring,
                ));
                break;
            case 2: //company
                break;
            case 3: //people
                break;
        }
        return $response;
    }

}
