<?php
declare(strict_types=1);
 
namespace App\Util;
 
use Aws\Sdk;
use Aws\Sns\Exception\SnsException;
 
class AwsSnsUtil implements AwsSnsUtilInterface
{
    private $client;
 
    public function __construct(Sdk $sdk, iterable $config, iterable $credentials)
    {
        $this->client = $sdk->createSns($config+$credentials);
    }
 
    public function sendSms(string $phoneNumber): bool
    {
        try {
            $this->client->publish([
                'PhoneNumber' => $phoneNumber,
                'Message' => 'http://google.de',
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SenderID' => [
                        'DataType' => 'String',
                        'StringValue' => 'BorderCross'
                    ],
                    'AWS.SNS.SMS.SMSType' => [
                        'DataType' => 'String',
                        'StringValue' => 'Promotional'
                    ],
                ],
            ]);
 
            $result = true;
        } catch (SnsException $e) {
            dump($e);
            $result = false;
        }

        return $result;
    }
}