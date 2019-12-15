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
     * @var AttributeValueId
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="msgphp_attribute_value_id")
     */
    private $id;

    /**
     * @param mixed $value
     */
    public function __construct(Attribute $attribute, $value, ?AttributeValueId $id = null)
    {
        parent::__construct($attribute, $value);

        $this->id = $id ?? new ScalarAttributeValueId();
    }

    public function getId(): AttributeValueId
    {
        return $this->id;
    }
}
