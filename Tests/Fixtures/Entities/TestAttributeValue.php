<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Fixtures\Entities;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\AttributeValueId;
use MsgPhp\Eav\ScalarAttributeValueId;

/**
 * @Doctrine\ORM\Mapping\Entity()
 */
class TestAttributeValue extends AttributeValue
{
    /**
     * @var null|int
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="integer")
     */
    private $id;

    /**
     * @param mixed $value
     */
    public function __construct(Attribute $attribute, $value, ?AttributeValueId $id = null)
    {
        parent::__construct($attribute, $value);

        $this->id = null === $id || $id->isNil() ? null : (int) $id->toString();
    }

    public function getId(): AttributeValueId
    {
        return new ScalarAttributeValueId(null === $this->id ? null : (string) $this->id);
    }
}
