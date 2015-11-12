<?php

namespace ZEN\LocaleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SKCMS\UserBundle\Entity\Country;

class ImportLanguageTranslationCommand extends ContainerAwareCommand {

    const LANGUAGE_DIR = '/../Resources/public/datas/languages/';

    protected function configure() {
        $this
                ->setName('skcms:import:languages:translation')
                ->setDescription('Translate languages from xml file')
                ->addArgument('langue', InputArgument::REQUIRED, 'Langue ?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $nombrePays = $this->createLanguages($input->getArgument('langue'));
        $output->writeln($nombrePays . ' languages successfully translated');
    }

    public function createLanguages($langue) {

        $em = $this->getContainer()->get('doctrine')->getManager();
        $repoLanguage = $em->getRepository('ZENLocaleBundle:Language');


        $xmlLanguages = simplexml_load_file(__DIR__ . self::LANGUAGE_DIR . $langue . '.xml');

        $languageAdded = [];
        foreach ($xmlLanguages->localeDisplayNames->languages->language as $xmlLanguage) {
            if (!in_array($xmlLanguage['type'], $languageAdded)) {
                $languageAdded[] = $xmlLanguage['type'];

                $language = $repoLanguage->findOneByISO($xmlLanguage['type']);

                if (!empty($language)) {
                    $language->setStatusTrans(true);
                    $language->setName($xmlLanguage);
                    $language->setLocale($langue);
                    $em->persist($language);
                }
            }
        }

        $em->flush();

        return count($languageAdded);
    }

}
