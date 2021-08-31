<?php

namespace App\Form;

use App\Entity\TodoSiMaiBun;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;


class UpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('importance',  RangeType::class, [
              'attr' => [
                'min' => 1,
                'max' => 3
              ]])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TodoSiMaiBun::class,
            'csr_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'task_item'
        ]);
    }
}
