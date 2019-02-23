<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('oldPassword',PasswordType::class, array('mapped'=>false))
            ->add(
                'plainPassword',RepeatedType::class, array('type'=>PasswordType::class,
                'invalid_message'=>'The two passwords must be the same',
                'options'=>array(
                    'attr'=>array('class'=>'password_field'),
                    'required'=>true
                )))
            ->add('submit',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary btn-block')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
