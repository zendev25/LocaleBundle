<?php

namespace ZEN\LocaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LanguageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('nativeName')
            ->add('iSO')
            ->add('active',null,['required'=>false])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZEN\LocaleBundle\Entity\Language',
            'translation_domain' => 'form_language'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zen_localebundle_language';
    }
}
