<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Connector;


class EmailConnector extends AbstractConnector
{
    /**
     *
     * @var \Swift_Mailer
     */
    private $mailer;
    
    /**
     *
     * @var \Swift_Message
     */
    private $mail;
    
    /**
     * 
     */
    public function push()
    {
        $this->mailer->send($this->mail);
    }

    /**
     * @param \Swift_Mailer $mailer
     * @param string $html
     * @param string $mailAddress
     */
    public function prepare(\Swift_Mailer $mailer, string $html, string $mailAddress)
    {
        $this->mailer = $mailer;
        $this->mail = new \Swift_Message('Title');
        $this->mail->setFrom('kab@esp-hosting.de');
        $this->mail->setBody($html, 'text/html');
        $this->mail->addTo($mailAddress);
    }
}