<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Generation;

class Load_Generation extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
        return 1;
    }

    public function load(ObjectManager $manager) {

        $manager = $this->container->get('doctrine')->getEntityManager('default');

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('generations.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;

                $entity = new Generation();
                
                $entity->setNumber($row[0]);
                $entity->setName($row[1]);
                if ($row[2] != "") {
                    $date = new \DateTime($row[2]);
                    $entity->setBeginning($date);
                }
                if ($row[3] != "") {
                    $date = new \DateTime($row[3]);
                    $entity->setEnding($date);
                }

                $manager->persist($entity);
                
                $this->addReference("Generation_number_" . $entity->getNumber(), $entity);

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
