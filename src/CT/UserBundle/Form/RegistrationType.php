<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 27-07-17
 * Time: 14:11
 */

namespace CT\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('firstname');
        $builder->add('borndate');
        $builder->add('country');
        $builder->add('website');
        $builder->add('description');
        $builder->remove('plainPassword');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'user_user_registration';
    }
}
