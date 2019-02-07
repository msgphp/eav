<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command;

use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class DeleteAttributeCommand
{
    /**
     * @var AttributeIdInterface
     */
    public $attributeId;

    final public function __construct(AttributeIdInterface $attributeId)
    {
        $this->attributeId = $attributeId;
    }
}
