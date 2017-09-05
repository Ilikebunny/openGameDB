<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Vanilla controller.
 *
 * @Route("/vanilla")
 */
class VanillaController extends Controller {

    /**
     * SSO
     *
     * @Route("/sso", name="vanilla_sso")
     * @Method("GET")
     */
    public function indexAction(Request $request) {

        //Get logged user
        $userFOS = $this->getUser();

        //If not logged, redirect to login page
        if ($userFOS == null) {
//            return $this->redirectToRoute('fos_user_security_login');
            $signedIn = false;
        } else {
            $signedIn = true;
        }

        $vanilla = $this->container->get('AppBundle.vanillajsconnect');

        //parameters
        $clientID = $this->container->getParameter('forum_clientId');
        $secret = $this->container->getParameter('forum_secret');

// 3. Fill in the user information in a way that Vanilla can understand.
        $user = array();
        if ($signedIn) {
            // CHANGE THESE FOUR LINES.
            $user['uniqueid'] = $userFOS->getId();
            $user['name'] = $userFOS->getUsername();
            $user['email'] = $userFOS->getEmail();
            $user['photourl'] = '';
        }

        //Get all GET parameters
        $paramGet = $request->query->all();

// 4. Generate the jsConnect string.
// This should be true unless you are testing.
// You can also use a hash name like md5, sha1 etc which must be the name as the connection settings in Vanilla.
        $secure = true;
//        $secure = false;
        $result = $vanilla->writeJsConnect($user, $paramGet, $clientID, $secret, $secure);
//        dump($result);
        //return
        $response = new JsonResponse($result, 200, $result);
        $response->setCallback($paramGet['callback']);
        return $response;

    }

    /**
     * SSO
     *
     * @Route("/login", name="vanilla_sso_login")
     * @Method("GET")
     */
    public function loginAction(Request $request) {

        $url = $this->container->getParameter('forum_url_sso');
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute('fos_user_security_login');
        } else {
            return $this->redirect($url);
        }
    }

}
