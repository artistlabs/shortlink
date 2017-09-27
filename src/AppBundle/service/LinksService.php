<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 16:00
 */
namespace AppBundle\service;

use AppBundle\Entity\Links;
use AppBundle\exception\ValidateException;
use AppBundle\Repository\LinksRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Fwolf\Util\BaseConverter\BaseConverter;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

class LinksService implements LinksServiceInterface
{

    private $linksRepository;
    private $entityManager;
    private $validator;

    public function __construct(
        LinksRepositoryInterface $linksRepository,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    )
    {
        $this->linksRepository = $linksRepository;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function addLink(string $url): string
    {
        Assert::notEmpty($url);
        $link = $this->linksRepository->findOneByUrl($url);
        if($link) {
            return $link->getHash();
        }

        //todo вынести в конструктор
        $converter = BaseConverter::getInstance();

        $last_link = $this->linksRepository->findLast();
        $id = $last_link? ($last_link->getId() + 1)  : 1;
        $link = new Links();
        $link->setUrl($url);
        $link->setHash($converter->convert($id, 10, 36));
        $link->setCreatedAt(new \DateTime());

        $result = $this->validator->validate($link);

        if($result->count() > 0) {
            throw new ValidateException($result);
        }

        $this->entityManager->persist($link);
        $this->entityManager->flush();

        return $link->getHash();
    }
}