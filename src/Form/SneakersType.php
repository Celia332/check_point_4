<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Sneakers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SneakersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text')
            ->add('createdAt')
            ->add('title')
            ->add('url')
            ->add('brand', EntityType::class,[
                'class' => Brand::class,
                'choice_label' => 'marqueUrl',
                'multiple'     => false,
                'expanded'     => true,
                'by_reference' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sneakers::class,
        ]);
    }
}
