<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LinksInterface;
use AppBundle\exception\AddLinkException;
use AppBundle\exception\ValidateException;
use AppBundle\Repository\LinksRepositoryInterface;
use AppBundle\service\LinksService;
use AppBundle\service\LinksServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Webmozart\Assert\Assert;

class DefaultController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="home"
     * )
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route(
     *     path="/add",
     *     name="add_link",
     *     defaults={"_format": "json"},
     * )
     * @Method("POST")
     */
    public function addAction(Request $request) {
        /**
         * @var LinksServiceInterface $service
         */

        $url = $request->get('url', null);
        $service = $this->get(LinksService::class);
        try {
            Assert::notNull($url);
            $hash = $service->addLink($url);
        } catch (\InvalidArgumentException $exception) {
            //todo переделать обработка ошибок
            throw new AddLinkException('invalid url addrress', 400);
        } catch (ValidateException $exception) {
            throw new AddLinkException($exception->getMessage());
        }

        return $this->json([
            'url'  => $this->generateUrl('link', ['hash' => $hash], UrlGeneratorInterface::ABSOLUTE_URL)
        ]);
    }

    /**
     * @Route(
     *     path="/{hash}",
     *     name="link",
     *     requirements={"hash": "[\d|\w]+"}
     * )
     */
    public function linkAction($hash) {
        /**
         * @var LinksRepositoryInterface $repository
         */
        $repository = $this->get('app.repository.links');
        $link = $repository->findOneByHash($hash);

        Assert::isInstanceOf($link, LinksInterface::class);

        return $this->redirect($link->getUrl(), 301);
    }
}
