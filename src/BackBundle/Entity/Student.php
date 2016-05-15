<?php

namespace BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="BackBundle\Repository\StudentRepository")
 */
class Student
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
     * @var integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School", inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $school;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $user;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var bool
     *
     * @ORM\Column(name="e_learning", type="boolean", options={"default":0})
     */
    private $eLearning;

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
     * Set active
     *
     * @param boolean $active
     * @return Student
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set school
     *
     * @param \AppBundle\Entity\School $school
     * @return Student
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

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     * @return Student
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
     * Set eLearning
     *
     * @param boolean $eLearning
     * @return Student
     */
    public function setELearning($eLearning)
    {
        $this->eLearning = $eLearning;

        return $this;
    }

    /**
     * Get eLearning
     *
     * @return boolean 
     */
    public function getELearning()
    {
        return $this->eLearning;
    }
}
