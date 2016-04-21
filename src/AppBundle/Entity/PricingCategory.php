<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PricingCategory
 *
 * @ORM\Table(name="pricing_category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PricingCategoryRepository")
 */
class PricingCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pricing", mappedBy="pricingCategory")
     */
    private $pricings;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return PricingCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pricings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pricings
     *
     * @param \AppBundle\Entity\Pricing $pricings
     * @return PricingCategory
     */
    public function addPricing(\AppBundle\Entity\Pricing $pricings)
    {
        $this->pricings[] = $pricings;

        return $this;
    }

    /**
     * Remove pricings
     *
     * @param \AppBundle\Entity\Pricing $pricings
     */
    public function removePricing(\AppBundle\Entity\Pricing $pricings)
    {
        $this->pricings->removeElement($pricings);
    }

    /**
     * Get pricings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPricings()
    {
        return $this->pricings;
    }
}
