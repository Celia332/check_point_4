<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Sneakers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SneakerFixtures extends Fixture
{

    public const SNEAKERS = [
        [
            'title'      => 'Ces Louis Vuitton x Nike Air Force 1 « Brown » mises en vente aux enchères le 26 janvier',
            'text'       => 'Confectionnée en Italie, cette paire exclusive disponible en 200 exemplaires présente une tige en cuir de veau marron, 
                            arborant les célèbres fleurs de monogram de la maison française, et rehaussée d’un passepoil en cuir de vache. Elle dispose 
                            également d’empiècements sous forme de motif à damier beige et marron, notamment au niveau du swoosh, de la toebox et du heeltab. 
                            On retrouve aussi les finitions signatures de Virgil Abloh. C’est notamment le cas de la petite étiquette noire sur le talon,
                            et des inscriptions “AIR” sur la midsole blanche et “LACET” sur les lacets crème. Enfin, le co-branding disposé sur l’étiquette 
                            de la languette, le branding Louis Vuitton sur le heeltab, ainsi qu’une outsole marron, finalisent le design de la silhouette fidèle
                             à l’esprit de la maison de haute couture. À noter qu’une vaste gamme de tailles, de 5US à 18US, sera disponible.
                            Il faut également souligner que chaque paire s’accompagne d’une mallette de pilote, elle aussi exclusive à la vente aux enchères. Celle-ci
                             est en cuir orange et arbore des monogrammes embossés. Elle présente également des finitions blanches, ainsi qu’une étiquette en cuir orange 
                             avec un swoosh en cuir blanc.',
            'created_at' => '01/02/2022',
            'url'        => 'https://www.lesitedelasneaker.com/2022/01/louis-vuitton-nike-air-force-1-brown-encheres/',

        ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SNEAKERS as $sneakerData) {
            $sneaker = new Sneakers();
            $sneaker->setTitle($sneakerData['name']);
            $sneaker->setText($sneakerData['type']);
            $sneaker->setDate(new DateTime($sneakerData['createdAt']));
            $sneaker->setUrl($sneakerData['url']);
            $sneaker->setBrand($this->getReference('marque_' . rand(0, count(BrandFixtures::BRANDS) - 1)));
            $sneaker->setBrand($this->getReference('marque_url_' . rand(0, count(BrandFixtures::BRANDS) - 1)));
            $manager->persist($sneaker);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}
