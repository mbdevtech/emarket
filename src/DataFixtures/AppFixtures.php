<?php

namespace App\DataFixtures;

use App\Entity\Catalog\Product;
use App\Entity\Catalog\Category;
use App\Entity\Catalog\Photo;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $categories = [
            "Computers", "Laptops", "Servers", "Workstations", "All-in-ones", "Tablets", "Samsung", "Nexus", "Apple",
            "Microsoft", "Lenovo", "Printers", "Canon", "Lexmark", "Brother", "Xerox", "HPLaserJet", "Accessories",
            "RAM", "Stockage", "Cards", "CAMs", "CPUs", "DVRs", "Screens", "Network", "Security"
        ];
        // for each category we create a few products
        for ($j = 0; $j < count($categories); $j++) {
            $cat = new Category();
            $cat->setName($categories[$j]);
            $cat->setExcerpt($categories[$j] . ' description ');
            $manager->persist($cat);
            // create products
            for ($i = 0; $i < mt_rand(1, 4); $i++) {
                $product = new Product();
                $product->setName('product ' . $i . ' of ' . $cat->getName());
                $product->setExcerpt('product ' . $i . ' of ' . $cat->getName());
                $product->setCategory($cat);
                $product->setPrice(mt_rand(10, 100));
                $product->setQuantity(mt_rand(5, 15));
                $product->setCreatedAt(new \DateTime());
                $product->setEditedAt(new \DateTime());
                $manager->persist($product);
                // create a photo for each product
                $photo = new Photo();
                //$this->init_photo($product, $photo);
                $manager->persist($photo);
            }
        }


        $manager->flush();
    }
}
