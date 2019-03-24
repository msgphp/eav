<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Event;

use MsgPhp\Eav\Attribute;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AttributeDeleted
{
    /**
     * @var Attribute
     */
    public $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}
