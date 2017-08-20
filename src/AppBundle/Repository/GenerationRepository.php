<?php

namespace AppBundle\Repository;

/**
 * GenerationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GenerationRepository extends \Doctrine\ORM\EntityRepository {

    public function getAllComplete() {
        $entityAlias = "Generation";
        $entityAlias2 = "pla";
        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('pla')
                ->leftJoin($entityAlias . '.platforms', 'pla')
                ->addSelect('dev')
                ->leftJoin($entityAlias2 . '.developers', 'dev')
                ->addSelect('man')
                ->leftJoin($entityAlias2 . '.manufacturers', 'man')
                ->addSelect('art')
                ->leftJoin($entityAlias2 . '.arts', 'art')
                //ORDER BY
                ->orderBy($entityAlias . '.number', 'DESC')
        ;


        return $qb;
    }

}
