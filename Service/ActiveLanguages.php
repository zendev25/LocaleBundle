<?php
namespace ZEN\LocaleBundle\Service;

/**
 * Description of ActiveLanguages
 *
 * @author jona
 */
class ActiveLanguages
{
    
    private $em;
    private $container;
    private $activeLanguages;
    
    public function __construct($container)
    {
        $this->container = $container;
        $this->em = $container->get('doctrine')->getManager();
    }
    
    public function defineLanguagesInParams()
    {
        
        $languagesRepo = $this->em->getRepository('ZENLocaleBundle:Language');
        $this->activeLanguages = $languagesRepo->findBy(['active'=>true]);
        
//        dump($this->activeLanguages);
//        $this->container->setParameter('locale.activeLanguage',$activeLanguages);        
    }
    
    public function getActive()
    {
        return $this->activeLanguages;
    }
}
