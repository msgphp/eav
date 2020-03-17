<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests;

use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\ScalarAttributeId;
use MsgPhp\Eav\Tests\Fixtures\Entities\TestAttribute;
use MsgPhp\Eav\Tests\Fixtures\Entities\TestAttributeValue;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class AttributeValueTest extends TestCase
{
    public function testCreate(): void
    {
        $attribute = new TestAttribute(new ScalarAttributeId('123'));
        $attributeValue = new TestAttributeValue($attribute, 'value');

        self::assertSame('value', $attributeValue->getValue());
        self::assertSame($attribute, $attributeValue->getAttribute());
        self::assertSame('123', $attributeValue->getAttributeId()->toString());
    }

    /**
     * @dataProvider provideAttributeValues
     *
     * @param mixed $initialValue
     * @param mixed $newValue
     */
    public function testChangeValue($initialValue, $newValue): void
    {
        $attributeValue = new TestAttributeValue(new TestAttribute(), $initialValue);

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
     *
     * @param mixed $value
     */
    public function testLazyGetValue($value, string $type): void
    {
        /** @var AttributeValue&MockObject $attributeValue */
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
     *
     * @param mixed $value
     */
    public function testUnknownTypes($value, bool $initial): void
    {
        if ($initial) {
            $this->expectException(\LogicException::class);

            new TestAttributeValue(new TestAttribute(), $value);
        } else {
            $attributeValue = new TestAttributeValue(new TestAttribute(), null);

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
}
