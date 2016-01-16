<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserClient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/client")
 */
class ClientApiController extends Controller
{
    /**
     * @Route("/doctors")
     */
    public function doctorsAction(Request $request)
    {
        $em      = $this->getDoctrine()->getManager();
        $doctros = $em->getRepository('AppBundle:UserDoctor')->findAll();

        return new JsonResponse($doctros);
    }

    /**
     * @Route("/{client}/offers")
     */
    public function offersAction(Request $request, UserClient $client)
    {
        return new JsonResponse($client->getOffers()->getValues());
    }

    /**
     * @Route("/services")
     */
    public function servicesAction(Request $request)
    {

        $em       = $this->getDoctrine()->getManager();
        $services = $em->getRepository('AppBundle:Service')->findAll();
        return new JsonResponse($services);
    }

}
