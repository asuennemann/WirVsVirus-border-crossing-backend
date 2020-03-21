<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driver2tour
 *
 * @ORM\Table(name="driver2tour", indexes={@ORM\Index(name="IDX_ECD9AC006C7016EC", columns={"pkey_driver"}), @ORM\Index(name="IDX_ECD9AC009F5E2AB2", columns={"pkey_tour"}), @ORM\Index(name="IDX_ECD9AC00C0A86420", columns={"pkey_carregistration"})})
 * @ORM\Entity
 */
class Driver2tour
{
    /**
     * @var string
     *
     * @ORM\Column(name="pkey", type="guid", nullable=false, options={"default"="uuid_generate_v4()"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="driver2tour_pkey_seq", allocationSize=1, initialValue=1)
     */
    private $pkey = 'uuid_generate_v4()';

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
     * @var \Tour
     *
     * @ORM\ManyToOne(targetEntity="Tour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_tour", referencedColumnName="pkey")
     * })
     */
    private $pkeyTour;

    /**
     * @var \Carregistration
     *
     * @ORM\ManyToOne(targetEntity="Carregistration")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pkey_carregistration", referencedColumnName="pkey")
     * })
     */
    private $pkeyCarregistration;


}
