<?php

//src/AppBundle/Entity/TaxonomyRelation.php

namespace AppBundle\Entity;

use ED\BlogBundle\Interfaces\Model\TaxonomyRelationInterface;
use ED\BlogBundle\Model\Entity\TaxonomyRelation as BaseTaxonomyRelation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_demo_taxonomy_relation")
 * @ORM\Entity()
 */
class TaxonomyRelation extends BaseTaxonomyRelation implements TaxonomyRelationInterface {
    
}
