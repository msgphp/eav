<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeIdInterface;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface AttributeRepositoryInterface
{
    /**
     * @return DomainCollectionInterface|Attribute[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollectionInterface;

    public function find(AttributeIdInterface $id): Attribute;

    public function exists(AttributeIdInterface $id): bool;

    public function save(Attribute $attribute): void;

    public function delete(Attribute $attribute): void;
}
