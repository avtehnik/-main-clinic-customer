<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
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
     * @Route("/offers")
     */
    public function offersAction(Request $request, UserDoctor $doctor)
    {

        $em       = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('AppBundle:Offer')->findAll();

        return new JsonResponse($offers);
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

    /**
     * @Route("/{doctor}/feedbacks")
     */
    public function feedbacksAction(Request $request, UserDoctor $doctor)
    {
        return new JsonResponse($doctor->getFeedbacks()->getValues());
    }

    /**
     * @Route("/{doctor}/feedbackAdd")
     */
    public function feedbackAddAction(Request $request, UserDoctor $doctor)
    {

        $em    = $this->getDoctrine()->getManager();

        $feedback = new Feedback();

        $feedback->setComment($request->request->get('comment'));
        $feedback->setCreated(new \DateTime());
        $feedback->setUpdated(new \DateTime());
        $feedback->setDoctor($doctor);

        $feedback->setClient($em->getRepository('AppBundle:UserClient')->find($request->request->get('client')));

        $em->persist($feedback);
        $em->flush();

        return new JsonResponse($feedback);
    }



}
