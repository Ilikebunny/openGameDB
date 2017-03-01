<?php

namespace AppBundle\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Oneup\UploaderBundle\Event\PostPersistEvent;

class UploadListener {

    /**
     * @var ObjectManager
     */
    private $om;

    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    public function onUpload(PostPersistEvent $event) {
        //...

        $mappingName = $event->getType();
        $file = $event->getFile();

        $request = $event->getRequest();
        $idGame = $request->get('idEntity');
        $uploadType = $request->get('type');

        if ($idGame != "") {
            $file->move(
                    "uploads/game/" . $idGame . "/" . $uploadType . "/", $file
            );
        }

        //if everything went fine
        $response = $event->getResponse();
        $response['success'] = true;
        return $response;
    }

}
