<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 09-08-17
 * Time: 13:07
 */

namespace CT\CoreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Component\Form\FormBuilderInterface;



class MovieSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('title', TextType::class)
            ->add('save',      SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ct_corebundle_moviesearch';
    }

}