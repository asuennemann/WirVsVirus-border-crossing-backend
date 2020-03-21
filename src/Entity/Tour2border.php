<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour2border
 *
 * @ORM\Table(name="tour2border", indexes={@ORM\Index(name="IDX_181AA1B89F5E2AB2", columns={"pkey_tour"}), @ORM\Index(name="IDX_181AA1B8BAE30142", columns={"pkey_border"})})
 * @ORM\Entity
 */
class Tour2border
{
    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="guid", nullable=false, options={"default"="uuid_generate_v4()"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tour2border_pkey_seq", allocationSize=1, initialValue=1)
     */
    private $pkey = 'uuid_generate_v4()';

    /**
     * @var \Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_tour", referencedColumnName="pkey")
     * })
     */
    private $pkeyTour;

    /**
     * @var \Border
     *
     * @ORM\ManyToOne(targetEntity="Border")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_border", referencedColumnName="pkey")
     * })
     */
    private $pkeyBorder;

    public function getPkey(): ?string
    {
        return $this->pkey;
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

    public function getPkeyBorder(): ?Border
    {
        return $this->pkeyBorder;
    }

    public function setPkeyBorder(?Border $pkeyBorder): self
    {
        $this->pkeyBorder = $pkeyBorder;

        return $this;
    }


}
