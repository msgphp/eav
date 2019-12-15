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
     * @var AttributeId
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="msgphp_attribute_id")
     */
    private $id;

    public function __construct(?AttributeId $id = null)
    {
        $this->id = $id ?? new ScalarAttributeId();
    }

    public function getId(): AttributeId
    {
        return $this->id;
    }
}
