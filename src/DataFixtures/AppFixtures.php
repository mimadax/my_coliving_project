<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;  // Ajoute cette ligne

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Créer 10 utilisateurs fictifs
        for ($i = 0; $i < 10; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($faker->lastName)
                        ->setPrenom($faker->firstName)
                        ->setDateNaiss($faker->dateTimeBetween('-30 years', '-18 years'))
                        ->setGenre($faker->randomElement(['Masculin', 'Féminin']))
                        ->setEmail($faker->email)
                        ->setMdp($faker->password);

            $manager->persist($utilisateur);

            // Créer 3 annonces pour chaque utilisateur
            for ($j = 0; $j < 3; $j++) {
                $annonce = new Annonce();
                $annonce->setTitre($faker->sentence(3))
                        ->setDescription($faker->paragraph)
                        ->setServices($faker->words(5, true))
                        ->setEquipements($faker->words(5, true))
                        ->setDatesDispo($faker->dateTimeBetween('now', '+1 year'))
                        ->setPrix($faker->randomFloat(2, 50, 500))
                        ->setNote($faker->randomFloat(1, 1, 5))
                        ->setLocalisation($faker->city)
                        ->setCapacite($faker->numberBetween(1, 10))
                        ->setProprietaire($utilisateur);

                $manager->persist($annonce);
            }
        }

        $manager->flush();
    }
}
