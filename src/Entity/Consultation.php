<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
#[ApiResource(normalizationContext: ['groups' => ['read_consultations']], denormalizationContext: ['groups' => ['write_consultations']])]
class Consultation implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["read_consultations", "write_consultations"])]
    private $id;
    
    #[ORM\Column(type: 'string', length: 180, unique: false)]
    #[Groups(["read_consultations", "write_consultations"])]
    private $username = "Doctor";
    
    #[ORM\Column(type: 'json')] 
    private $roles = [];
    
    #[ORM\Column(type: 'string')]
    private $password;
    
    #[ORM\Column(type: 'datetime')]
    #[Groups(["read_consultations", "write_consultations"])]
    private $date;
    
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(["read_consultations", "write_consultations"])]
    private $doctor_name = "Doctor";
    
    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(["read_consultations", "write_consultations"])]
    private $doctor_matricule = "IOUZD5E4FKBHS";
    
    #[ORM\ManyToOne(targetEntity: Patient::class, inversedBy: 'consultations')]
    #[Groups(["read_consultations", "write_consultations"])]
    private $patient;
    
    #[ORM\OneToMany(mappedBy: 'consultation', targetEntity: Order::class)]
    #[Groups(["read_consultations", "write_consultations"])]
    private $orders;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->orders = new ArrayCollection();
        $this->password = $encoder->hashPassword($this, "doctor");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDoctorName(): ?string
    {
        return $this->doctor_name;
    }

    public function setDoctorName(string $doctor_name): self
    {
        $this->doctor_name = $doctor_name;

        return $this;
    }

    public function getDoctorMatricule(): ?string
    {
        return $this->doctor_matricule;
    }

    public function setDoctorMatricule(string $doctor_matricule): self
    {
        $this->doctor_matricule = $doctor_matricule;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setConsultation($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getConsultation() === $this) {
                $order->setConsultation(null);
            }
        }

        return $this;
    }
}
