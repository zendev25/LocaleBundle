<?php

namespace ZEN\LocaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/*
 * @Security("has_role('ROLE_ADMIN')")
 */

class CountriesController extends Controller
{
    public function resetAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        //dump($request->getLocale());
        die();
        $em = $this->getDoctrine()->getManager();
        $countriesRepo = $em->getRepository('ZENLocaleBundle:Country');
        $countries = $countriesRepo->findAll();
        
        foreach ($countries as $country)
        {
            $em->remove($country);
        }
        $em->flush();
        
        $jsonCountries = json_decode(file_get_contents(__DIR__.  \ZEN\LocaleBundle\Command\ImportCountriesCommand::COUNTRIES_FILE),true);
        
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
        }
        
        return $this->render('ZENLocaleBundle:Default:index.html.twig', array('name' => $name));
    }
}
