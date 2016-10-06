<?php

namespace HeringBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProdutoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('nome')
            ->add('tamanho', ChoiceType::class, array(
                'choices'  => array(
                    'Selecione' => '',
                    'P' => 'P',
                    'M' => "M",
                    'G' => "G",
                ),
            ))
            ->add('valor')
            ->add('modelo')
            ->add('quantidade')
            ->add('marca', EntityType::class, array(
                'class' => 'HeringBundle:Marca',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.nome', 'ASC');
                },
            ))
            ->add('imagem', FileType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HeringBundle\Entity\Produto'
        ));
    }
}
