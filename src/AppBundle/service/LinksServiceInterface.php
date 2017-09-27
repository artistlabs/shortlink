<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 15:58
 */
namespace AppBundle\service;

interface LinksServiceInterface
{
    public function addLink(string $url): string;
}