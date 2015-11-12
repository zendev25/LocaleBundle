<?php

namespace ZEN\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Language
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ZEN\LocaleBundle\Entity\LanguageRepository")
 */
class Language extends TranslatableEntity {

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
     * @ORM\Column(name="nativeName", type="string", length=255)
     */
    private $nativeName;

    /**
     *
     * @var string
     * 
     * @ORM\Column(name="ISO",type="string",length=10)
     */
    private $iSO;

    /**
     *
     * @ORM\Column(name="active",type="boolean")
     */
    private $active;

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

    public function __toString() {
        return null !== $this->name ? $this->name : $this->nativeName;
    }

    public function __construct() {
        $this->active = false;
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
     * @return Language
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
        return null !== $this->name ? $this->name : $this->nativeName;
    }

    /**
     * Set nativeName
     *
     * @param string $nativeName
     * @return Language
     */
    public function setNativeName($nativeName) {
        $this->nativeName = $nativeName;

        return $this;
    }

    /**
     * Get nativeName
     *
     * @return string 
     */
    public function getNativeName() {
        return $this->nativeName;
    }

    /**
     * Set iSO
     *
     * @param string $iSO
     * @return Language
     */
    public function setISO($iSO) {
        $this->iSO = $iSO;

        return $this;
    }

    /**
     * Get iSO
     *
     * @return string 
     */
    public function getISO() {
        return $this->iSO;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Language
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive() {
        return $this->active;
    }


    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Language
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
     * @return Language
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
}
