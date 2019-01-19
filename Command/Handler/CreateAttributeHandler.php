<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command\Handler;

use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait};
use MsgPhp\Eav\Command\CreateAttributeCommand;
use MsgPhp\Eav\Entity\Attribute;
use MsgPhp\Eav\Event\AttributeCreatedEvent;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class CreateAttributeHandler
{
    use MessageDispatchingTrait;

    private $repository;

    public function __construct(EntityAwareFactoryInterface $factory, DomainMessageBusInterface $bus, AttributeRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(CreateAttributeCommand $command): void
    {
        $attribute = $this->factory->create(Attribute::class, $command->context + ['id' => $this->factory->nextIdentifier(Attribute::class)]);

        $this->repository->save($attribute);
        $this->dispatch(AttributeCreatedEvent::class, compact('attribute'));
    }
}
