<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VehicleRepository")
 */
class Vehicle
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
     * @ORM\Column(name="brand", type="string", length=255)
     * @Assert\NotNull()
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=255)
     * @Assert\NotNull()
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=1000)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_check", type="datetime")
     */
    private $lastCheck;

    /**
     * @var int
     *
     * @ORM\Column(name="kilometers", type="integer")
     */
    private $kilometers;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text", length=1000)
     */
    private $information;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School", inversedBy="vehicles")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $school;

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
     * Set brand
     *
     * @param string $brand
     * @return Vehicle
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set ref
     *
     * @param string $ref
     * @return Vehicle
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Vehicle
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lastCheck
     *
     * @param \DateTime $lastCheck
     * @return Vehicle
     */
    public function setLastCheck($lastCheck)
    {
        $this->lastCheck = $lastCheck;

        return $this;
    }

    /**
     * Get lastCheck
     *
     * @return \DateTime
     */
    public function getLastCheck()
    {
        return $this->lastCheck;
    }

    /**
     * Set kilometers
     *
     * @param integer $kilometers
     * @return Vehicle
     */
    public function setKilometers($kilometers)
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    /**
     * Get kilometers
     *
     * @return integer
     */
    public function getKilometers()
    {
        return $this->kilometers;
    }

    /**
     * Set information
     *
     * @param string $information
     * @return Vehicle
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Vehicle
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set school
     *
     * @param \AppBundle\Entity\School $school
     * @return Vehicle
     */
    public function setSchool(\AppBundle\Entity\School $school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \AppBundle\Entity\School
     */
    public function getSchool()
    {
        return $this->school;
    }
}
