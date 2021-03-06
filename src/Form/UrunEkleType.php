<?php


namespace App\Form;
use App\Entity\Kategori;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrunEkleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isim', TextType::class)
            ->add('fiyat', TextType::class)
            ->add('durum', TextType::class)
            ->add('kategori', EntityType::class, ['class' => Kategori::class, 'choice_label' => 'isim'])
            ->add('ekle', SubmitType::class, [
        'label' => 'Ekle',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }


}