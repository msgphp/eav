<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity\Fields;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use MsgPhp\Eav\Entity\Fields\AttributeValueField;
use PHPUnit\Framework\TestCase;

final class AttributeValueFieldTest extends TestCase
{
    public function testGetAttributeValue(): void
    {
        $value = $this->createMock(AttributeValue::class);
        $value->expects($this->any())
            ->method('getId')
            ->willReturn($this->createMock(AttributeValueIdInterface::class));
        $value->expects($this->any())
            ->method('getAttribute')
            ->willReturn($this->createMock(Attribute::class));
        $value->expects($this->any())
            ->method('getAttributeId')
            ->willReturn($this->createMock(AttributeIdInterface::class));
        $value->expects($this->any())
            ->method('getValue')
            ->willReturn('value');
        $object = $this->getObject($value);

        $this->assertSame($value, $object->getAttributeValue());
        $this->assertSame($value->getId(), $object->getAttributeValueId());
        $this->assertSame($value->getAttribute(), $object->getAttribute());
        $this->assertSame($value->getAttributeId(), $object->getAttributeId());
        $this->assertSame($value->getValue(), $object->getValue());
    }

    private function getObject($value)
    {
        return new class($value) {
            use AttributeValueField;

            public function __construct($value)
            {
                $this->attributeValue = $value;
            }
        };
    }
}
