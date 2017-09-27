<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 15:49
 */

namespace AppBundle\Entity;


interface LinksInterface
{
    public function getId(): int;

    public function setId(int $id);

    public function getUrl(): string;

    public function setUrl(string $url);

    public function getHash(): string;

    public function setHash(string $hash);

    public function getCreatedAt(): \DateTime;

    public function setCreatedAt(\DateTime $createdAt);
}