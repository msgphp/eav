<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity\Fields;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
trait AttributeField
{
    /**
     * @var Attribute
     */
    private $attribute;

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }

    public function getAttributeId(): AttributeIdInterface
    {
        return $this->attribute->getId();
    }
}
