<?php

namespace ZEN\LocaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CountryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('officialName')
            ->add('iSO')
            ->add('currency')
            ->add('languages')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZEN\LocaleBundle\Entity\Country',
            'translation_domain' => 'form_country'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zen_localebundle_country';
    }
}
