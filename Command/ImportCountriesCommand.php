<?php
namespace ZEN\LocaleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SKCMS\UserBundle\Entity\Country;

class ImportCountriesCommand extends ContainerAwareCommand 
{
    
    const COUNTRIES_FILE = '/../Resources/public/datas/countries.json';
    
    
    protected function configure()
    {
        $this
            ->setName('skcms:import:countries')
            ->setDescription('Import countries from json file')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $nombrePays = $this->createCountries();
        $output->writeln($nombrePays.' countries successfully added');
    }
    
    public function createCountries()
    {
//        $this->getContainer()->get('request')->setLocale('fr');
//        $translatable = $this->getContainer()->get('gedmo.listener.translatable');
//        $translatable->setTranslatableLocale('fr');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $jsonCountries = json_decode(file_get_contents(__DIR__.self::COUNTRIES_FILE),true);
        
        $languagesRepo = $em->getRepository('ZENLocaleBundle:Language');
        $currencyRepo = $em->getRepository('ZENLocaleBundle:Currency');
        
        
        $locales = ['en','nl','es','it','pt'];
        foreach ($jsonCountries as $jsonCountry)
        {
            $country = new \ZEN\LocaleBundle\Entity\Country();
            
            $locale = 'fr';
            
            $country->setLocale($locale);
            $country->setName(isset($jsonCountry['translations'][$locale])? $jsonCountry['translations'][$locale]['common']:$jsonCountry['name']['common']);
            $country->setOfficialName($jsonCountry['name']['official']);
            $country->setIso($jsonCountry['cca3']);
            
            
            foreach ($jsonCountry['languages'] as $languageIso => $languageName)
            {
                $language = $languagesRepo->findOneBy(['iSO'=>$languageIso]);
                if (null !== $language)
                {
                    $country->addLanguage($language);
                }
                
            }
            
            foreach ($jsonCountry['name']['native'] as $nativeLanguage => $nativeNameData)
            {
                $nativeName = new \ZEN\LocaleBundle\Entity\CountryNativeName();
                $nativeName->setLocale($nativeLanguage);
                $nativeName->setName($nativeNameData['common']);
                
                $country->addNativeName($nativeName);
            }
            
            if (count($jsonCountry['currency']))
            {
                $currencyIso = $jsonCountry['currency'][0];

                $currency = $currencyRepo->findOneBy(['iso'=>$currencyIso]);

                if (null !== $currency)
                {
                    $country->setCurrency($currency);
                }
            }
            
            
            
            $em->persist($country);
            $em->flush();
//            
            new \Gedmo\Translatable\Entity\Translation();
            $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');
            foreach ($locales as $locale)
            {
                
                if (isset($jsonCountry['translations'][$locale]) || $locale == "en")
                {
                    
                    $country->setLocale($locale);
                    $em->refresh($country);
                    $country->setName($locale == 'en' ? $jsonCountry['name']['common'] : $jsonCountry['translations'][$locale]['common']);

                    $em->persist($country);
                    $em->flush();

                    
                }
                
            }
           
            
//            die();
            
            
        }
        
        
        
        return count($jsonCountries);
        
    }
}
