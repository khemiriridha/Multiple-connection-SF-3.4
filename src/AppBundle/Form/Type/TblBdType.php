<?php

// src/AppBundle/Form/Type/ProductType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\TblAdmin;
use Symfony\Component\DependencyInjection\ContainerInterface;
 
class TblBdType extends AbstractType
{
	protected $container;
	
	public function __construct(ContainerInterface $container){
    
	$this->container = $container;
	
	}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serveur', TextType::class, array(
				'data' => $this->container->getParameter('database_host'),
				'attr' => ['readonly' => true]
				))
			->add('login', TextType::class, array(
				'data' => $this->container->getParameter('database_user'),
				'attr' => ['readonly' => true]
				))
			->add('bdName', TextType::class)
			->add('password', PasswordType::class)
			 
			->add('serveurBdVoip', TextType::class, array(
				'data' => $this->container->getParameter('database_host'),
				'attr' => ['readonly' => true]
				))
			->add('loginVoip', TextType::class, array(
				'data' => $this->container->getParameter('database_user'),
				'attr' => ['readonly' => true]
				))
			->add('bdNameVoip', TextType::class)
			->add('passowrdVoip', PasswordType::class)
			->add('tblAdmin', EntityType::class, array(
				'class' => 'AppBundle:TblAdmin',
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('u')
					->where('u.status = :status')
					->setParameter('status', 'USER');
				},
				'choice_label' => 'nomComplet',
			))
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\TblBd'
        ]);
    }
}