<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api/client", name="homepage")
 */
class ClientApiController extends Controller
{
    /**
     * @Route("/doctors")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $doctros = $em->getRepository('AppBundle:UserDoctor')->findAll();

        return new JsonResponse($doctros);

    }


}
