<?php

namespace ZEN\LocaleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use SKCMS\UserBundle\Entity\Country;

class ImportLanguagesCommand extends ContainerAwareCommand {

    const LANGUAGES_FILE = '/../Resources/public/datas/languages/en.xml';

    protected function configure() {
        $this
                ->setName('skcms:import:languages')
                ->setDescription('Import languages from xml file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $nombrePays = $this->createLanguages();
        $output->writeln($nombrePays . ' languages successfully added');
    }

    public function createLanguages() {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $xmlLanguages = simplexml_load_file(__DIR__ . self::LANGUAGES_FILE);

        $languageAdded = [];
        foreach ($xmlLanguages->localeDisplayNames->languages->language as $xmlLanguage) {
            if (!in_array($xmlLanguage['type'], $languageAdded)) {
                $languageAdded[] = $xmlLanguage['type'];

                $language = new \ZEN\LocaleBundle\Entity\Language();

                $language->setStatusTrans(true);
                $language->setName($xmlLanguage);
                $language->setNativeName($xmlLanguage);
                $language->setIso($xmlLanguage['type']);

                $em->persist($language);
            }
        }

        $em->flush();

        return count($languageAdded);
    }

}
