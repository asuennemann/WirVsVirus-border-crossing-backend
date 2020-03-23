<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Border
 *
 * @ORM\Table(name="border", indexes={@ORM\Index(name="IDX_C7F56B77CF908BAF", columns={"ridefrom"}), @ORM\Index(name="IDX_C7F56B77F0CB1F1", columns={"rideto"})})
 * @ORM\Entity
 */
class Border
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
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ridefrom", referencedColumnName="pkey")
     * })
     */
    private $ridefrom;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rideto", referencedColumnName="pkey")
     * })
     */
    private $rideto;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getRidefrom(): ?Country
    {
        return $this->ridefrom;
    }

    public function setRidefrom(?Country $ridefrom): self
    {
        $this->ridefrom = $ridefrom;

        return $this;
    }

    public function getRideto(): ?Country
    {
        return $this->rideto;
    }

    public function setRideto(?Country $rideto): self
    {
        $this->rideto = $rideto;

        return $this;
    }


}
