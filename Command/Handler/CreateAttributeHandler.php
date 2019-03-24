<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command\Handler;

use MsgPhp\Domain\Factory\DomainObjectFactory;
use MsgPhp\Domain\Message\DomainMessageBus;
use MsgPhp\Domain\Message\MessageDispatchingTrait;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;
use MsgPhp\Eav\Command\CreateAttribute;
use MsgPhp\Eav\Event\AttributeCreated;
use MsgPhp\Eav\Repository\AttributeRepository;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class CreateAttributeHandler
{
    use MessageDispatchingTrait;

    /**
     * @var AttributeRepository
     */
    private $repository;

    public function __construct(DomainObjectFactory $factory, DomainMessageBus $bus, AttributeRepository $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(CreateAttribute $command): void
    {
        $context = $command->context;
        $context['id'] = $context['id'] ?? $this->factory->create(AttributeId::class);
        $attribute = $this->factory->create(Attribute::class, $context);

        $this->repository->save($attribute);
        $this->dispatch(AttributeCreated::class, compact('attribute', 'context'));
    }
}
