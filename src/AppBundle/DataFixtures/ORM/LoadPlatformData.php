<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Platform;

class LoadPlatformData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('platform.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;
                $entity = new Platform();

//                print_r($row);
                $entity->setId($row[0]);
                $entity->setName($row[1]);
                $entity->setOverview($row[2]);
//                $entity->setType($row[3]);
                
//                $entity->setDeveloper($this->getReference($row[4]));
//                $entity->setManufacturer($this->getReference($row[5]));
                $entity->setCpu($row[6]);
                $entity->setMemory($row[7]);
                $entity->setGraphics(utf8_encode($row[8]));
                $entity->setSoundInfo($row[9]);
                $entity->setDisplay(utf8_encode($row[10]));
                $entity->setMaxcontrollers($row[11]);

                $entity2 = $this->getReference("PlatformType_" . $row[3]);
                $entity->setType($entity2);
                
                $entity3 = $this->getReference("Generation_number_" . $row[12]);
                $entity->setGeneration($entity3);

                $manager->getClassMetaData(get_class($entity))->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
                $manager->getClassMetaData(get_class($entity))->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                $manager->persist($entity);

                $this->addReference("Platform_" . trim($entity->getId()), $entity);

                if (($i % $batchSize) === 0) {
                    $manager->flush();
                    $manager->clear(); // Detaches all objects from Doctrine!
                }
            }
        }
        $manager->flush(); //Persist objects that did not make up an entire batch
        $manager->clear();
    }

    public function getOrder() {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 5;
    }

}
