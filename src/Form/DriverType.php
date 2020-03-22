<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('borderguard')
            ->add('firstname')
            ->add('lastname')
            ->add('street')
            ->add('place')
            ->add('country')
            ->add('email')
            ->add('mobile')
            /*
            ->add('birthday', DateType::class,
                [
                    'input' => 'string',
                    'input_format' => 'd.m.Y'
                ])
            */
            ->add('passportid')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
            'csrf_protection'=>false
        ]);
    }
}
