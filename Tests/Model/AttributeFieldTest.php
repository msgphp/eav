<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Model;

use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\Model\AttributeField;
use PHPUnit\Framework\TestCase;

final class AttributeFieldTest extends TestCase
{
    public function testField(): void
    {
        $value = $this->createMock(Attribute::class);
        $value->expects(self::any())
            ->method('getId')
            ->willReturn($this->createMock(AttributeId::class))
        ;

        $object = $this->getObject($value);

        self::assertSame($value, $object->getAttribute());
        self::assertSame($value->getId(), $object->getAttributeId());
    }

    /**
     * @return object
     */
    private function getObject($value)
    {
        return new class($value) {
            use AttributeField;

            public function __construct($value)
            {
                $this->attribute = $value;
            }
        };
    }
}
