<?php
declare(strict_types=1);
 
namespace App\Util;
 
interface AwsSnsUtilInterface
{
    public function sendSms(string $phoneNumber): bool;
}