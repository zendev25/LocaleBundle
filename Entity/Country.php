<?php

namespace ZEN\LocaleBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Country
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZEN\LocaleBundle\Entity\CountryRepository")
 */
class Country extends TranslatableEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="ZEN\LocaleBundle\Entity\CountryNativeName", mappedBy="country",cascade={"all"})
     */
    private $nativeNames;

    /**
     * @var string
     *
     * @ORM\Column(name="OfficialName", type="string", length=255)
     */
    private $officialName;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=255)
     */
    private $iso;

    /**
     *
     * @ORM\ManyToOne(targetEntity="ZEN\LocaleBundle\Entity\Currency")
     */
    private $currency;

    /**
     * 
     * @ORM\ManyToMany(targetEntity="ZEN\LocaleBundle\Entity\Language")
     * 
     */
    private $languages;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity = "ZEN\LocaleBundle\Entity\Area", mappedBy = "country") 
     */
    private $areas;

    public function __toString() {
        if(null !== $this->name)
        return $this->name;
        else
            return'osef';
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set officialName
     *
     * @param string $officialName
     * @return Country
     */
    public function setOfficialName($officialName) {
        $this->officialName = $officialName;

        return $this;
    }

    /**
     * Get officialName
     *
     * @return string 
     */
    public function getOfficialName() {
        return $this->officialName;
    }

    /**
     * Set iso
     *
     * @param string $iso
     * @return Country
     */
    public function setIso($iso) {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string 
     */
    public function getIso() {
        return $this->iso;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set currency
     *
     * @param \ZEN\LocaleBundle\Entity\Currency $currency
     * @return Country
     */
    public function setCurrency(\ZEN\LocaleBundle\Entity\Currency $currency = null) {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \ZEN\LocaleBundle\Entity\Currency 
     */
    public function getCurrency() {
        return $this->currency;
    }

    /**
     * Add nativeNames
     *
     * @param \ZEN\LocaleBundle\Entity\CountryNativeName $nativeNames
     * @return Country
     */
    public function addNativeName(\ZEN\LocaleBundle\Entity\CountryNativeName $nativeNames) {
        $this->nativeNames[] = $nativeNames;
        $nativeNames->setCountry($this);

        return $this;
    }

    /**
     * Remove nativeNames
     *
     * @param \ZEN\LocaleBundle\Entity\CountryNativeName $nativeNames
     */
    public function removeNativeName(\ZEN\LocaleBundle\Entity\CountryNativeName $nativeNames) {
        $nativeNames->setCountry(null);
        $this->nativeNames->removeElement($nativeNames);
        return $this;
    }

    /**
     * Get nativeNames
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNativeNames() {
        return $this->nativeNames;
    }

    /**
     * Add languages
     *
     * @param \ZEN\LocaleBundle\Entity\Language $languages
     * @return Country
     */
    public function addLanguage(\ZEN\LocaleBundle\Entity\Language $languages) {
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \ZEN\LocaleBundle\Entity\Language $languages
     */
    public function removeLanguage(\ZEN\LocaleBundle\Entity\Language $languages) {
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguages() {
        return $this->languages;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Country
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Country
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add areas
     *
     * @param \ZEN\LocaleBundle\Entity\Area $areas
     * @return Country
     */
    public function addArea(\ZEN\LocaleBundle\Entity\Area $areas)
    {
        $this->areas[] = $areas;

        return $this;
    }

    /**
     * Remove areas
     *
     * @param \ZEN\LocaleBundle\Entity\Area $areas
     */
    public function removeArea(\ZEN\LocaleBundle\Entity\Area $areas)
    {
        $this->areas->removeElement($areas);
    }

    /**
     * Get areas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAreas()
    {
        return $this->areas;
    }
}
