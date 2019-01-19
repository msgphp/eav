<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Command\Handler;

use MsgPhp\Domain\Exception\EntityNotFoundException;
use MsgPhp\Domain\Factory\EntityAwareFactoryInterface;
use MsgPhp\Domain\Message\{DomainMessageBusInterface, MessageDispatchingTrait};
use MsgPhp\Eav\Command\DeleteAttributeCommand;
use MsgPhp\Eav\Event\AttributeDeletedEvent;
use MsgPhp\Eav\Repository\AttributeRepositoryInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
final class DeleteAttributeHandler
{
    use MessageDispatchingTrait;

    private $repository;

    public function __construct(EntityAwareFactoryInterface $factory, DomainMessageBusInterface $bus, AttributeRepositoryInterface $repository)
    {
        $this->factory = $factory;
        $this->bus = $bus;
        $this->repository = $repository;
    }

    public function __invoke(DeleteAttributeCommand $command): void
    {
        try {
            $attribute = $this->repository->find($command->attributeId);
        } catch (EntityNotFoundException $e) {
            return;
        }

        $this->repository->delete($attribute);
        $this->dispatch(AttributeDeletedEvent::class, compact('attribute'));
    }
}
