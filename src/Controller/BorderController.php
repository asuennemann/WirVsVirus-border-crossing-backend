<?php

namespace App\Controller;

use App\Entity\Driver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Country;
use App\Entity\Border;


/**
 * Class CountryController
 * @package App\Controller
 *
 * @Route("/api", name="api__")
 */
class BorderController extends FOSRestController
{
    /**
     * @Rest\Post("/border/cross/add")
     * @return Response
     */
    public function CrossAddAction(Request $request)
    {
        $success = true;
        $data = json_decode($request->getContent(), true);
        $FIHA = fopen(__DIR__ . '/driver.txt', 'w+');
        fwrite($FIHA, print_r($data, true));
        fclose($FIHA);
        $driver = new Driver();
        $form = $this->createForm(\App\Form\DriverType::class, $driver);
        $form->submit($data[0]['driver']);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            // Check if driver is already in database
            $driverRepository = $manager->getRepository('App:Driver');
            $driverDb = $driverRepository->findOneBy(['passportid' => $driver->getPassportid()]);
            if($driverDb)
            {
                $driver = $driverDb;
            }
            else
            {
                $manager->persist($driver);
                $manager->flush();
            }

        }
        else
        {
            $success = false;
        }
        return $this->handleView($this->view(['success'=>$success, 'errors' => $form->getErrors()]));

    }
}
