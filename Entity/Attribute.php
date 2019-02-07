<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity;

use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
abstract class Attribute
{
    abstract public function getId(): AttributeIdInterface;
}
