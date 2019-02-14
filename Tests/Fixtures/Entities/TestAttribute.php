<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Fixtures\Entities;

use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;

class TestAttribute extends Attribute
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?? new AttributeId();
    }

    public function getId(): AttributeIdInterface
    {
        return $this->id;
    }
}
