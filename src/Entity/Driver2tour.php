<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver2tour
 *
 * @ORM\Table(name="driver2tour", indexes={@ORM\Index(name="IDX_ECD9AC006C7016EC", columns={"pkey_driver"}), @ORM\Index(name="IDX_ECD9AC009F5E2AB2", columns={"pkey_tour"}), @ORM\Index(name="IDX_ECD9AC00C0A86420", columns={"pkey_carregistration"})})
 * @ORM\Entity
 */
class Driver2tour
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
     * @var \Driver
     *
     * @ORM\ManyToOne(targetEntity="Driver")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_driver", referencedColumnName="pkey")
     * })
     */
    private $pkeyDriver;


    /**
     * @var \Carregistration
     *
     * @ORM\ManyToOne(targetEntity="Carregistration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_carregistration", referencedColumnName="pkey")
     * })
     */
    private $pkeyCarregistration;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Tour", inversedBy="driver2tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_tour", referencedColumnName="pkey")
     * })
     */
    private $pkeyTour;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getPkeyDriver(): ?Driver
    {
        return $this->pkeyDriver;
    }

    public function setPkeyDriver(?Driver $pkeyDriver): self
    {
        $this->pkeyDriver = $pkeyDriver;

        return $this;
    }

    public function getPkeyCarregistration(): ?Carregistration
    {
        return $this->pkeyCarregistration;
    }

    public function setPkeyCarregistration(?Carregistration $pkeyCarregistration): self
    {
        $this->pkeyCarregistration = $pkeyCarregistration;

        return $this;
    }

    public function getPkeyTour(): ?Tour
    {
        return $this->pkeyTour;
    }

    public function setPkeyTour(?Tour $pkeyTour): self
    {
        $this->pkeyTour = $pkeyTour;

        return $this;
    }


}
