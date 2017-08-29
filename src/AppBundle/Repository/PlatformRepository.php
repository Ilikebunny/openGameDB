<?php

namespace AppBundle\Repository;

/**
 * PlatformRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlatformRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * Used by Elastica to transform results to model
     * 
     * @param string $entityAlias
     * @return  Doctrine\ORM\QueryBuilder
     */
    public function createSearchQueryBuilder($entityAlias) {

        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('dev')
                ->leftJoin($entityAlias . '.developers', 'dev')
                ->addSelect('man')
                ->leftJoin($entityAlias . '.manufacturers', 'man')
                ->addSelect('art')
                ->leftJoin($entityAlias . '.arts', 'art')
                ->addSelect('rel')
                ->leftJoin($entityAlias . '.releases', 'rel')
                ->addSelect('typ')
                ->leftJoin($entityAlias . '.type', 'typ')
                ->addSelect('gen')
                ->leftJoin($entityAlias . '.generation', 'gen')
        ;

        return $qb;
    }

    public function getPlatformComplete($idPlatform) {
        $entityAlias = "Platform";
        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('dev')
                ->leftJoin($entityAlias . '.developers', 'dev')
                ->addSelect('man')
                ->leftJoin($entityAlias . '.manufacturers', 'man')
                ->addSelect('art')
                ->leftJoin($entityAlias . '.arts', 'art')
                ->addSelect('rel')
                ->leftJoin($entityAlias . '.releases', 'rel')
                ->addSelect('typ')
                ->leftJoin($entityAlias . '.type', 'typ')
                ->addSelect('gen')
                ->leftJoin($entityAlias . '.generation', 'gen')
                ->andWhere($entityAlias . '.id = ?1')
                ->setParameter(1, $idPlatform)
        ;


        return $qb;
    }

    public function getAllComplete() {
        $entityAlias = "Platform";
        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('dev')
                ->leftJoin($entityAlias . '.developers', 'dev')
                ->addSelect('man')
                ->leftJoin($entityAlias . '.manufacturers', 'man')
                ->addSelect('art')
                ->leftJoin($entityAlias . '.arts', 'art')
                ->addSelect('typ')
                ->leftJoin($entityAlias . '.type', 'typ')
                ->addSelect('gen')
                ->leftJoin($entityAlias . '.generation', 'gen')
                //ORDER BY
                ->addOrderBy('gen' . '.number', 'DESC')
                ->addOrderBy('typ' . '.name', 'DESC')
                ->addOrderBy($entityAlias . '.name', 'ASC')
        ;


        return $qb;
    }

    public function getAllBase() {
        $entityAlias = "Platform";
        $qb = $this->createQueryBuilder($entityAlias)
        ;

        return $qb;
    }

}
