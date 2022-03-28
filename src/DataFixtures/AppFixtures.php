<?php

namespace App\DataFixtures;

use App\Entity\Consultation;
use App\Entity\Medication;
use App\Entity\Patient;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $patient = (new Patient())->setName("Dupont CHARLE");
        $manager->persist($patient);
        
        $medication = (new Medication())->setLabel("Dropalax");
        $manager->persist($medication);
        
        $consultation = (new Consultation($this->encoder))->setPatient($patient)->setDate((new DateTime()));

        $manager->persist($consultation);

        $manager->flush();
    }
}
