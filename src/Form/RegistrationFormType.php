<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder 

            ->add('email',EmailType::class,[
                'label' => 'Votre email',
                'attr' => [
                    'placeholder' => 'Veuillez saisir une adresse mail'],
                'constraints' => [new Length(['max' => 60])],
            ])
            ->add('name',TextType::class,[
                'label'=> 'Votre Nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ],
                'constraints' => [new Length(['min' => 3 , 'max' => 50])],
            ])
          
            ->add('username',TextType::class,[
                'label'=> 'Votre Prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre Prenom'
                ],
                'constraints' => [new Length(['min' => 3 , 'max' => 50])],
            ])
           
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label'=>"Votre Mot de passe",
                'attr' => ['autocomplete' => 'new-password',
                            'placeholder' => 'Veuillez saisir un mot de passe'],
                
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                        
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir  6  caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}