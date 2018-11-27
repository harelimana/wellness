<?php

namespace App\Form;

use App\Entity\Internaute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternauteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressNumber')
            ->add('addressRue')
            ->add('email')
            ->add('banni')
            ->add('inscription')
            ->add('inscriptionDate')
            ->add('password')
            ->add('successAttempt')
            ->add('firstname')
            ->add('lastname')
            ->add('codepostal')
            ->add('localite')
            ->add('commune')
            ->add('bloc')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Internaute::class,
        ]);
    }
}
