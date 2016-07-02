<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SchoolRepository")
 */
class School
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
     * @ORM\Column(name="address", type="string", length=255)
     * @Assert\NotNull()
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=10)
     * @Assert\NotNull()
     */
    private $postcode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotNull()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255)
     * @Assert\NotNull()
     */
    private $phone_number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="schools")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Employee", mappedBy="school", cascade={"remove"})
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Student", mappedBy="school", cascade={"remove"})
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pricing", mappedBy="school", cascade={"remove"})
     */
    private $pricings;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="school", cascade={"remove"})
     */
    private $payments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ad", mappedBy="school", cascade={"remove"})
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Vehicle", mappedBy="school", cascade={"remove"})
     */
    private $vehicles;

    public function getRegistrationPricings()
    {
        $pricings = array();

        foreach ($this->pricings as $pricing) {

            if ("Tarif inscription" == $pricing->getPricingCategory()->getName()) {
                $pricings[] = $pricing;
            }
        }

        return $pricings;
    }

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
     * Set address
     *
     * @param string $address
     * @return School
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return School
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return School
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return School
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
     * Set description
     *
     * @param string $description
     * @return School
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return School
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set phone_number
     *
     * @param string $phoneNumber
     * @return School
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;

        return $this;
    }

    /**
     * Get phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
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
     * @return School
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

    /**
     * Add payments
     *
     * @param \AppBundle\Entity\Payment $payments
     * @return School
     */
    public function addPayment(\AppBundle\Entity\Payment $payments)
    {
        $this->payments[] = $payments;

        return $this;
    }

    /**
     * Remove payments
     *
     * @param \AppBundle\Entity\Payment $payments
     */
    public function removePayment(\AppBundle\Entity\Payment $payments)
    {
        $this->payments->removeElement($payments);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Add employees
     *
     * @param \BackBundle\Entity\Employee $employees
     * @return School
     */
    public function addEmployee(\BackBundle\Entity\Employee $employees)
    {
        $this->employees[] = $employees;

        return $this;
    }

    /**
     * Remove employees
     *
     * @param \BackBundle\Entity\Employee $employees
     */
    public function removeEmployee(\BackBundle\Entity\Employee $employees)
    {
        $this->employees->removeElement($employees);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Add students
     *
     * @param \BackBundle\Entity\Student $students
     * @return School
     */
    public function addStudent(\BackBundle\Entity\Student $students)
    {
        $this->students[] = $students;

        return $this;
    }

    /**
     * Remove students
     *
     * @param \BackBundle\Entity\Student $students
     */
    public function removeStudent(\BackBundle\Entity\Student $students)
    {
        $this->students->removeElement($students);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add ads
     *
     * @param \AppBundle\Entity\Ad $ads
     * @return School
     */
    public function addAd(\AppBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;

        return $this;
    }

    /**
     * Remove ads
     *
     * @param \AppBundle\Entity\Ad $ads
     */
    public function removeAd(\AppBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }
}
