<?php

namespace AppBundle\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

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
        $idGame = $request->get('idEntity');
        $uploadType = $request->get('type');

        $destination = "uploads/game/" . $idGame . "/" . $uploadType . "/";

        if ($idGame != "") {
            $file->move($destination, $file);
        }

        dump($file);
        dump($destination . $file->getFilename());

        //create thumb
         $imagemanagerResponse = $this->container->get('liip_imagine.controller');
         $imagemanagerResponse->filterAction(new Request(), $destination . $file->getFilename(),'my_thumb');
        
        //persist entity
        //if everything went fine
        $response = $event->getResponse();
        $response['success'] = true;
        return $response;
    }

}
