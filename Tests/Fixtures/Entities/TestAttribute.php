<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Fixtures\Entities;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\ScalarAttributeId;

/**
 * @Doctrine\ORM\Mapping\Entity()
 */
class TestAttribute extends Attribute
{
    /**
     * @var null|int
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="integer")
     */
    private $id;

    public function __construct(?AttributeId $id = null)
    {
        $this->id = null === $id || $id->isNil() ? null : (int) $id->toString();
    }

    public function getId(): AttributeId
    {
        return new ScalarAttributeId(null === $this->id ? null : (string) $this->id);
    }
}
