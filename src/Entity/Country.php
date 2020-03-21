<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="guid", nullable=false, options={"default"="uuid_generate_v4()"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="country_pkey_seq", allocationSize=1, initialValue=1)
     */
    private $pkey = 'uuid_generate_v4()';

    /**
     * @var string
     *
     * @ORM\Column(name="countryname", type="string", length=255, nullable=false)
     */
    private $countryname;

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getCountryname(): ?string
    {
        return $this->countryname;
    }

    public function setCountryname(string $countryname): self
    {
        $this->countryname = $countryname;

        return $this;
    }


}
