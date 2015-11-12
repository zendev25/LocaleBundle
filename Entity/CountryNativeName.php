<?php

namespace ZEN\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryNativeName
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CountryNativeName
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
     * @ORM\Column(name="locale", type="string", length=255)
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="ZEN\LocaleBundle\Entity\Country",inversedBy="nativeNames")
     */
    private $country;


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
     * Set locale
     *
     * @param string $locale
     * @return CountryNativeName
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CountryNativeName
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
     * Set country
     *
     * @param \ZEN\LocaleBundle\Entity\Country $country
     * @return CountryNativeName
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
}
