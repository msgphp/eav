<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\AttributeValueId;
use PHPUnit\Framework\TestCase;

final class AttributeValueTest extends TestCase
{
    public function testCreate(): void
    {
        $attribute = $this->createMock(Attribute::class);
        $attribute->expects(self::any())
            ->method('getId')
            ->willReturn($this->createMock(AttributeId::class))
        ;
        $attributeValue = $this->createEntity($this->createMock(AttributeValueId::class), $attribute, 'value');

        self::assertSame($attribute, $attributeValue->getAttribute());
        self::assertSame($attribute->getId(), $attributeValue->getAttributeId());
        self::assertSame('value', $attributeValue->getValue());
    }

    /**
     * @dataProvider provideAttributeValues
     */
    public function testChangeValue($initialValue, $newValue): void
    {
        $attributeValue = $this->createEntity($this->createMock(AttributeValueId::class), $this->createMock(Attribute::class), $initialValue);

        self::assertSame($initialValue, $attributeValue->getValue());

        $attributeValue->changeValue($newValue);

        self::assertSame($newValue, $attributeValue->getValue());
    }

    public function testGetChecksum(): void
    {
        self::assertSame(AttributeValue::getChecksum('foo'), AttributeValue::getChecksum('foo'));
        self::assertSame(AttributeValue::getChecksum(1), AttributeValue::getChecksum(1));
        self::assertNotSame(AttributeValue::getChecksum('foo'), AttributeValue::getChecksum('bar'));
        self::assertNotSame(AttributeValue::getChecksum(1), AttributeValue::getChecksum('1'));
    }

    public function provideAttributeValues(): iterable
    {
        yield [null, true];
        yield [true, false];
        yield [false, 0];
        yield [0, -1];
        yield [-1, .0];
        yield [.0, -1.5];
        yield [-1.5, ''];
        yield ['', 'value'];
        yield ['value', new \DateTime()];
        yield [new \DateTime(), new \DateTimeImmutable()];
        yield [new \DateTimeImmutable(), null];
    }

    /**
     * @dataProvider provideLazyAttributeValues
     */
    public function testLazyGetValue($value, string $type): void
    {
        $attributeValue = $this->getMockBuilder(AttributeValue::class)
            ->disableOriginalConstructor()
            ->enableProxyingToOriginalMethods()
            ->getMockForAbstractClass()
        ;

        self::assertNull($attributeValue->getValue());

        $propertyValueRefl = new \ReflectionProperty(AttributeValue::class, $type.'Value');
        $propertyValueRefl->setAccessible(true);
        $propertyValueRefl->setValue($attributeValue, $value);

        $propertyValueRefl = new \ReflectionProperty(AttributeValue::class, 'isNull');
        $propertyValueRefl->setAccessible(true);
        $propertyValueRefl->setValue($attributeValue, false);

        self::assertSame($value, $attributeValue->getValue());
    }

    public function provideLazyAttributeValues(): iterable
    {
        yield [true, 'bool'];
        yield [false, 'bool'];
        yield [0, 'int'];
        yield [-1, 'int'];
        yield [.0, 'float'];
        yield [-1.5, 'float'];
        yield ['', 'string'];
        yield ['value', 'string'];
        yield [new \DateTime(), 'dateTime'];
        yield [new \DateTimeImmutable(), 'dateTime'];
    }

    /**
     * @dataProvider provideUnknownTypeValues
     */
    public function testUnknownTypes($value, bool $initial): void
    {
        if ($initial) {
            $this->expectException(\LogicException::class);

            $this->createEntity($this->createMock(AttributeValueId::class), $this->createMock(Attribute::class), $value);
        } else {
            $attributeValue = $this->createEntity($this->createMock(AttributeValueId::class), $this->createMock(Attribute::class), null);

            $this->expectException(\LogicException::class);

            $attributeValue->changeValue($value);
        }
    }

    public function provideUnknownTypeValues(): iterable
    {
        yield [[], true];
        yield [[123], false];
        yield [new \stdClass(), true];
        yield [new \stdClass(), false];
        yield [static function (): string { return ''; }, false];
    }

    private function createEntity($id, $attribute, $value): AttributeValue
    {
        return new class($id, $attribute, $value) extends AttributeValue {
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
    }
}
