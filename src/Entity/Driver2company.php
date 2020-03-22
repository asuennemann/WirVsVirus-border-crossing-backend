<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver2company
 *
 * @ORM\Table(name="driver2company", indexes={@ORM\Index(name="IDX_C1AED845C3423909", columns={"driver_id"}), @ORM\Index(name="IDX_C1AED845979B1AD6", columns={"company_id"})})
 * @ORM\Entity
 */
class Driver2company
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
     *   @ORM\JoinColumn(name="driver_id", referencedColumnName="pkey")
     * })
     */
    private $driver;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="pkey")
     * })
     */
    private $company;


    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getDriver(): ?Driver
    {
        return $this->driver;
    }

    public function setDriver(?Driver $driver): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

}
