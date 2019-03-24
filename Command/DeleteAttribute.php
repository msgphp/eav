<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command;

use MsgPhp\Eav\AttributeId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class DeleteAttribute
{
    /**
     * @var AttributeId
     */
    public $attributeId;

    public function __construct(AttributeId $attributeId)
    {
        $this->attributeId = $attributeId;
    }
}
