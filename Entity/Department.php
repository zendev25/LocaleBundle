<?php

namespace ZEN\LocaleBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZEN\LocaleBundle\Entity\DepartmentRepository")
 */
class Department
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
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name"},updatable=false)
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @Assert\Valid()
<<<<<<< HEAD
     * @ORM\ManyToOne(targetEntity = "ZEN\LocaleBundle\Entity\Area", inversedBy = "departments")
=======
     * @ORM\ManyToOne(targetEntity = "ZEN\LocaleBundle\Entity\Area")
>>>>>>> 137ee28e6debf00dc7b350c71a5511e295db9fd4
     */
    private $area;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity = "ZEN\LocaleBundle\Entity\City", mappedBy = "department") 
     */
    private $cities;

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
     * @return Department
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
     * Set code
     *
     * @param string $code
     * @return Department
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Department
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
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set area
     *
     * @param \ZEN\LocaleBundle\Entity\Area $area
     * @return Department
     */
    public function setArea(\ZEN\LocaleBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \ZEN\LocaleBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Add cities
     *
     * @param \ZEN\LocaleBundle\Entity\City $cities
     * @return Department
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
}
