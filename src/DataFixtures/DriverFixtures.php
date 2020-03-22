<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Driver;

class DriverFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $driver = new Driver();
        $drivers = array(
            [
                'firstname' => 'Hans',
                'lastname' => 'Schmidt',
                'street' => 'Wasserstraße 9 1/4',
                'place' => 'Nürnberg',
                'country' => 'be604d8a-d65c-474e-b385-020cf9252452',
                'email' => 'hans.schmidt@noreply.local',
                'mobile' => '01652998653',
                'birthday' => new \DateTime(),
                'passportid' => 'DDKL8003'
            ],
            [
                'firstname' => 'Inge',
                'lastname' => 'Schwarz',
                'street' => 'Wegbrücke 22a',
                'place' => 'Insingen',
                'country' => '6a016ca2-b5a6-4afe-8aa1-02645a29ba61',
                'email' => 'inge.schwarz@noreply.local',
                'mobile' => '0186554253',
                'birthday' => new \DateTime(),
                'passportid' => 'ASLDSI393032'
            ],
            [
                'firstname' => 'Jürgen',
                'lastname' => 'Weiß',
                'street' => 'In Schlattwiesen 18',
                'place' => 'Mössingen',
                'country' => 'be604d8a-d65c-474e-b385-020cf9252452',
                'email' => 'juergen.weiss@noreply.local',
                'mobile' => '017096588836',
                'birthday' => new \DateTime(),
                'passportid' => 'OPJESL39803'
            ],
        );
        for($i = 0; $i < count($drivers); $i++)
        {
            $driver = new Driver();
            $driver->setFirstname($drivers[$i]['firstname']);
            $driver->setLastname($drivers[$i]['lastname']);
            $driver->setStreet($drivers[$i]['street']);
            $driver->setPlace($drivers[$i]['place']);
            $driver->setCountry($drivers[$i]['country']);
            $driver->setEmail($drivers[$i]['email']);
            $driver->setMobile($drivers[$i]['mobile']);
            $driver->setBirthday($drivers[$i]['birthday']);
            $driver->setPassportid($drivers[$i]['passportid']);
            $manager->persist($driver);
        }
        $manager->flush();
    }
}
