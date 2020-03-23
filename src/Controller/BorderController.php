<?php

namespace App\Controller;

use App\Entity\Carregistration;
use App\Entity\Company;
use App\Entity\Driver;
use App\Entity\Driver2company;
use App\Entity\Driver2tour;
use App\Entity\Tour;
use App\Entity\Tour2border;
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
        $manager = $this->getDoctrine()->getManager();
        $dataWrapper = json_decode($request->getContent(), true);
        $data = json_decode($dataWrapper['body'], true);
        $companyFromDb = null;
        $driverFromDb = null;
        $company = new Company();
        $form = $this->createForm(\App\Form\CompanyType::class, $company);
        $form->submit($data[0]['Company']);
        if($form->isSubmitted() && $form->isValid())
        {
            $companyRepository = $manager->getRepository('App:Company');
            $companyFromDb = $companyRepository->findOneBy([
                'companyname' => $company->getCompanyname(),
                'street' => $company->getStreet(),
                'place' => $company->getPlace(),
                'country' => $company->getCountry()
            ]);
            if($companyFromDb)
            {
                $company = $companyFromDb;
            }
            else
            {
                $manager->persist($company);
                $manager->flush();
            }
        }

        $driver = new Driver();
        $form = $this->createForm(\App\Form\DriverType::class, $driver);
        $form->submit($data[0]['Driver']);
        if($form->isSubmitted() && $form->isValid())
        {
            // Check if driver is already in database
            $driverRepository = $manager->getRepository('App:Driver');
            $driverFromDb = $driverRepository->findOneBy(['passportid' => $driver->getPassportid()]);
            if($driverFromDb)
            {
                $driver = $driverFromDb;
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
            return $this->handleView($this->view(['success'=>$success, 'errors' => $form->getErrors()]));
        }

        $driverToCompany = new Driver2company();
        $driverToCompanyRepository = $manager->getRepository('App:Driver2company');
        $driverToCompanyFromDb = $driverToCompanyRepository->findOneBy([
            'driver' => $driver->getPkey(),
            'company' => $company->getPkey()
        ]);
        if(!$driverToCompanyFromDb)
        {
            $driverToCompany->setCompany($company);
            $driverToCompany->setDriver($driver);
            $manager->persist($driverToCompany);
            $manager->flush();
        }

        $tour = new Tour();
        $nBorders = count($data[0]['Tour']);
        $startDate = new \DateTime($data[0]['Tour'][0]['date']);
        $endDate = new \DateTime($data[0]['Tour'][$nBorders - 1]['date']);
        $tour->setStartDate($startDate);
        $tour->setEndDate($endDate);
        $manager->persist($tour);
        $manager->flush();

        $borderRepository = $manager->getRepository('App:Border');
        $countryRepository = $manager->getRepository('App:Country');
        for($i = 0; $i < $nBorders; $i++)
        {
            $border = $borderRepository->findOneBy(['ridefrom' => $data[0]['Tour'][$i]['ridefrom'], 'rideto' => $data[0]['Tour'][$i]['rideto']]);
            // if border don't exist -> add one
            if(!$border)
            {
                $border = new Border();
                $rideFrom = $countryRepository->find($data[0]['Tour'][$i]['ridefrom']);
                $rideTo = $countryRepository->find($data[0]['Tour'][$i]['rideto']);
                $border->setRidefrom($rideFrom);
                $border->setRideto($rideTo);
                $manager->persist($border);
                $manager-flush();
            }
            $tour2border = new Tour2border();
            $tour2border->setPkeyBorder($border);
            $tour2border->setPkeyTour($tour);
            $transitionDate = new \DateTime($data[0]['Tour'][$i]['date']);
            $tour2border->setTransiton($transitionDate);
            $manager->persist($tour2border);
            $manager->flush();
        }

        $carregistration = new Carregistration();
        $form = $this->createForm(\App\Form\CarregistrationType::class, $carregistration);
        //$form->submit($data[0]['Carregistration']);
        $form->submit($data[0]['Car']);
        if($form->isSubmitted() && $form->isValid())
        {
            $carregistration->setPkeyCompany($company);
            $manager->persist($carregistration);
            $manager->flush();
        }

        $driverToTour = new Driver2tour();
        $driverToTour->setPkeyTour($tour);
        $driverToTour->setPkeyDriver($driver);
        $driverToTour->setPkeyCarregistration($carregistration);
        $manager->persist($driverToTour);
        $manager->flush();

        return $this->handleView($this->view(['success'=>$success, 'tour' => $tour->getPkey()]));
    }
}