<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Healthcheck
 *
 * @ORM\Table(name="healthcheck", indexes={@ORM\Index(name="IDX_7C2E0BB76C7016EC", columns={"pkey_driver"}), @ORM\Index(name="IDX_7C2E0BB7BEE69743", columns={"pkey_guard"})})
 * @ORM\Entity
 */
class Healthcheck
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
     * @var \DateTime
     *
     * @ORM\Column(name="due", type="datetime", nullable=false)
     */
    private $due;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

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
     * @var \Guard
     *
     * @ORM\ManyToOne(targetEntity="Guard")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_guard", referencedColumnName="pkey")
     * })
     */
    private $pkeyGuard;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getDue(): ?\DateTimeInterface
    {
        return $this->due;
    }

    public function setDue(\DateTimeInterface $due): self
    {
        $this->due = $due;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
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

    public function getPkeyGuard(): ?Guard
    {
        return $this->pkeyGuard;
    }

    public function setPkeyGuard(?Guard $pkeyGuard): self
    {
        $this->pkeyGuard = $pkeyGuard;

        return $this;
    }


}
