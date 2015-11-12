<?php
namespace ZEN\LocaleBundle\Listener;

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
//        $this->container->setParameter('locale.activeLanguage',$activeLanguages);        
    }
    
    public function getActive()
    {
        return $this->activeLanguages;
    }
}
