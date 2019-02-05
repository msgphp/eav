<?php

declare(strict_types=1);

/*
 * This file is part of the MsgPHP package.
 *
 * (c) Roland Franssen <franssen.roland@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MsgPhp\Eav\Repository;

use MsgPhp\Domain\DomainCollectionInterface;
use MsgPhp\Eav\AttributeIdInterface;
use MsgPhp\Eav\Entity\Attribute;

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
