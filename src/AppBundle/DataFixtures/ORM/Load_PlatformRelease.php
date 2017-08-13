<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\PlatformRelease;
use \Datetime;

class Load_PlatformRelease extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
        return 6;
    }

    public function load(ObjectManager $manager) {

        $manager = $this->container->get('doctrine')->getEntityManager('default');

        $manager->getConnection()->getConfiguration()->setSQLLogger(null);
        $import = $this->container->get('AppBundle.importcsv');
        $fileContent = $import->CSV_to_array('platform_releases.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;

                $entity = new PlatformRelease();

                $entity2 = $this->getReference("Platform_" . ($row[0]));
                $entity->setName($row[1]);
                if ($row[2] != "") {
                    $date = DateTime::createFromFormat('d/m/Y', $row[2]);
                    $entity->setReleaseDate($date);
                }
                $entity->setUnitSold($row[3]);
                $entity3 = $this->getReference("RegionCountry_" . ($row[4]));

                $entity->setPlatform($entity2);
                $entity->setRegionCountry($entity3);

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
