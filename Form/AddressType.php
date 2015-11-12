<?php

namespace ZEN\LocaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType {

    private $countries;

    public function __construct($em, $locale) {
        $countryRepo = $em->getRepository('ZENLocaleBundle:Country');
        $this->countries = $countryRepo->findAll($locale);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('country', 'entity', ['label' => 'address.country', 'class' => 'ZENLocaleBundle:Country', 'choices' => $this->countries, 'attr' => ['field_class' => 'select-search']])
                ->add('zip', null, ['label' => 'address.zip'])
                ->add('city', null, ['label' => 'address.city'])
                ->add('street', null, ['label' => 'address.street'])
                ->add('latitude', 'hidden')
                ->add('longitude', 'hidden')

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ZEN\LocaleBundle\Entity\Address',
            'translation_domain' => 'form_address'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'zen_localebundle_address';
    }

}
