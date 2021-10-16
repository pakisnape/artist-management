<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CelebrityRepresentative
 *
 * @ORM\Table(name="celebrity_representative", indexes={@ORM\Index(name="IDX_3B9810D6B7C621DD", columns={"celebrity_id"}), @ORM\Index(name="IDX_3B9810D68D510F91", columns={"representative_type_id"}), @ORM\Index(name="IDX_3B9810D6C01675FE", columns={"representative_id"})})
 * @ORM\Entity
 */
class CelebrityRepresentative
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="territory", type="string", length=255, nullable=true)
     */
    private $territory;
    
    /**
     * @var int
     *
     * @ORM\Column(name="celebrity_id", type="integer", nullable=false)
     */
    private $celebrity_id;
    
    /**
     * @var int
     *
     * @ORM\Column(name="representative_id", type="integer", nullable=false)
     */
    private $representative_id;

    /**
     * @var \RepresentativeType
     *
     * @ORM\ManyToOne(targetEntity="RepresentativeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_type_id", referencedColumnName="id")
     * })
     */
    private $representativeType;

    /**
     * @var \Celebrity
     *
     * @ORM\ManyToOne(targetEntity="Celebrity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="celebrity_id", referencedColumnName="id")
     * })
     */
    private $celebrity;

    /**
     * @var \Representative
     *
     * @ORM\ManyToOne(targetEntity="Representative")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representative_id", referencedColumnName="id")
     * })
     */
    private $representative;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTerritory(): ?string
    {
        return $this->territory;
    }

    public function setTerritory(?string $territory): self
    {
        $this->territory = $territory;

        return $this;
    }
    
    public function setCelebrityID(?int $celebrity_id): self
    {
        $this->celebrity_id = $celebrity_id;

        return $this;
    }
    
    public function setRepresentativeID(?int $representative_id): self
    {
        $this->representative_id = $representative_id;

        return $this;
    }

    public function getRepresentativeType(): ?RepresentativeType
    {
        return $this->representativeType;
    }

    public function setRepresentativeType(?RepresentativeType $representativeType): self
    {
        $this->representativeType = $representativeType;

        return $this;
    }

    public function getCelebrity(): ?Celebrity
    {
        return $this->celebrity;
    }

    public function setCelebrity(?Celebrity $celebrity): self
    {
        $this->celebrity = $celebrity;

        return $this;
    }

    public function getRepresentative(): ?Representative
    {
        return $this->representative;
    }

    public function setRepresentative(?Representative $representative): self
    {
        $this->representative = $representative;

        return $this;
    }


}
