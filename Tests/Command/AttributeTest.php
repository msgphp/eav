<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Tests\Command;

use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Command;
use MsgPhp\Eav\Event;
use PHPUnit\Framework\TestCase;

final class AttributeTest extends TestCase
{
    use IntegrationTestTrait;

    public function testCreate(): void
    {
        self::$bus->dispatch(new Command\CreateAttributeCommand([]));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreatedEvent::class, function (Event\AttributeCreatedEvent $event): void {
            self::assertFalse($event->attribute->getId()->isEmpty());
            self::assertArrayHasKey('id', $event->context);
            self::assertInstanceOf(AttributeIdInterface::class, $event->context['id']);
            self::assertTrue($event->context['id']->isEmpty());
        });

        self::assertCount(1, self::createAttributeRepository()->findAll());
    }

    public function testCreateWithId(): void
    {
        self::$bus->dispatch(new Command\CreateAttributeCommand([
            'id' => $id = self::createDomainFactory()->create(AttributeIdInterface::class),
        ]));

        self::assertMessageIsDispatchedOnce(Event\AttributeCreatedEvent::class, function (Event\AttributeCreatedEvent $event) use ($id): void {
            self::assertFalse($event->attribute->getId()->isEmpty());
            self::assertArrayHasKey('id', $event->context);
            self::assertSame($id, $event->context['id']);
        });
    }

    public function testDelete(): void
    {
        self::$bus->dispatch(new Command\CreateAttributeCommand([]));

        self::assertCount(1, self::createAttributeRepository()->findAll());

        /** @var Event\AttributeCreatedEvent $event */
        $event = self::$dispatchedMessages[Event\AttributeCreatedEvent::class][0];

        self::$bus->dispatch(new Command\DeleteAttributeCommand($event->attribute->getId()));

        self::assertMessageIsDispatchedOnce(Event\AttributeDeletedEvent::class);
        self::assertCount(0, self::createAttributeRepository()->findAll());
    }

    public function testDeleteUnknownId(): void
    {
        self::$bus->dispatch(new Command\DeleteAttributeCommand(self::createDomainFactory()->create(AttributeIdInterface::class)));

        self::assertMessageIsNotDispatched(Event\AttributeDeletedEvent::class);
        self::addToAssertionCount(1);
    }
}
