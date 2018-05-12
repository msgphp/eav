<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infra\Doctrine\Repository;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use MsgPhp\Domain\Infra\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait EntityAttributeValueRepositoryTrait
{
    use DomainEntityRepositoryTrait;

    private function addAttributeCriteria(QueryBuilder $qb, AttributeIdInterface $attributeId, $value = null): void
    {
        $field = $this->alias.'.'.$this->attributeValueField;

        if (3 === func_num_args()) {
            $qb->join($field, 'attribute_value', Join::WITH, 'attribute_value.checksum = '.$this->addFieldParameter($qb, $this->attributeValueField, md5(serialize($value))));
        } else {
            $qb->join($field, 'attribute_value');
        }

        $qb->join('attribute_value.attribute', 'attribute', Join::WITH, 'attribute.id = '.$this->addFieldParameter($qb, 'attribute', $attributeId));
    }
}
