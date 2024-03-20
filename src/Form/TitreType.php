<?php

namespace App\Form;

use App\Entity\Titre;
use App\Entity\Artiste; // Assurez-vous d'importer la classe Artiste
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Importez le type EntityType
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\UrlType;


class TitreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomtitre')
            ->add('date', BirthdayType::class, [
                'widget' => 'choice',
                'format' => 'dd-MM-yyyy',
            ])
            ->add('logoFile', VichImageType::class, [
                'label' => 'image du titre',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ])
            ->add('lien', UrlType::class, [
                'label' => 'Lien du titre',
                'required' => false, // Mettez à true si le champ est obligatoire
            ])
            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => 'nomartiste',
                'multiple' => true, // Indiquez que c'est une relation many-to-many
                'expanded' => true, // Si vous voulez afficher les artistes sous forme de cases à cocher
            ])
            ->add('valider', SubmitType::class)
            ->getForm()
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Titre::class,
        ]);
    }
}
