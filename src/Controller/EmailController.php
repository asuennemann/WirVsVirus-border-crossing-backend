<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;


namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




/**
 * Class EmailController
 * @package App\Controller
 *
 * @Route("/api", name="api__")
 */
class EmailController extends AbstractController
{


    /**
     *
     * @param \Swift_Mailer $mailer
     * @param int $id
     * @return Response
     *
     * @Rest\Get("/mail/form/to/driver")
     */
    public function mailFormToDriverAction(\Swift_Mailer $mailer)
    {
        $manager = $this->getDoctrine()->getManager();
        $html = $this->renderView('mail/formToDriver.html.twig');
        $emailConnector = new \App\Connector\EmailConnector;
        $emailConnector->prepare($mailer, $html, 'a.suennemann@edv-peuker.de');
        $emailConnector->push();
        return array('success' => 'true');
    }
}