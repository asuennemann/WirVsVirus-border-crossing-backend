<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carregistration
 *
 * @ORM\Table(name="carregistration", indexes={@ORM\Index(name="IDX_5697EA251971DB06", columns={"pkey_company"})})
 * @ORM\Entity
 */
class Carregistration
{
    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="guid", nullable=false, options={"default"="uuid_generate_v4()"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="carregistration_pkey_seq", allocationSize=1, initialValue=1)
     */
    private $pkey = 'uuid_generate_v4()';

    /**
     * @var string|null
     *
     * @ORM\Column(name="carregistration", type="string", length=255, nullable=true)
     */
    private $carregistration;

    /**
     * @var \Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_company", referencedColumnName="pkey")
     * })
     */
    private $pkeyCompany;


}
