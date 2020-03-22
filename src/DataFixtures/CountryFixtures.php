<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Country;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $country = new Country();
        $countries = array(
            'Belgien', 'Deutschland', 'Frankreich', 'Italien', 'Luxemburg',
            'Niederlande', 'Dänemark', 'Irland', 'Griechenland', 'Portugal',
            'Spanien', 'Finnland', 'Österreich', 'Schweden', 'Estland',
            'Lettland', 'Litauen', 'Malta', 'Polen', 'Slowakei',
            'Slowenien', 'Tschechien', 'Ungarn', 'Zypern', 'Bulgarien', 'Rumänien', 'Kroatien');
        for($i = 0; $i < count($countries); $i++)
        {
            $country = new Country();
            $country->setCountryname($countries[$i]);
            $manager->persist($country);
        }
        $manager->flush();
    }
}
