<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Fixtures\Entities;

use MsgPhp\Eav\{AttributeValueId, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\AttributeValue;

/**
 * @Doctrine\ORM\Mapping\Entity()
 */
class TestAttributeValue extends AttributeValue
{
    /**
     * @var AttributeValueIdInterface
     * @Doctrine\ORM\Mapping\Id()
     * @Doctrine\ORM\Mapping\GeneratedValue()
     * @Doctrine\ORM\Mapping\Column(type="msgphp_attribute_value_id")
     */
    private $id;

    public function __construct(TestAttribute $attribute, $value, AttributeValueIdInterface $id = null)
    {
        parent::__construct($attribute, $value);

        $this->id = $id ?? new AttributeValueId();
    }

    public function getId(): AttributeValueIdInterface
    {
        return $this->id;
    }
}
