<?php

declare(strict_types=1);

/*
 * This file is part of the MsgPHP package.
 *
 * (c) Roland Franssen <franssen.roland@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MsgPhp\Eav\Entity\Features;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};

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
