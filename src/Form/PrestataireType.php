<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Commune;
use App\Entity\Image;
use App\Entity\Localite;
use App\Entity\Prestataire;
use App\Entity\Service;
use App\Entity\Stage;
use App\Entity\User;
use Faker\Test\Provider\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressNumber',TextType::class)
            ->add('addressRue',TextType::class)
            ->add('email',emailType::class)
            ->add('banni',TextType::class)
            ->add('inscription',TextType::class)
            ->add('inscriptionDate',dateType::class)
            ->add('password',passwordType::class)
            ->add('confirmPassword',passwordType::class)
            ->add('successAttempt',integerType::class)
            ->add('name',TextType::class)
            ->add('telnumber',TextType::class)
            ->add('tvanumber',TextType::class)
            ->add('website',TextType::class)
            ->add('slug',TextType::class)
            ->add('codepostal',EntityType::class,['class'=>CodePostal::class])
            ->add('localite',EntityType::class,['class'=>Localite::class])
            ->add('commune',EntityType::class,['class'=>Commune::class])
            ->add('stages',EntityType::class,['class'=>Prestataire::class])
            ->add('services',EntityType::class,['class'=>Prestataire::class])
            ->add('image',EntityType::class,['class'=>Image::class])
            ->add('logo',EntityType::class,['class'=>Image::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
