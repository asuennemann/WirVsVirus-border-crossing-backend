<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Driver;
use App\Entity\Driver2company;
use App\Entity\Tour;
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
        $data = json_decode($request->getContent(), true);
        $FIHA = fopen(__DIR__ . '/driver.txt', 'w+');
        fwrite($FIHA, print_r($data, true));
        fclose($FIHA);
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


            $driverToCompany = new Driver2company();
            $driverToCompany->setDriver($driver);
            $driverToCompany->setCompany($company);
            $driverToCompanyRepository = $manager->getRepository('App:Driver2company');
            $driverToCompanyFromDb = $driverToCompanyRepository->findOneBy([
                'driver' => $driver->getPkey(),
                'company' => $company->getPkey()
            ]);
            if($driverToCompanyFromDb)
            {
                $driverToCompany = $driverToCompanyFromDb;
            }
            else
            {
                $manager->persist($driverToCompany);
                $manager->flush();
            }
        }

        $tour = new Tour();
        $nBorders = count($data[0]['Tour']);
        $startDate = new \DateTime($data[0]['Tour'][0]['date']);
        $endDate = new \DateTime($data[0]['Tour'][$nBorders - 1]['date']);
        $tour->setStartDate($startDate);
        $tour->setEndDate($endDate);
        $tour->setPkeyFormdata('asdf');
        $manager->persist($tour);
        $manager->flush();

        return $this->handleView($this->view(['success'=>$success, 'startDate' => $startDate, 'endDate' => $endDate]));
    }
}
