<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Event;

use MsgPhp\Eav\Attribute;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class AttributeCreated
{
    /**
     * @var Attribute
     */
    public $attribute;

    /**
     * @var array
     */
    public $context;

    public function __construct(Attribute $attribute, array $context)
    {
        $this->attribute = $attribute;
        $this->context = $context;
    }
}
