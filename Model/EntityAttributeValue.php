<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Model;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\AttributeValueId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait EntityAttributeValue
{
    /**
     * @var AttributeValue
     */
    private $attributeValue;

    public function getId(): AttributeValueId
    {
        return $this->attributeValue->getId();
    }

    public function getAttribute(): Attribute
    {
        return $this->attributeValue->getAttribute();
    }

    public function getAttributeId(): AttributeId
    {
        return $this->attributeValue->getAttributeId();
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->attributeValue->getValue();
    }

    /**
     * @param mixed $value
     */
    public function changeValue($value): void
    {
        $this->attributeValue->changeValue($value);
    }
}
