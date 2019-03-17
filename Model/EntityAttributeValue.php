<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Model;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\AttributeValueIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Entity\AttributeValue;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait EntityAttributeValue
{
    /**
     * @var AttributeValue
     */
    private $attributeValue;

    public function getId(): AttributeValueIdInterface
    {
        return $this->attributeValue->getId();
    }

    public function getAttribute(): Attribute
    {
        return $this->attributeValue->getAttribute();
    }

    public function getAttributeId(): AttributeIdInterface
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
