<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formtemplatefield
 *
 * @ORM\Table(name="formtemplatefield", indexes={@ORM\Index(name="IDX_E30236E55E237E06", columns={"name"}), @ORM\Index(name="IDX_E30236E57C2A9477", columns={"pkey_formtemplate"})})
 * @ORM\Entity
 */
class Formtemplatefield
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
     * @var string
     *
     * @ORM\Column(name="datatype", type="string", length=255, nullable=false)
     */
    private $datatype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pos", type="integer", nullable=true)
     */
    private $pos;

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
     * @var \Formtemplate
     *
     * @ORM\ManyToOne(targetEntity="Formtemplate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_formtemplate", referencedColumnName="pkey")
     * })
     */
    private $pkeyFormtemplate;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getDatatype(): ?string
    {
        return $this->datatype;
    }

    public function setDatatype(string $datatype): self
    {
        $this->datatype = $datatype;

        return $this;
    }

    public function getPos(): ?int
    {
        return $this->pos;
    }

    public function setPos(?int $pos): self
    {
        $this->pos = $pos;

        return $this;
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

    public function getPkeyFormtemplate(): ?Formtemplate
    {
        return $this->pkeyFormtemplate;
    }

    public function setPkeyFormtemplate(?Formtemplate $pkeyFormtemplate): self
    {
        $this->pkeyFormtemplate = $pkeyFormtemplate;

        return $this;
    }


}
