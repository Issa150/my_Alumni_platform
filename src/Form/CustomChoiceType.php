<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CustomChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $choices = $form->getConfig()->getOption('choices');
            $noneValue = $form->getConfig()->getOption('none_value');

            if ($noneValue !== null) {
                $choices = array_filter($choices, function ($value) use ($noneValue) {
                    return $value !== $noneValue;
                });
                $form->getParent()->add($form->getName(), ChoiceType::class, [
                    'choices' => $choices,
                    'expanded' => $form->getConfig()->getOption('expanded'),
                    'multiple' => $form->getConfig()->getOption('multiple'),
                    'required' => $form->getConfig()->getOption('required'),
                ]);
            }
        });
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'none_value' => null,
        ]);
    }
}
