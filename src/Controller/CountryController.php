<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Entity\Country;

/**
 * Class CountryController
 * @package App\Controller
 *
 * @Route("/api", name="api__")
 */
class CountryController extends FOSRestController
{
    /**
     * * @Rest\Get("/country/list")
     */
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $countries = $manager->getRepository('App:Country')->findBy(array(), array('countryname' => 'asc'));
        return $this->handleView($this->view($countries));
    }
}
