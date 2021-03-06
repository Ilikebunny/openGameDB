<?php

namespace AppBundle\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Art;

class UploadListener {

    /**
     * @var ObjectManager
     */
    private $om;
    private $container;

    public function __construct(ObjectManager $om, ContainerInterface $container) {
        $this->container = $container;
        $this->om = $om;
    }

    public function onUpload(PostPersistEvent $event) {
        //...

        $file = $event->getFile();

        $request = $event->getRequest();
        $idEntity = $request->get('idEntity');
        $entityType = $request->get('entityType');
        $uploadType = $request->get('type');

        //Todo : create multiple filter and choose it according to ArtType
        $thumb_filter_name = 'my_thumb';
        
        //replace uploads with web (symbolics links problem)
        $destination = "images/" . $entityType . "/" . $idEntity . "/" . $uploadType . "/";
        $destination_db = $entityType . "/" . $idEntity . "/" . $uploadType . "/" . $file->getFilename();
        $destinationThumb = "thumb/".$thumb_filter_name."/images/" . $entityType . "/" . $idEntity . "/" . $uploadType . "/";

        if ($idEntity != "") {
            $file->move($destination, $file);
        }

//        dump($file);
//        dump($destination . $file->getFilename());
//        dump("entityType : ".$entityType);

        //create thumb (todo : move in doctrine listener)
        $imagemanagerResponse = $this->container->get('liip_imagine.controller');
        $imagemanagerResponse->filterAction(new Request(), $destination . $file->getFilename(), $thumb_filter_name);

        //persist entity
        $manager = $this->container->get('doctrine')->getEntityManager('default');
        $myArt = new Art();

        if ($entityType == "game") {
            $entity2 = $manager->getRepository('AppBundle:Game')->findOneById($idEntity);
            $myArt->setGame($entity2);
        }

        $myArt->setType($uploadType);
        $myArt->setLinkFile($destination_db);
        $myArt->setLinkThumb($destinationThumb . $file->getFilename());

        $manager->persist($myArt);
        $manager->flush();
        $manager->clear();

        //if everything went fine
        $response = $event->getResponse();
        $response['success'] = true;
        return $response;
    }

}
