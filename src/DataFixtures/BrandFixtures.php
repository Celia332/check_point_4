<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRANDS = [
        [
            'marque' => 'Nike',
            'marque_url' => 'https://www.nike.com/fr/t/chaussure-air-force-1-le-pour-plus-age-D59pRJ/DH2920-111?nikemt=true&cp=30566810280_search_%7c%7c10690195814%7c108495198674%7c%7cc%7cFR%7ccssproducts%7c453050557182_GEOZ&ds_rl=1252249&gclid=CjwKCAiAl-6PBhBCEiwAc2GOVAKrt0Xw93eB2ru25SR4yul87-IYR5gBgmviqLGJYlhWzPRzwr7xsxoC02gQAvD_BwE&gclsrc=aw.ds',
        ],
    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::BRANDS as $brandData) {
            $brand = new Brand();
            $brand->setMarque($brandData['marque']);
            $brand->setMarqueUrl($brandData['marque_url']);
            $manager->persist($brand);
        }
        $manager->flush();
    }
}
