<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Driver
 *
 * @ORM\Table(name="driver")
 * @ORM\Entity
 */
class Driver
{
    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="guid", nullable=false, options={"default"="uuid_generate_v4()"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $pkey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="borderguard", type="guid", nullable=true, options={"default"="uuid_generate_v4()"})
     */
    private $borderguard;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="place", type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    private $mobile;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string|null
     *
     * @ORM\Column(name="passportid", type="string", length=255, nullable=true)
     */
    private $passportid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Driver2company", mappedBy="driver")
     */
    private $driver2company;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Driver2tour", mappedBy="pkeyDriver")
     */
    private $driver2tour;

    public function __construct()
    {
        $this->driver2company = new ArrayCollection();
        $this->driver2tour = new ArrayCollection();
    }

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getBorderguard(): ?string
    {
        return $this->borderguard;
    }

    public function setBorderguard(?string $borderguard): self
    {
        $this->borderguard = $borderguard;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(?\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPassportid(): ?string
    {
        return $this->passportid;
    }

    public function setPassportid(?string $passportid): self
    {
        $this->passportid = $passportid;

        return $this;
    }

    /**
     * @return Collection|Driver2Company[]
     */
    public function getDriver2company(): Collection
    {
        return $this->driver2company;
    }

    public function addDriver2company(Driver2Company $driver2company): self
    {
        if (!$this->driver2company->contains($driver2company)) {
            $this->driver2company[] = $driver2company;
            $driver2company->setDriver($this);
        }

        return $this;
    }

    public function removeDriver2company(Driver2Company $driver2company): self
    {
        if ($this->driver2company->contains($driver2company)) {
            $this->driver2company->removeElement($driver2company);
            // set the owning side to null (unless already changed)
            if ($driver2company->getDriver() === $this) {
                $driver2company->setDriver(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Driver2tour[]
     */
    public function getDriver2tour(): Collection
    {
        return $this->driver2tour;
    }

    public function addDriver2tour(Driver2tour $driver2tour): self
    {
        if (!$this->driver2tour->contains($driver2tour)) {
            $this->driver2tour[] = $driver2tour;
            $driver2tour->setPkeyDriver($this);
        }

        return $this;
    }

    public function removeDriver2tour(Driver2tour $driver2tour): self
    {
        if ($this->driver2tour->contains($driver2tour)) {
            $this->driver2tour->removeElement($driver2tour);
            // set the owning side to null (unless already changed)
            if ($driver2tour->getPkeyDriver() === $this) {
                $driver2tour->setPkeyDriver(null);
            }
        }

        return $this;
    }


}
