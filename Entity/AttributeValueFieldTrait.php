<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait AttributeValueFieldTrait
{
    private $attributeValue;

    public function getAttributeValue(): AttributeValue
    {
        return $this->attributeValue;
    }

    public function getAttributeValueId(): AttributeValueIdInterface
    {
        return $this->getAttributeValue()->getId();
    }

    public function getAttribute(): Attribute
    {
        return $this->getAttributeValue()->getAttribute();
    }

    public function getAttributeId(): AttributeIdInterface
    {
        return $this->getAttributeValue()->getAttributeId();
    }
}
