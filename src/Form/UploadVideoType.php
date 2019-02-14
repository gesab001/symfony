<?php

namespace App\Form;

use App\Entity\Videos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use Vich\UploaderBundle\VichUploaderBundle\Form\\Type;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class UploadVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('url')
            ->add('thumbnail')
            ->add('filename')
            ->add('Preacher')
            ->add('views')
            ->add('description')
            ->add('brochure', FileType::class, ['label' => 'Brochure (PDF file)'])
//            ->add('myDocument', VichFileType::class, [
//                'label'         => false,
//                'required'      => false,
//                'allow_delete'  => false,
//                'download_link' => true,
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Videos::class,
        ]);
    }
}
