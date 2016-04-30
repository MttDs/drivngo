<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ad
 *
 * @ORM\Table(name="ad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdRepository")
 */
class Ad
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
     * @ORM\Column(name="file_name", type="string", length=255)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $school;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AdType", inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $ad_type;

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
     * Set fileName
     *
     * @param string $fileName
     * @return Ad
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Ad
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set school
     *
     * @param \BackBundle\Entity\School $school
     * @return Ad
     */
    public function setSchool(\BackBundle\Entity\School $school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \BackBundle\Entity\School
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set ad_type
     *
     * @param \BackBundle\Entity\AdType $adType
     * @return Ad
     */
    public function setAdType(\BackBundle\Entity\AdType $adType)
    {
        $this->ad_type = $adType;

        return $this;
    }

    /**
     * Get ad_type
     *
     * @return \BackBundle\Entity\AdType
     */
    public function getAdType()
    {
        return $this->ad_type;
    }
}
