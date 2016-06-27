<?php

namespace ZEN\LocaleBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZEN\LocaleBundle\Entity\AreaRepository")
 */
class Area
{
    /**
     * @var integer
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
     * @var string
     * @Gedmo\Slug(fields={"name"},updatable=false)
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;
    
    
    /**
     * @Assert\Valid()
     * @ORM\ManyToOne(targetEntity = "ZEN\LocaleBundle\Entity\Country", inversedBy = "areas")
     */
    private $country;
    
    
    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity = "ZEN\LocaleBundle\Entity\Department", mappedBy = "area")
     */
    private $departments;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity ="ZEN\LocaleBundle\Entity\City", mappedBy = "area")
     */
    private $cities;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity ="LE\CoreBundle\Entity\HomeConfig", cascade={"persist"} )
     */
    private $configHosts;
    
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
     * @return Area
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
     * Set slug
     *
     * @param string $slug
     * @return Area
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Area
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set country
     *
     * @param \ZEN\LocaleBundle\Entity\Country $country
     * @return Area
     */
    public function setCountry(\ZEN\LocaleBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \ZEN\LocaleBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Add departments
     *
     * @param \ZEN\LocaleBundle\Entity\Department $departments
     * @return Area
     */
    public function addDepartment(\ZEN\LocaleBundle\Entity\Department $departments)
    {
        $this->departments[] = $departments;

        return $this;
    }

    /**
     * Remove departments
     *
     * @param \ZEN\LocaleBundle\Entity\Department $departments
     */
    public function removeDepartment(\ZEN\LocaleBundle\Entity\Department $departments)
    {
        $this->departments->removeElement($departments);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Add cities
     *
     * @param \ZEN\LocaleBundle\Entity\City $cities
     * @return Area
     */
    public function addCity(\ZEN\LocaleBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;

        return $this;
    }

    /**
     * Remove cities
     *
     * @param \ZEN\LocaleBundle\Entity\City $cities
     */
    public function removeCity(\ZEN\LocaleBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set configHosts
     *
     * @param \LE\CoreBundle\Entity\HomeConfig $configHosts
     * @return Area
     */
    public function setConfigHosts(\LE\CoreBundle\Entity\HomeConfig $configHosts = null)
    {
        $this->configHosts = $configHosts;

        return $this;
    }

    /**
     * Get configHosts
     *
     * @return \LE\CoreBundle\Entity\HomeConfig 
     */
    public function getConfigHosts()
    {
        return $this->configHosts;
    }
}
