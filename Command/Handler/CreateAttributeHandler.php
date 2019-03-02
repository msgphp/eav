<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command\Handler;

use MsgPhp\Domain\Factory\DomainObjectFactoryInterface;
use MsgPhp\Domain\Message\DomainMessageBusInterface;
use MsgPhp\Domain\Message\MessageDispatchingTrait;
use MsgPhp\Eav\AttributeIdInterface;
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

    /**
     * @var AttributeRepositoryInterface
     */
    private $repository;

    public function __construct(DomainObjectFactoryInterface $factory, DomainMessageBusInterface $bus, AttributeRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(CreateAttributeCommand $command): void
    {
        $context = $command->context;
        $context['id'] = $context['id'] ?? $this->factory->create(AttributeIdInterface::class);
        $attribute = $this->factory->create(Attribute::class, $context);

        $this->repository->save($attribute);
        $this->dispatch(AttributeCreatedEvent::class, compact('attribute', 'context'));
    }
}
