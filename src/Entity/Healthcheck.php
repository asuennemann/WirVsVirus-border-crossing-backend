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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="healthcheck_pkey_seq", allocationSize=1, initialValue=1)
     */
    private $pkey = 'uuid_generate_v4()';

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


}
