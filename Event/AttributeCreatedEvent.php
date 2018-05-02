<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Event;

use MsgPhp\Eav\Entity\Attribute;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AttributeCreatedEvent
{
    public $attribute;

    final public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}
