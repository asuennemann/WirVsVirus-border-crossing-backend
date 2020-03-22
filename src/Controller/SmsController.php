<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Util\AwsSnsUtil;

class SmsController extends AbstractController
{

    private $awsSnsUtil;

    public function __construct(AwsSnsUtil $awsSnsUtil)
    {
        $this->awsSnsUtil = $awsSnsUtil;
    }
    /**
     * @Route("/api/send_sms", name="api_send_sms")
     */
    public function sendSms()
    {
        /**
         * %mobile_number% = 00491731234567
         * laendervorwahl + mobile nummer
         */
        $return = $this->awsSnsUtil->sendSms('00491731830412');

        return $this->json([
            'success' => $return,
        ]);
    }
}
