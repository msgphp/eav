<?php

declare(strict_types=1);

namespace MsgPhp\Eav\Repository;

use MsgPhp\Domain\DomainCollection;
use MsgPhp\Eav\Attribute;
use MsgPhp\Eav\AttributeId;

/**
 * @author Roland Franssen <franssen.roland@gmail.com>
 */
interface AttributeRepository
{
    /**
     * @return DomainCollection|Attribute[]
     */
    public function findAll(int $offset = 0, int $limit = 0): DomainCollection;

    public function find(AttributeId $id): Attribute;

    public function exists(AttributeId $id): bool;

    public function save(Attribute $attribute): void;

    public function delete(Attribute $attribute): void;
}
