<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Model;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;

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

    public function getAttributeId(): AttributeId
    {
        return $this->attribute->getId();
    }
}
