<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Images;
use App\Entity\Project;
use App\Entity\Technology;
use App\Entity\UnderCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 2; $i++) {
            $category = new Category();
            $category->setTitle("Catégorie-{$i}");
            $this->em->persist($category);

            for ($j = 1; $j <= 2; $j++) {
                $underCategory = new UnderCategory();
                $underCategory->setTitle($faker->name())
                    ->setCategory($category);
                $this->em->persist($underCategory);

                for ($k = 1; $k <= mt_rand(1, 9); $k++) {
                    $technology = new Technology();
                    $technology->setTitle($faker->title())
                        ->setLogo("test")
                        ->setUnderCategory($underCategory)
                        ->setCategory($category);
                    $this->em->persist($technology);
                }
            }
            $this->em->flush();
        }

        for ($j = 1; $j <= 5; $j++) {
            $project = new Project();
            $project->setTitle($faker->word())
                ->setActive($faker->boolean())
                ->setDescription($faker->realText("500"))
                ->setCreatedAt(new \DateTimeImmutable())
                ->setEndDate(new \DateTime("now"))
                ->setStartDate(new \DateTime("-1 week"))
                ->setTags("ReactJs, Javascript");
            $this->em->persist($project);
            for ($k = 1; $k <= 5; $k++) {
                $image = new Images();
                $image->setSrc($faker->imageUrl())
                    ->setAlt($faker->word())
                    ->setCreatedAt(new \DateTimeImmutable())
                    ->setProject($project);
                $this->em->persist($image);
            }
            $this->em->flush();
        }
    }
}
