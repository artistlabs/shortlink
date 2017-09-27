<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 15:47
 */

namespace AppBundle\Repository;

use AppBundle\Entity\LinksInterface;
use Doctrine\DBAL\Types\Type;

class LinksRepository extends \Doctrine\ORM\EntityRepository implements LinksRepositoryInterface
{
    public function findOneByHash(string $hash): ?LinksInterface
    {
        return $this->createQueryBuilder('links')
            ->where('links.hash = :hash')
            ->setParameter('hash', $hash)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByUrl(string $url): ?LinksInterface
    {
        return $this->createQueryBuilder('links')
            ->where('links.url = :url')
            ->setParameter('url', $url, Type::STRING)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLast(): ?LinksInterface
    {
        return $this->createQueryBuilder('links')
            ->addOrderBy('links.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}