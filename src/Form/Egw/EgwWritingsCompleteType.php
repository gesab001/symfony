<?php

namespace App\Form\Egw;

use App\Entity\Egw\EgwWritingsComplete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EgwWritingsCompleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bookcode')
            ->add('page')
            ->add('paragraph')
            ->add('word')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EgwWritingsComplete::class,
        ]);
    }
}
