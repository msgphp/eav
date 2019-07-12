<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Model;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\AttributeValueId;
use MsgPhp\Eav\Model\EntityAttributeValue;
use PHPUnit\Framework\TestCase;

final class EntityAttributeValueTest extends TestCase
{
    public function testFeature(): void
    {
        $attribute = $this->createMock(Attribute::class);
        $attribute->expects(self::once())
            ->method('getId')
            ->willReturn($attributeId = $this->createMock(AttributeId::class))
        ;
        /** @var AttributeValue $attributeValue */
        $object = $this->getObject('value', $attribute, $attributeValue);

        self::assertSame($attribute, $object->getAttribute());
        self::assertSame($attributeId, $object->getAttributeId());
        self::assertSame('value', $object->getValue());
        self::assertSame('value', $attributeValue->getValue());
        self::assertNull($object->changeValue('other'));
        self::assertSame('other', $object->getValue());
        self::assertSame('other', $attributeValue->getValue());
    }

    private function getObject($value, $attribute, &$attributeValue = null): object
    {
        $attributeValueId = $this->createMock(AttributeValueId::class);
        $attributeValue = new class($attributeValueId, $attribute, $value) extends AttributeValue {
            private $id;

            public function __construct($id, $attribute, $value)
            {
                parent::__construct($attribute, $value);

                $this->id = $id;
            }

            public function getId(): AttributeValueId
            {
                return $this->id;
            }
        };

        return new class($attributeValue) {
            use EntityAttributeValue;

            public function __construct($attributeValue)
            {
                $this->attributeValue = $attributeValue;
            }
        };
    }
}
