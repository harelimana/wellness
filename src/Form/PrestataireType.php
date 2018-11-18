<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Localite;
use App\Entity\Prestataire;
use App\Entity\User;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressNumber',textType::class)
            ->add('addressRue',textType::class)
            ->add('email',emailType::class)
            ->add('banni',textType::class)
            ->add('inscription',textType::class)
            ->add('inscriptionDate',dateType::class)
            ->add('password',passwordType::class)
            ->add('successAttempt',integerType::class)
            ->add('name',textType::class)
            ->add('telnumber',textType::class)
            ->add('tvanumber',textType::class)
            ->add('website',textType::class)
            ->add('codepostal',textType::class)
            ->add('localite',textType::class)
            ->add('commune',textType::class)
            ->add('image',textType::class)
            ->add('logo',textType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
