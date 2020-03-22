<?php

namespace App\Controller;

use App\Entity\Driver;
use App\Entity\Tour;
use App\Entity\Healthcheck;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;



/**
 * Class CheckpointController
 * @package App\Controller
 *
 * @Route("/api", name="api__")
 */
class CheckpointController extends FOSRestController
{
    /**
     * @Rest\Post("/tour/show")
     * @return Response
     */
    public function TourShowAction(Request $request)
    {
        $success = true;
        $data = json_decode($request->getContent(), true);
       
        $manager = $this->getDoctrine()->getManager();

        $tourRepository = $manager->getRepository('App:Tour');
        $tour = $tourRepository->findOneBy(['pkey' => $data['tourId']]);

        return $this->handleView($this->view(['success'=>$success, 'tour' => $tour]));

    }

    /**
     * @Rest\Post("/healthcheck/show")
     * @return Response
     */
    public function HealthcheckShowAction(Request $request)
    {
        $success = true;
        $data = json_decode($request->getContent(), true);
       
        $manager = $this->getDoctrine()->getManager();

        $healthcheckRepository = $manager->getRepository('App:Healthcheck');
        $healthcheck = $healthcheckRepository->findBy(['pkeyDriver' => $data['driverId']]);

        return $this->handleView($this->view(['success'=>$success, 'healthchecks' => $healthcheck]));

    }

    /**
     * @Rest\Post("/healthcheck/add")
     * @return Response
     */
    public function HealthcheckAddAction(Request $request)
    {
        $success = true;
        $data = json_decode($request->getContent(), true);
  
        $manager = $this->getDoctrine()->getManager(); 

        $driverRepository = $manager->getRepository('App:Driver');
        $driver = $driverRepository->findOneBy(['pkey' => $data['pkey_driver']]);

        $guardRepository = $manager->getRepository('App:Guard');
        $guard = $guardRepository->findOneBy(['pkey' => $data['pkey_guard']]);

        $healthcheck = new Healthcheck();
        $healthcheck->setPkeyDriver($driver);
        $healthcheck->setPkeyGuard($guard);
        $healthcheck->setStatus($data['status']);
        $healthcheck->setDue(new \DateTime());

        $manager->persist($healthcheck);
        $manager->flush();

        return $this->handleView($this->view(['success'=>$success]));

    }

}