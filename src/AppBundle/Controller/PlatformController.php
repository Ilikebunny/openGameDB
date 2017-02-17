<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use AppBundle\Entity\Platform;

/**
 * Platform controller.
 *
 * @Route("/platform")
 */
class PlatformController extends Controller
{
    /**
     * Lists all Platform entities.
     *
     * @Route("/", name="platform")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Platform')->createQueryBuilder('e');
        
        list($filterForm, $queryBuilder) = $this->filter($queryBuilder, $request);
        list($platforms, $pagerHtml) = $this->paginator($queryBuilder, $request);
        
        return $this->render('platform/index.html.twig', array(
            'platforms' => $platforms,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),

        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter($queryBuilder, Request $request)
    {
        $session = $request->getSession();
        $filterForm = $this->createForm('AppBundle\Form\PlatformFilterType');

        //Always clean session
        $session->remove('PlatformControllerFilter');
        
        // Reset filter
        if ($request->get('filter_action') == 'reset') {
            $session->remove('PlatformControllerFilter');
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
                $session->set('PlatformControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PlatformControllerFilter')) {
                $filterData = $session->get('PlatformControllerFilter');
                
                foreach ($filterData as $key => $filter) { //fix for entityFilterType that is loaded from session
                    if (is_object($filter)) {
                        $filterData[$key] = $queryBuilder->getEntityManager()->merge($filter);
                    }
                }
                
                $filterForm = $this->createForm('AppBundle\Form\PlatformFilterType', $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }


    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder, Request $request)
    {
        //sorting
        $sortCol = $queryBuilder->getRootAlias().'.'.$request->get('pcg_sort_col', 'id');
        $queryBuilder->orderBy($sortCol, $request->get('pcg_sort_order', 'desc'));
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->get('pcg_show' , 10));

        try {
            $pagerfanta->setCurrentPage($request->get('pcg_page', 1));
        } catch (\Pagerfanta\Exception\OutOfRangeCurrentPageException $ex) {
            $pagerfanta->setCurrentPage(1);
        }
        
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me, $request)
        {
            $requestParams = $request->query->all();
            $requestParams['pcg_page'] = $page;
            return $me->generateUrl('platform', $requestParams);
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
     * Displays a form to create a new Platform entity.
     *
     * @Route("/new", name="platform_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
    
        $platform = new Platform();
        $form   = $this->createForm('AppBundle\Form\PlatformType', $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($platform);
            $em->flush();
            
            $editLink = $this->generateUrl('platform_edit', array('id' => $platform->getId()));
            $this->get('session')->getFlashBag()->add('success', "<a href='$editLink'>New platform was created successfully.</a>" );
            
            $nextAction=  $request->get('submit') == 'save' ? 'platform' : 'platform_new';
            return $this->redirectToRoute($nextAction);
        }
        return $this->render('platform/new.html.twig', array(
            'platform' => $platform,
            'form'   => $form->createView(),
        ));
    }
    

    /**
     * Finds and displays a Platform entity.
     *
     * @Route("/{id}", name="platform_show")
     * @Method("GET")
     */
    public function showAction(Platform $platform)
    {
        $deleteForm = $this->createDeleteForm($platform);
        return $this->render('platform/show.html.twig', array(
            'platform' => $platform,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Displays a form to edit an existing Platform entity.
     *
     * @Route("/{id}/edit", name="platform_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Platform $platform)
    {
        $deleteForm = $this->createDeleteForm($platform);
        $editForm = $this->createForm('AppBundle\Form\PlatformType', $platform);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($platform);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success', 'Edited Successfully!');
            return $this->redirectToRoute('platform_edit', array('id' => $platform->getId()));
        }
        return $this->render('platform/edit.html.twig', array(
            'platform' => $platform,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a Platform entity.
     *
     * @Route("/{id}", name="platform_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Platform $platform)
    {
    
        $form = $this->createDeleteForm($platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($platform);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Platform was deleted successfully');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Platform');
        }
        
        return $this->redirectToRoute('platform');
    }
    
    /**
     * Creates a form to delete a Platform entity.
     *
     * @param Platform $platform The Platform entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Platform $platform)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('platform_delete', array('id' => $platform->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * Delete Platform by id
     *
     * @Route("/delete/{id}", name="platform_by_id_delete")
     * @Method("GET")
     */
    public function deleteByIdAction(Platform $platform){
        $em = $this->getDoctrine()->getManager();
        
        try {
            $em->remove($platform);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'The Platform was deleted successfully');
        } catch (Exception $ex) {
            $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the Platform');
        }

        return $this->redirect($this->generateUrl('platform'));

    }
    

    /**
    * Bulk Action
    * @Route("/bulk-action/", name="platform_bulk_action")
    * @Method("POST")
    */
    public function bulkAction(Request $request)
    {
        $ids = $request->get("ids", array());
        $action = $request->get("bulk_action", "delete");

        if ($action == "delete") {
            try {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AppBundle:Platform');

                foreach ($ids as $id) {
                    $platform = $repository->find($id);
                    $em->remove($platform);
                    $em->flush();
                }

                $this->get('session')->getFlashBag()->add('success', 'platforms was deleted successfully!');

            } catch (Exception $ex) {
                $this->get('session')->getFlashBag()->add('error', 'Problem with deletion of the platforms ');
            }
        }

        return $this->redirect($this->generateUrl('platform'));
    }
    

}
