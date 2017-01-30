<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\GameLink;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameLinkType;

class Load_GameLink extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 9;
    }

    public function load(ObjectManager $manager) {

        $manager = $this->container->get('doctrine')->getEntityManager('default');

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('gameLink.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;

                $entity = new GameLink();
                
                $entity2 = $this->getReference("Game_" . $row[0]);
                $entity3 = $this->getReference("Game_" . $row[1]);
                $entity4 = $this->getReference("GameLinkType_" . $row[2]);

                $entity->setGameParent($entity2);
                $entity->setGameChild($entity3);
                $entity->setType($entity4);

                $manager->persist($entity);


                if (($i % $batchSize) === 0) {
                    $manager->flush();
                    $manager->clear(); // Detaches all objects from Doctrine!
                }
            }
        }
        $manager->flush(); //Persist objects that did not make up an entire batch
        $manager->clear();
    }

}
