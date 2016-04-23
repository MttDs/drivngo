<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\School", mappedBy="user")
     */
    private $schools;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment", mappedBy="user")
     */
    private $payments;

    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Employee", mappedBy="user")
     */
    private $employees;

    /**
     * @ORM\OneToMany(targetEntity="BackBundle\Entity\Student", mappedBy="user")
     */
    private $students;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Add schools
     *
     * @param \AppBundle\Entity\School $schools
     * @return User
     */
    public function addSchool(\AppBundle\Entity\School $schools)
    {
        $this->schools[] = $schools;

        return $this;
    }

    /**
     * Remove schools
     *
     * @param \AppBundle\Entity\School $schools
     */
    public function removeSchool(\AppBundle\Entity\School $schools)
    {
        $this->schools->removeElement($schools);
    }

    /**
     * Get schools
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchools()
    {
        return $this->schools;
    }

    /**
     * Add payments
     *
     * @param \AppBundle\Entity\Payment $payments
     * @return User
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
     * @return User
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
     * @return User
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
}
