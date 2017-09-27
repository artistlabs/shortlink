<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 15:47
 */

namespace AppBundle\Repository;

use AppBundle\Entity\LinksInterface;

interface LinksRepositoryInterface
{
    public function findOneByHash(string $hash): ?LinksInterface;

    public function findOneByUrl(string $url): ?LinksInterface;

    public function findLast(): ?LinksInterface;
}