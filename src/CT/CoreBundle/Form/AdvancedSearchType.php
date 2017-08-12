<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 09-08-17
 * Time: 13:07
 */

namespace CT\CoreBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Component\Form\FormBuilderInterface;



class AdvancedSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $builder
            ->add('originality',      RatingType::class, ['stars' => 10])
            ->add('specialEffects',     RatingType::class, ['stars' => 10])
            ->add('emotion',   RatingType::class, ['stars' => 10])
            ->add('twist',    RatingType::class, ['stars' => 10])
            ->add('complexity', RatingType::class, ['stars' => 10])
            ->add('violence', RatingType::class, ['stars' => 10])
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