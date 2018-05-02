<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity\Features;

use MsgPhp\Eav\{AttributeIdInterface, AttributeValueIdInterface};
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use MsgPhp\Eav\Entity\Features\EntityAttributeValue;
use PHPUnit\Framework\TestCase;

final class EntityAttributeValueTest extends TestCase
{
    public function testFeature(): void
    {
        $value = $this->createMock(AttributeValue::class);
        $value->expects($this->once())
            ->method('getId')
            ->willReturn($id = $this->createMock(AttributeValueIdInterface::class));
        $value->expects($this->once())
            ->method('getAttribute')
            ->willReturn($attribute = $this->createMock(Attribute::class));
        $value->expects($this->once())
            ->method('getAttributeId')
            ->willReturn($attributeId = $this->createMock(AttributeIdInterface::class));
        $value->expects($this->once())
            ->method('getValue')
            ->willReturn('value');
        $value->expects($this->once())
            ->method('changeValue')
            ->willReturn('some');
        $object = $this->getObject($value);

        $this->assertSame($id, $object->getId());
        $this->assertSame($attribute, $object->getAttribute());
        $this->assertSame($attributeId, $object->getAttributeId());
        $this->assertSame('value', $object->getValue());
        $this->assertNull($object->changeValue('some'));
    }

    private function getObject($value)
    {
        return new class($value) {
            use EntityAttributeValue;

            public function __construct($value)
            {
                $this->attributeValue = $value;
            }
        };
    }
}
