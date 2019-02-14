<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\VichUploaderBundle as Vich;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageSize')
            ->add('updatedAt')
            ->add('imageFile', Vich::class, [
                'label'         => false,
                'required'      => false,
                'allow_delete'  => false,
                'download_link' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
