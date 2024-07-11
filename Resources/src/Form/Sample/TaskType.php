<?php

namespace App\Form\Sample\Sample;

use App\Entity\Sample\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('get')
            ->add('id', IntegerType::class, [
                'label' => false,
                'attr'  => [
                    'readonly'=>'true',
                    'class'=>'form-control'
                ]])
            ->add('title', TextType::class, [
                'label'     => 'タイトル',
                'required'  => true,
                'attr'      => [
                    'class' => 'task_field form-control'
                ]])
            ->add('task', TextareaType::class, [
                'label'     => '内容',
                'required'  => true,
                'attr'      => [
                    'class' => 'task_field form-control'
                ]])
            ->add('dueDate', DateType::class, [
                'label'     => '日付',
                'widget'    => 'single_text',
                'attr'      => [
                    'class'=>'form-control'
                ]])
            ->add('save', SubmitType::class, [
                'label' => 'タスク追加'
                ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class'=>Task::class,
            'empty_data'=> function(FormInterface $form) {
                $task = new Task();
                $task->setDueDate(new \DateTime('tomorrow'));
                return $task;
            }
        ]);
    }
}
