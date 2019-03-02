<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Fixtures\Entities;

use MsgPhp\Eav\{ScalarAttributeId, AttributeIdInterface};
use MsgPhp\Eav\Entity\Attribute;

/**
 * @Doctrine\ORM\Mapping\Entity()
 */
class TestAttribute extends Attribute
{
    /**
     * @var AttributeIdInterface
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="msgphp_attribute_id")
     */
    private $id;

    public function __construct(AttributeIdInterface $id = null)
    {
        $this->id = $id ?? new ScalarAttributeId();
    }

    public function getId(): AttributeIdInterface
    {
        return $this->id;
    }
}
