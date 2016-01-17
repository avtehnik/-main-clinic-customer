<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Offer;
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


    /**
     * @Route("/{client}/updateOffer")
     */
    public function newOfferAction(Request $request, UserClient $client)
    {
        $id    = $request->request->get('id');
        $em    = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('AppBundle:Offer')->find($id);

        if ( ! $offer) {
            $offer = new Offer();
            $offer->setCreated(new \DateTime());
            $offer->setUpdated(new \DateTime());
        }

        $offer->setDoctor($em->getRepository('AppBundle:UserDoctor')->find($request->request->get('doctor')));
        $offer->setClient($client);
        $offer->setDate(new \DateTime($request->request->get('date')));
        $offer->setStatus($request->request->get('status'));
        $offer->setComment($request->request->get('comment'));


        $services = json_decode($request->request->get('services'), true);


        foreach ($offer->getServices() as $service) {
            $offer->removeService($service);
        }

        if (is_array($services)) {

            foreach ($services as $serviceId) {

                $service = $em->getRepository('AppBundle:Service')->find($serviceId);
                $offer->addService($service);

            }

        }

        $em->persist($offer);
        $em->flush();

        return new JsonResponse($offer);
    }


    /**
     * @Route("/registerUpdate")
     */
    public function registerUpdateAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $id     = $request->request->get('id');
        $client = null;
        if ($id) {
            $client = $em->getRepository('AppBundle:UserClient')->find($id);
        }

        if ( ! $client) {
            $client = $em->getRepository('AppBundle:UserClient')->findOneBy(['phone' => $request->request->get('phone')]);
            if ( ! $client) {
                $client = new UserClient();
                $client->setPhone($request->request->get('phone'));
                $client->getUserType(UserClient::TYPE_CLIENT);
                $client->setFullName($request->request->get('fullName'));

            }
        }

        $client->setFullName($request->request->get('name'));
        $client->setAge($request->request->get('age'));
        $client->setGender($request->request->get('gender'));
        $client->setAddress($request->request->get('address'));
        $client->setDescription($request->request->get('description'));
        $em->persist($client);
        $em->flush();

        return new JsonResponse($client);
    }


    /**
     * @Route("/login")
     */
    public function loginAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();
        $id     = $request->request->get('id');
        $client = null;

        $client = $em->getRepository('AppBundle:UserClient')->findOneBy(['phone' => $request->request->get('phone')]);
        if ( ! $client) {
            $client = new UserClient();
            $client->setPhone($request->request->get('phone'));
            $client->getUserType(UserClient::TYPE_CLIENT);
            $client->setFullName($request->request->get('fullName'));

            $em->persist($client);
            $em->flush();
        }


        return new JsonResponse($client);
    }


}
