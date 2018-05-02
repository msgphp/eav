<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class DeleteAttributeCommand
{
    public $attributeId;

    final public function __construct($attributeId)
    {
        $this->attributeId = $attributeId;
    }
}
