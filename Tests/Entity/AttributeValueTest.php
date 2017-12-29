<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Entity;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\AttributeValueIdInterface;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Entity\AttributeValue;
use PHPUnit\Framework\TestCase;

final class AttributeValueTest extends TestCase
{
    public function testCreate(): void
    {
        $attribute = new Attribute($this->getMockBuilder(AttributeIdInterface::class)->getMock());
        $attributeValue = new AttributeValue($this->getMockBuilder(AttributeValueIdInterface::class)->getMock(), $attribute, 'value');

        $this->assertInstanceOf(AttributeValueIdInterface::class, $attributeValue->getId());
        $this->assertSame($attribute, $attributeValue->getAttribute());
        $this->assertSame($attribute->getId(), $attributeValue->getAttributeId());
        $this->assertSame('value', $attributeValue->getValue());
        $this->assertSame(md5(serialize('value')), $attributeValue->getChecksum());
    }

    /**
     * @dataProvider provideAttributeValues
     */
    public function testChangeValue($initialValue, $newValue): void
    {
        $attribute = new Attribute($this->getMockBuilder(AttributeIdInterface::class)->getMock());
        $attributeValue = new AttributeValue($this->getMockBuilder(AttributeValueIdInterface::class)->getMock(), $attribute, $initialValue);
        $checksum = $attributeValue->getChecksum();

        $this->assertSame($initialValue, $attributeValue->getValue());

        $attributeValue->changeValue($newValue);

        $this->assertNotSame($checksum, $attributeValue->getChecksum());
        $this->assertSame($newValue, $attributeValue->getValue());
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
}
