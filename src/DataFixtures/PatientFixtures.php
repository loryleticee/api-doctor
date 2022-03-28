<?php

namespace App\DataFixtures;

use App\Entity\Consultation;
use App\Entity\Medication;
use App\Entity\Order;
use App\Entity\Patient;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ObjectManager;

class PatientFixtures extends Fixture
{
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $patient = (new Patient())->setName("Dion Gislason");
        $manager->persist($patient);

        $patient = (new Patient())->setName("Zackary Kub");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Matilda McLaughlin");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Nicole Price");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Kraig Weissnat");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Justen Ryan");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Fredy Schoen");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Malika Hintz");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Effie Borer");
        $manager->persist($patient);
      
        $patient = (new Patient())->setName("Reece Bode");
        $manager->persist($patient);
      
        $patient_7 = (new Patient())->setName("Claud Funk");
        $manager->persist($patient_7);
      
        $patient_6 = (new Patient())->setName("Humberto Koelpin");
        $manager->persist($patient_6);
      
        $patient_5 = (new Patient())->setName("Oscar Stoltenberg");
        $manager->persist($patient_5);
      
        $patient_4 = (new Patient())->setName("Ryleigh Stehr");
        $manager->persist($patient_4);
      
        $patient_3 = (new Patient())->setName("Minerva Balistreri");
        $manager->persist($patient_3);
      
        $patient_2 = (new Patient())->setName("Otis Schmidt");
        $manager->persist($patient_2);
      
        $patient_1 = (new Patient())->setName("Garnet Metz");
        $manager->persist($patient_1);

        // MEDOCS
        $medoc_1 = (new Medication)->setLabel("XaNax");
        $manager->persist($medoc_1);
      
        $medoc_2 = (new Medication)->setLabel("DoLiprAne");
        $manager->persist($medoc_2);
      
        $medoc_3 = (new Medication)->setLabel("ViaGra");
        $manager->persist($medoc_3);
      
        $medoc_4 = (new Medication)->setLabel("BiaFine");
        $manager->persist($medoc_4);
      
        $medoc_5 = (new Medication)->setLabel("IbuproFEn");
        $manager->persist($medoc_5);
      
        $medoc_6 = (new Medication)->setLabel("CicAtriL");
        $manager->persist($medoc_6);
      
        $medoc_7 = (new Medication)->setLabel("spAsFon");
        $manager->persist($medoc_7);
      
        $medoc_8 = (new Medication)->setLabel("talC");
        $manager->persist($medoc_8);
      
        $medoc_9 = (new Medication)->setLabel("efFeraLgan");
        $manager->persist($medoc_9);
      
        $medoc_10 = (new Medication)->setLabel("morpHine");
        $manager->persist($medoc_10);
      
        
        // CONSULTATION
        $consultation_1 = (new Consultation($this->encoder))->setPatient($patient_1)->setDate((new DateTime("2020-01-23T15:03:01.012345Z")));
        $manager->persist($consultation_1);

        

        $consultation_2 = (new Consultation($this->encoder))->setPatient($patient_2)->setDate((new DateTime("2024-05-03T20:03:01.012345Z")));
        $manager->persist($consultation_2);


        $consultation_3 = (new Consultation($this->encoder))->setPatient($patient_2)->setDate((new DateTime("2020-01-23T05:12:00.012345Z")));
        $manager->persist($consultation_3);


        $consultation_4 = (new Consultation($this->encoder))->setPatient($patient_4)->setDate((new DateTime("2022-12-04T13:00:00.012345Z")));
        $manager->persist($consultation_4);


        $consultation_5 = (new Consultation($this->encoder))->setPatient($patient_5)->setDate((new DateTime("2022-02-22T11:03:01.012345Z")));
        $manager->persist($consultation_5);


        $consultation_6 = (new Consultation($this->encoder))->setPatient($patient_6)->setDate((new DateTime("2021-09-18T15:03:01.012345Z")));
        $manager->persist($consultation_6);


        $consultation_7 = (new Consultation($this->encoder))->setPatient($patient_7)->setDate((new DateTime("2023-01-20T10:10:01.012345Z")));
        $manager->persist($consultation_7);

        // ORDERS
        $order_1 = (new Order())->setMedication($medoc_1)->setConsultation($consultation_2)->setPostlogy("6", "j");;
        $manager->persist($order_1);
        $order_2 = (new Order())->setMedication($medoc_5)->setConsultation($consultation_2)->setPostlogy("13", "m");;
        $manager->persist($order_2);
        $order_3 = (new Order())->setMedication($medoc_4)->setConsultation($consultation_2)->setPostlogy("3", "m");;
        $manager->persist($order_3);

        $order_4 = (new Order())->setMedication($medoc_6)->setConsultation($consultation_3)->setPostlogy("3", "m");
        $manager->persist($order_4);
        $order_5 = (new Order())->setMedication($medoc_7)->setConsultation($consultation_3)->setPostlogy("4", "j");
        $manager->persist($order_5);
        $order_6 = (new Order())->setMedication($medoc_1)->setConsultation($consultation_3);
        $manager->persist($order_6);

        $order_7 = (new Order())->setMedication($medoc_8)->setConsultation($consultation_1)->setPostlogy("1", "j");
        $manager->persist($order_7);
        

        $manager->flush();
    }
}
