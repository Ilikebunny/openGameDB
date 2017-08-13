<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\Game;
use AppBundle\Entity\Platform;
use \Datetime;

class LoadGameData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

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
        $fileContent = $import->CSV_to_array('game.csv');

        $batchSize = 20;
        $i = 1;
        foreach ($fileContent as $numRow => $row) {
            if ($numRow != 1) {

                $i = $i + 1;
                $entity = new Game();

                $entity2 = $this->getReference("Platform_" . trim($row[0]));
                $entity->setPlatform($entity2);

                $entity->setId($row[1]);

                $text = html_entity_decode(htmlentities($row[2], ENT_IGNORE, "UTF-8"));
                $entity->setTitle($text);
                
                var_dump($row[3]);
                if ($row[3] != "") {
//                    $date = DateTime::createFromFormat('d/m/Y', $row[3]);
                    $date = DateTime::createFromFormat('Y-m-d', $row[3]);
//                    $date = new \DateTime($row[3]);
                    $entity->setReleaseDate($date);
                }

                $txtName = "txt/game/" . $row[1] . ".txt";
                $txtContent = $import->TXT_to_String($txtName);
                $entity->setOverview($txtContent);

                $entity->setEsrb($row[5]);
                $entity->setPlayers($row[6]);
                $entity->setCoop($row[7]);

                $entity3 = $this->getReference("Game_Root" . trim($row[8]));
                $entity->setGameRoot($entity3);

                $manager->getClassMetaData(get_class($entity))->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
                $manager->getClassMetaData(get_class($entity))->setIdGeneratorType(\Doctrine\ORM\Mapping\ClassMetadata::GENERATOR_TYPE_NONE);
                $manager->persist($entity);

                $this->addReference("Game_" . $entity->getId(), $entity);

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
        return 8;
    }

}
