<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormfieldValue
 *
 * @ORM\Table(name="formfield_value", indexes={@ORM\Index(name="IDX_5C5C72239F5E2AB2", columns={"pkey_tour"}), @ORM\Index(name="IDX_5C5C72239475FAB8", columns={"pkey_formtemplatefield"})})
 * @ORM\Entity
 */
class FormfieldValue
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
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

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
     * @var \Formtemplatefield
     *
     * @ORM\ManyToOne(targetEntity="Formtemplatefield")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_formtemplatefield", referencedColumnName="pkey")
     * })
     */
    private $pkeyFormtemplatefield;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

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

    public function getPkeyFormtemplatefield(): ?Formtemplatefield
    {
        return $this->pkeyFormtemplatefield;
    }

    public function setPkeyFormtemplatefield(?Formtemplatefield $pkeyFormtemplatefield): self
    {
        $this->pkeyFormtemplatefield = $pkeyFormtemplatefield;

        return $this;
    }


}
