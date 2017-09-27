<?php
/**
 * Created by PhpStorm.
 * User: vladimir
 * Date: 27.09.2017
 * Time: 15:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

//use Gedmo\Mapping\Annotation as Gedmo

/**
 * Class Entity
 * @package AppBundle
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinksRepository")
 * @ORM\Table(
 *     name="links",
 *     indexes={
 *      @ORM\Index(name="iUrl", columns={"url"}),
 *      @ORM\Index(name="iHash", columns={"hash"})
 *      }
 * )
 */
class Links implements LinksInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     * @
     */
    private $hash;

    /**
     * @ORM\Column(type="datetime", name="created_at", nullable=false)
     */
    private $createdAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash(string $hash)
    {
        $this->hash = $hash;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
}