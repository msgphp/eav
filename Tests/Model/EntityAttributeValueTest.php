<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Model;

use MsgPhp\Eav\AttributeValue;
use MsgPhp\Eav\Model\EntityAttributeValue;
use MsgPhp\Eav\ScalarAttributeId;
use MsgPhp\Eav\Tests\Fixtures\Entities\TestAttribute;
use MsgPhp\Eav\Tests\Fixtures\Entities\TestAttributeValue;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class EntityAttributeValueTest extends TestCase
{
    public function testAttributeValue(): void
    {
        $model = new TestEntityAttributeValueModel($attributeValue = new TestAttributeValue(new TestAttribute(new ScalarAttributeId('123')), 'value'));

        self::assertSame($attributeValue->getId()->toString(), $model->getId()->toString());
        self::assertSame($attributeValue->getValue(), $model->getValue());
        self::assertSame($attributeValue->getAttribute(), $model->getAttribute());
        self::assertSame('123', $model->getAttributeId()->toString());

        $model->changeValue('other');

        self::assertSame('other', $model->getValue());
        self::assertSame('other', $attributeValue->getValue());
    }
}

class TestEntityAttributeValueModel
{
    use EntityAttributeValue;

    public function __construct(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }
}
