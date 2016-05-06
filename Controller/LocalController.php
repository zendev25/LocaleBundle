<?php

namespace ZEN\LocaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ZEN\LocaleBundle\Entity\Area;
use ZEN\LocaleBundle\Entity\Department;
use ZEN\LocaleBundle\Entity\City;


class LocalController extends Controller 
{
//    public function importCSVRegionAction(){
//        
//        $em = $this->getDoctrine()->getManager();
//        $countryRepo = $em->getRepository('ZENLocaleBundle:Country');
//        $countryEntity = $countryRepo->findOneBy(array ('name' => 'France'));
//
//        $regionFile = fopen('C:/wamp64/www/hall-inn/trunk/web/uploads/imports/region_france.csv','r');
//        while (($line = fgetcsv($regionFile)) !== FALSE) {
//            $area = new Area();
//            $area->setName($line[1]);
//            $area->setCode(intval($line[0]));
//            $area->setSlug($line[2]);
//            $area->setCountry($countryEntity);
//            $em->persist($area);
//        }
//        fclose($regionFile);
//        $em->flush();
//        
//    }
//    
//    
//    public function importCSVDepartmentAction(){
//
//        $em = $this->getDoctrine()->getManager();
//        $areaRepo = $em->getRepository('ZENLocaleBundle:Area');
//        
//        $dptFile = fopen('C:/wamp64/www/hall-inn/trunk/web/uploads/imports/departement_france.csv','r');
//        while (($line = fgetcsv($dptFile)) !== FALSE) {
//            $dpt = new Department();
//            $dpt->setCode(strtoupper($line[1]));
//            $dpt->setName($line[2]);
//            $dpt->setSlug($line[3]);
//            $areaEntity = $areaRepo->findOneBy(array ('code' => intval($line[0])));
//            dump($areaEntity);
//            $dpt->setArea($areaEntity);
//            $em->persist($dpt);
//        }
//        fclose($dptFile);
//        $em->flush();
//    }
//    
//    public function importCSVCityAction(){
//        set_time_limit(0);
//        
//        $em = $this->getDoctrine()->getManager();
//        
//        $dptRepo = $em->getRepository('ZENLocaleBundle:Department');
//        
//        $cityFile = fopen('C:/wamp64/www/hall-inn/trunk/web/uploads/imports/city_france_8.csv','r');
//        while (($line = fgetcsv($cityFile)) !== FALSE) {
//            $city = new City();
//            $city->setName($line[1]);
//            $currentCode = strtoupper(strval($line[0]));
//            $departmentEntity = $dptRepo->findOneBy(array ('code' => $currentCode));
//            $city->setDepartment($departmentEntity);
//            $em->persist($city);
//        }
//        fclose($cityFile);
//        $em->flush();
//    }
//    
//    public function importCityDataAction(){
//        set_time_limit(0);
//        $em = $this->getDoctrine()->getManager();
//        $dptRepo = $em->getRepository('ZENLocaleBundle:Department');
//        $codeValue = '976';
//        $continue = true;
//        $prev='0';
//        $cityFile = fopen('C:/wamp64/www/hall-inn/trunk/web/uploads/imports/villes_france.csv','r');
//        while (($line = fgetcsv($cityFile)) !== FALSE && $continue) {
//            $code = $line[1];
//            if ($code == $codeValue) {
//            
//               if ($code == '971') {
//                    $city = new City();
//                    $city->setName('Saint-Barthélemy');
//                    $city->setSlug('st-barthelemy');
//                    $city->setCode('97133');
//                    $city->setDepartment($dptEntity);
//                    $city->setInsee('97123');
//                    $city->setPopulation('8938');
//                    $city->setLongitude(floatval('-62.8333'));
//                    $city->setLatitude(floatval('17.9167'));
//                    $em->persist($city);
//                    dump($city);    
//
//                    $city = new City();
//                    $city->setName('Saint-Martin');
//                    $city->setSlug('st-martin');
//                    $city->setCode('97150');
//                    $city->setDepartment($dptEntity);
//                    $city->setInsee('97127');
//                    $city->setPopulation('36979');
//                    $city->setLongitude(floatval('18.0913'));
//                    $city->setLatitude(floatval('-63.0829'));
//                    $em->persist($city);
//                    dump($city);   
//                }
//            
//                $city = new City();
//                $dptEntity = $dptRepo->findOneBy(array ('code' => $code));
//                $city->setName($line[5]);
//                $city->setSlug($line[2]);
//                $city->setCode($line[8]);
//                $city->setDepartment($dptEntity);
//                $city->setInsee($line[10]);
//                $city->setPopulation($line[15]);
//                if ($line[19] != 0 ){
//                    $city->setLongitude(floatval($line[19]));
//                }
//                if ($line[20] != 0 ){
//                    $city->setLatitude(floatval($line[20]));
//                }
//                $em->persist($city);
//                dump($city);    
//            }elseif($prev == $codeValue){
//                $continue = false;
//            }
//            $prev = $code;
//        }
//        $em->flush();
//        fclose($cityFile);
//    }
    
  
    public function checkAction(){
        set_time_limit(0);
        $em = $this->getDoctrine()->getManager();
        $cityRepo = $em->getRepository('ZENLocaleBundle:City');
        $dptRepo = $em->getRepository('ZENLocaleBundle:Department');
//        $ContryRepo = $em->getRepository('ZENLocaleBundle:Country');
//        $hostRepo = $em->getRepository('LECoreBundle:host');
//        $addressRepo = $em->getRepository('ZENLocaleBundle:Address');



//        $city = new City();
//        $city->setName('Putot-en-Auge');
//        $departmentEntity = $dptRepo->findOneBy(array ('code' => '14'));
//        $city->setDepartment($departmentEntity);
//        $em->persist($city);
//        $em->flush();
//        
//        $query = $em->createQuery('DELETE ZENLocaleBundle:City c WHERE c.id > 0');
//        $query->execute(); 
        
        
          $dptEntity = $dptRepo->findOneBy(array ('code' => '971'));
       
//        $result = $cityRepo->createQueryBuilder('c')
//                        ->where('c.slug LIKE :pattern')
//                        ->setParameter('pattern', '%î%')
//                        ->getQuery()
//                        ->getResult();
        
//        $cityEntity = $cityRepo->findOneBy(array ('slug' => 'besancon'));
        //$arrea1 = $cityEntity->getAddress();
//        dump($cityEntity);
//        $cityEntity = $cityRepo->findAll();
//        dump($cityEntity);
//        $cityEntity2 = $dptRepo->findOneBy(array ('id' => 97));
//        $cities = $cityEntity2->getCities();
//        dump($cityEntity);
//        dump($cityEntity2);
//        dump($cities[0]);
    }
}

