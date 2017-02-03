<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {

        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('platform.csv');

        $finder = $this->container->get('fos_elastica.finder.opengamedb.game');

// Option 1. Returns all users who have example.net in any of their mapped fields
        $results = $finder->find('PES 2011');

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'test' => $fileContent,
                    'search' => $results,
        ]);
    }

}
