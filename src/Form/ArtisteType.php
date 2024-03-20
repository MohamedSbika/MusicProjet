<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Artiste;
use App\Entity\Titre;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ArtisteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomartiste', TextType::class, [
                'label' => 'Nom de l\'artiste',
            ])
            ->add('datenaissance', BirthdayType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('datedeces', BirthdayType::class, [
                'label' => 'Date de décès',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false,
            ])
            ->add('logoFile', VichImageType::class, [
                'label' => "Image de l'artiste",
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
            ->add('valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => \App\Entity\Artiste::class,
        ]);
    }
}
