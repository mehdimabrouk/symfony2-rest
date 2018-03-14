<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @author Mehdi Mabrouk <m.mabrouk@esystema.fr>
 */
class ProgrammerType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname','text')
            ->add('avatarNumber','choice',[
                'choices'=> [
                    1 => 'Girl',
                    2 => 'Boy',
                    3 => 'Cat',
                    4 => 'Catdd',
                    5 => 'Catddsss',
                    6 => 'Catxxx'
                ]
            ])
            ->add('tagLine', 'textarea');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Programmer',
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'programmer';
    }
}