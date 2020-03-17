<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Model;

use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\Model\AttributeField;
use MsgPhp\Eav\ScalarAttributeId;
use MsgPhp\Eav\Tests\Fixtures\Entities\TestAttribute;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class AttributeFieldTest extends TestCase
{
    public function testField(): void
    {
        $model = new TestAttributeFieldModel($attribute = new TestAttribute(new ScalarAttributeId('123')));

        self::assertSame($attribute, $model->getAttribute());
        self::assertSame('123', $model->getAttributeId()->toString());
    }
}

class TestAttributeFieldModel
{
    use AttributeField;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}
