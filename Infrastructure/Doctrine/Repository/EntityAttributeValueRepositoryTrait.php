<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use MsgPhp\Domain\Infrastructure\Doctrine\DomainEntityRepositoryTrait;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValue;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait EntityAttributeValueRepositoryTrait
{
    use DomainEntityRepositoryTrait;

    /**
     * @var string
     */
    private $attributeAlias = 'attribute';

    /**
     * @var string
     */
    private $attributeValueAlias = 'attribute_value';

    /**
     * @var string
     */
    private $attributeValueField = 'attributeValue';

    /**
     * @param mixed $value
     */
    private function addAttributeCriteria(QueryBuilder $qb, AttributeId $attributeId, $value = null): void
    {
        $field = $this->getAlias().'.'.$this->attributeValueField;
        $targetClass = $this->em->getClassMetadata($this->class)->getAssociationMapping($this->attributeValueField)['targetEntity'];

        if (!is_subclass_of($targetClass, AttributeValue::class)) {
            throw new \LogicException(sprintf('The field "%s" is expected to be an association mapping for "%s", got "%s".', $this->class.'.'.$this->attributeValueField, AttributeValue::class, $targetClass));
        }

        if (3 === \func_num_args()) {
            $qb->join($field, $this->attributeValueAlias, Join::WITH, $this->attributeValueAlias.'.checksum = '.$this->addFieldParameter($qb, $this->attributeValueField, $targetClass::getChecksum($value)));
        } else {
            $qb->join($field, $this->attributeValueAlias);
        }

        $qb->join($this->attributeValueAlias.'.attribute', $this->attributeAlias, Join::WITH, $this->attributeAlias.'.id = '.$this->addFieldParameter($qb, 'attribute', $attributeId));
    }
}
