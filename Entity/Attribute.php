<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Entity;

use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
class Attribute
{
    private $id;

    /**
     * @internal
     */
    public function __construct(AttributeIdInterface $id)
    {
        $this->id = $id;
    }

    final public function getId(): AttributeIdInterface
    {
        return $this->id;
    }
}
