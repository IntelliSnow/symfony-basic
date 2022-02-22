<?php

declare(strict_types=1);

namespace App\Repository\Model;

use Doctrine\ORM\EntityManager;

/**
 * @template T of object
 *
 * @property EntityManager $_em
 */
trait RepositoryUtilsTrait
{
    /**
     * @template P of object
     *
     * @psalm-param P $entity
     *
     * @psalm-return P
     */
    public function persist($entity)
    {
        $this->_em->persist($entity);

        return $entity;
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}
