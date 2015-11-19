<?php

namespace ZEN\LocaleBundle\Service;

/**
 * Description of ActiveLanguages
 *
 * @author jona
 */
class ActiveLanguages {

    private $em;
    private $container;

    public function __construct($container) {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }

    public function getActive() {
        $languagesRepo = $this->em->getRepository('ZENLocaleBundle:Language');
        return $languagesRepo->findBy(['active' => true]);
    }

}
