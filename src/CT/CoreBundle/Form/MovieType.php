<?php

namespace CT\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MovieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voteAverageCT', RatingType::class, ['stars'=> 10])
            ->add('originality',      RatingType::class, ['stars' => 10])
            ->add('specialEffects',     RatingType::class, ['stars' => 10])
            ->add('emotion',   RatingType::class, ['stars' => 10])
            ->add('twist',    RatingType::class, ['stars' => 10])
            ->add('complexity', RatingType::class, ['stars' => 10])
            ->add('violence', RatingType::class, ['stars' => 10])
            ->add('save',      SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CT\CoreBundle\Entity\Movie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ct_corebundle_movie';
    }


}
