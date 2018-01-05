<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity\Fields;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait AttributeValueField
{
    /** @var AttributeValue */
    private $attributeValue;

    public function getAttributeValue(): AttributeValue
    {
        return $this->attributeValue;
    }

    public function getAttributeValueId(): AttributeValueIdInterface
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

    public function getValue()
    {
        return $this->attributeValue->getValue();
    }
}
