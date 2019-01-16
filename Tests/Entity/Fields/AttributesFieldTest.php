<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity\Fields;

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Entity\Fields\AttributesField;
use MsgPhp\Eav\Entity\{Attribute, AttributeValue};
use PHPUnit\Framework\TestCase;

final class AttributesFieldTest extends TestCase
{
    public function testField(): void
    {
        $attributeValue1 = $this->createMock(AttributeValue::class);
        $attributeValue1->expects(self::any())
            ->method('getAttribute')
            ->willReturn($attribute1 = $this->createMock(Attribute::class))
        ;
        $attributeValue2 = $this->createMock(AttributeValue::class);
        $attributeValue2->expects(self::any())
            ->method('getAttribute')
            ->willReturn($attribute2 = $this->createMock(Attribute::class))
        ;
        $attribute1->expects(self::any())
            ->method('getId')
            ->willReturn(new AttributeId('attr1'))
        ;
        $attribute2->expects(self::any())
            ->method('getId')
            ->willReturn(new AttributeId('attr2'))
        ;
        $object = $this->getObject(new DomainCollection([$attributeValue1, $attributeValue2, $attributeValue1]));

        self::assertInstanceOf(DomainCollectionInterface::class, $collection = $object->getAttributes());
        self::assertSame([$attribute1, $attribute2], iterator_to_array($collection));
    }

    /**
     * @return object
     */
    private function getObject($value)
    {
        return new class($value) {
            use AttributesField;

            private $value;

            public function __construct($value)
            {
                $this->value = $value;
            }

            public function getAttributeValues(): DomainCollectionInterface
            {
                return $this->value;
            }
        };
    }
}
