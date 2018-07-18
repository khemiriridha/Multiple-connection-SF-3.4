<?php
namespace ErposBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use ErposBundle\Entity\TblService;
use ErposBundle\Entity\TblGroupe;
class TblUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
			->add('password', PasswordType::class)
			->add('numTel', TextType::class)
			//->add('service', TextType::class)
			->add('mobile', TextType::class)
			->add('nomComplet', TextType::class)
			->add('email', EmailType::class)
			->add('voipProvider', ChoiceType::class, array(
				'choices'  => array(
					'Aucun' => null,
					'KEYYO' => 'KEYYO',
					'OVH' => 'OVH',
				)))
			->add('photo', HiddenType::class , array(
					'required' => false,
			))
			->add('service_id', EntityType::class, array(
				'class' => 'ErposBundle:TblService',
				'choice_label' => 'nom_service',
			))
			->add('groupe_id', EntityType::class, array(
				'class' => 'ErposBundle:TblGroupe',
				'choice_label' => 'nom_groupe',
				'mapped' => false
			))
            ->add('save', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ErposBundle\Entity\TblUser'
        ]);
    }
}