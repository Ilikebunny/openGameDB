<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\GameRoot;
use AppBundle\Entity\Genre;

class Load_GameRoot_Genre extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
        return 13;
    }

    public function load(ObjectManager $manager) {

        $manager = $this->container->get('doctrine')->getEntityManager('default');

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('gameroot_genres.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;

                $entity = $this->getReference("Game_Root" . $row[0]);
                $entity2 = $this->getReference("Genre_" . $row[1]);

                $entity->addGenre($entity2);

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
