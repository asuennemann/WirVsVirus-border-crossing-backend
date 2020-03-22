<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table(name="tour")
 * @ORM\Entity
 */
class Tour
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tour2border", mappedBy="pkeyTour")
     */
    private $tour2border;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Driver2tour", mappedBy="pkeyTour")
     */
    private $driver2tour;

    public function __construct()
    {
        $this->tour2border = new ArrayCollection();
    }

    public function getPkey(): ?string
    {
        return $this->pkey;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }


    /**
     * @return Collection|Tour2border[]
     */
    public function getTour2border(): Collection
    {
        return $this->tour2border;
    }

    public function addTour2border(Tour2border $tour2border): self
    {
        if (!$this->tour2border->contains($tour2border)) {
            $this->tour2border[] = $tour2border;
            $tour2border->setPkeyTour($this);
        }

        return $this;
    }

    public function removeTour2border(Tour2border $tour2border): self
    {
        if ($this->tour2border->contains($tour2border)) {
            $this->tour2border->removeElement($tour2border);
            // set the owning side to null (unless already changed)
            if ($tour2border->getPkeyTour() === $this) {
                $tour2border->setPkeyTour(null);
            }
        }

        return $this;
    }

    public function getDriver2tour(): ?Driver2tour
    {
        return $this->driver2tour;
    }

    public function setDriver2tour(?Driver2tour $driver2tour): self
    {
        $this->driver2tour = $driver2tour;

        // set (or unset) the owning side of the relation if necessary
        $newPkeyTour = null === $driver2tour ? null : $this;
        if ($driver2tour->getPkeyTour() !== $newPkeyTour) {
            $driver2tour->setPkeyTour($newPkeyTour);
        }

        return $this;
    }

}
