<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command\Handler;

use MsgPhp\Domain\Factory\DomainObjectFactory;
use MsgPhp\Domain\Message\DomainMessageBusInterface;
use MsgPhp\Eav\{AttributeId, AttributeIdInterface};
use MsgPhp\Eav\Command\CreateAttributeCommand;
use MsgPhp\Eav\Command\Handler\CreateAttributeHandler;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Event\AttributeCreatedEvent;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class CreateAttributeHandlerTest extends TestCase
{
    public function testHandler(): void
    {
        $bus = $this->createMock(DomainMessageBusInterface::class);
        $bus->expects(self::once())
            ->method('dispatch')
            ->with(self::callback(function (AttributeCreatedEvent $message): bool {
                self::assertInstanceOf(TestAttribute::class, $message->attribute);
                self::assertTrue($message->attribute->getId()->isEmpty());
                self::assertSame('value', $message->attribute->field);
                self::assertTrue($message->attribute->saved);
                self::assertSame(['field' => 'value', 'id' => $message->attribute->getId()], $message->context);

                return true;
            }))
        ;
        $repository = $this->createMock(AttributeRepositoryInterface::class);
        $repository->expects(self::once())
            ->method('save')
            ->with(self::callback(function (TestAttribute $entity): bool {
                $entity->saved = true;

                return true;
            }))
        ;
        (new CreateAttributeHandler(self::createFactory(), $bus, $repository))(new CreateAttributeCommand([
            'field' => 'value',
        ]));
    }

    public function testHandlerWithId(): void
    {
        $id = $this->createMock(AttributeIdInterface::class);
        $bus = $this->createMock(DomainMessageBusInterface::class);
        $bus->expects(self::once())
            ->method('dispatch')
            ->with(self::callback(function (AttributeCreatedEvent $message) use ($id): bool {
                self::assertInstanceOf(TestAttribute::class, $message->attribute);
                self::assertSame($id, $message->attribute->getId());
                self::assertNull($message->attribute->field);
                self::assertSame(['id' => $message->attribute->getId()], $message->context);

                return true;
            }))
        ;
        $repository = $this->createMock(AttributeRepositoryInterface::class);
        (new CreateAttributeHandler(self::createFactory(), $bus, $repository))(new CreateAttributeCommand([
            'id' => $id,
        ]));
    }

    private static function createFactory(): DomainObjectFactory
    {
        return new DomainObjectFactory([
            AttributeIdInterface::class => AttributeId::class,
            Attribute::class => TestAttribute::class,
        ]);
    }
}

class TestAttribute extends Attribute
{
    public $field;
    public $saved = false;

    private $id;

    public function __construct($id, $field = null)
    {
        $this->id = $id;
        $this->field = $field;
    }

    public function getId(): AttributeIdInterface
    {
        return $this->id;
    }
}
