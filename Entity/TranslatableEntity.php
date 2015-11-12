<?php

namespace ZEN\LocaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TranslatableEntity
 *
 *  @ORM\MappedSuperclass 
 *  @Gedmo\TranslationEntity(class="ZEN\LocaleBundle\Entity\Translation\EntityTranslation")  
 */
class TranslatableEntity implements Translatable {

    /**
     * @ORM\Column(name="id",type="integer") 
     */
    protected $id;

    /**
     * Post locale
     * Used locale to override Translation listener's locale
     *
     * @Gedmo\Locale
     */
    protected $locale;

    /**
     * @var boolean
     * @ORM\Column(name="status_trans", type="boolean", options={"default" = 1})
     */
    private $statusTrans;

    public function __construct() {
        $this->statusTrans = true;
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
     * Set locale
     *
     * @param string $locale
     * @return TranslatableEntity
     */
    public function setLocale($locale) {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale() {
        return $this->locale;
    }

    /**
     * Set statusTrans
     *
     * @param boolean $statusTrans
     * @return TranslatableEntity
     */
    public function setStatusTrans($statusTrans) {
        $this->statusTrans = $statusTrans;

        return $this;
    }

    /**
     * Get statusTrans
     *
     * @return boolean 
     */
    public function getStatusTrans() {
        return $this->statusTrans;
    }

}
