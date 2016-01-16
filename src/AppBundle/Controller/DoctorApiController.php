<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserDoctor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/api/doctor")
 */
class DoctorApiController extends Controller
{
    /**
     * @Route("/{doctor}/offers")
     */
    public function offersAction(Request $request, UserDoctor $doctor)
    {
        return new JsonResponse($doctor->getOffers()->getValues());
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
