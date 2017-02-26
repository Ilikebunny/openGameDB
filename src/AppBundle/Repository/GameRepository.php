<?php

namespace AppBundle\Repository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends \Doctrine\ORM\EntityRepository {

    /**
     * Used by Elastica to transform results to model
     * 
     * @param string $entityAlias
     * @return  Doctrine\ORM\QueryBuilder
     */
    public function createSearchQueryBuilder($entityAlias) {

        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('pla')
                ->join($entityAlias . '.platform', 'pla')
                ->addSelect('dev')
                ->leftJoin($entityAlias . '.developers', 'dev')
                ->addSelect('pub')
                ->leftJoin($entityAlias . '.publishers', 'pub');


        return $qb;
    }

    public function getGameComplete($idGame) {
        $entityAlias = "Game";
        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('pla')
                ->join($entityAlias . '.platform', 'pla')
                ->addSelect('dev')
                ->leftJoin($entityAlias . '.developers', 'dev')
                ->addSelect('pub')
                ->leftJoin($entityAlias . '.publishers', 'pub')
                ->addSelect('art')
                ->leftJoin($entityAlias . '.arts', 'art')
                ->addSelect('gen')
                ->leftJoin($entityAlias . '.genres', 'gen')
                ->addSelect('alt')
                ->leftJoin($entityAlias . '.alternateTitles', 'alt')
                ->addSelect('child')
                ->leftJoin($entityAlias . '.gameLinks_child', 'child')
                ->addSelect('linkType')
                ->leftJoin('child.type', 'linkType')
                ->addSelect('gameChild')
                ->leftJoin('child.game_parent', 'gameChild')
                ->addSelect('platformChild')
                ->leftJoin('gameChild.platform', 'platformChild')
                ->addSelect('rat')
                ->leftJoin($entityAlias . '.contentRatings', 'rat')
                ->andWhere($entityAlias . '.id = ?1')
                ->setParameter(1, $idGame)
        ;


        return $qb;
    }

    public function getAllBaseByPlatform($idPlatform) {
        $entityAlias = "Game";
        $qb = $this->createQueryBuilder($entityAlias)
                ->andWhere($entityAlias . '.platform = ?1')
                ->setParameter(1, $idPlatform)
        ;


        return $qb;
    }

    public function getBetweenRelease($start, $end) {
        $entityAlias = "Game";
        $qb = $this->createQueryBuilder($entityAlias)
                ->addSelect('pla')
                ->join($entityAlias . '.platform', 'pla')
                ->where($entityAlias . '.releaseDate BETWEEN :start AND :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end)
        ;

        return $qb;
    }

}
