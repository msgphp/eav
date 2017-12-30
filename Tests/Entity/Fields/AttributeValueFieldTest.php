<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity\Fields;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use MsgPhp\Eav\Entity\Fields\AttributeValueField;
use PHPUnit\Framework\TestCase;

final class AttributeValueFieldTest extends TestCase
{
    public function testField(): void
    {
        $value = $this->getMockBuilder(AttributeValue::class)->disableOriginalConstructor()->getMock();
        $value->expects($this->any())
            ->method('getId')
            ->willReturn($this->getMockBuilder(AttributeValueIdInterface::class)->getMock());
        $value->expects($this->any())
            ->method('getAttribute')
            ->willReturn($this->getMockBuilder(Attribute::class)->disableOriginalConstructor()->getMock());
        $value->expects($this->any())
            ->method('getAttributeId')
            ->willReturn($this->getMockBuilder(AttributeIdInterface::class)->getMock());
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
