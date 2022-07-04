<?php

declare(strict_types=1);

namespace App\Banking\Bridge\Controller\Web\Form;

use App\Banking\Application\Dto\NewBankAccountDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class NewBankAccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bic', TextType::class)
            ->add('balance', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add Bank Account'])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewBankAccountDto::class,
        ]);
    }
}