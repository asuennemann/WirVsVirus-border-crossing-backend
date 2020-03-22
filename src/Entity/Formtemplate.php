<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formtemplate
 *
 * @ORM\Table(name="formtemplate", indexes={@ORM\Index(name="IDX_D2449EC55E237E06", columns={"name"}), @ORM\Index(name="IDX_D2449EC5BAE30142", columns={"pkey_border"})})
 * @ORM\Entity
 */
class Formtemplate
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
     *   @ORM\JoinColumn(name="name", referencedColumnName="pkey")
     * })
     */
    private $name;

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

    public function getName(): ?Country
    {
        return $this->name;
    }

    public function setName(?Country $name): self
    {
        $this->name = $name;

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
