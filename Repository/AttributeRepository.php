<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Repository;

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 *
 * @template T of Attribute
 */
interface AttributeRepository
{
    /**
     * @return DomainCollection<array-key, T>
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollection;

    /**
     * @return T
     */
    public function find(AttributeId $id): Attribute;

    public function exists(AttributeId $id): bool;

    /**
     * @param T $attribute
     */
    public function save(Attribute $attribute): void;

    /**
     * @param T $attribute
     */
    public function delete(Attribute $attribute): void;
}
