<?php

namespace ChapterThree\C3Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FileuploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filename', FileType::class, [
                'label' => 'アップロードファイル',
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([

                        'maxSize' => '50M',    // .htaccessにUPLOAD制限サイズ記載
//                        'mimeTypes' => [
//                            'video/quicktime',
//                            'video/mpeg',
//                            'video/mp4',
//                        ],
//                        'mimeTypesMessage' => 'Please upload a valid MOVIE document',
                    ])
                ],
                'data_class'=>null
            ])
            ->add('savePath', TextType::class, [
                'label' => '保存先',
                'attr' => [
                    'title'=> '下記のファイル保存先のチェックボックスを選択してください。最後に選択されたフォルダに保存します。',
                    'placeholder' => '下記のファイル保存先のチェックボックスを選択してください。最後に選択されたフォルダに保存します。'],
                'mapped' => false,
                'required' => false
            ])
        ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
