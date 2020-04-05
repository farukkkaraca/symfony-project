<?php


namespace App\Form;
use App\Entity\Kategori;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Test\Fixture\Entity\Shop\Tag;

class BizeUlasinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Ad',TextType::class)
            ->add('Soyad',TextType::class)
            ->add('Mail',TextType::class)
            ->add('Mesaj',TextareaType::class)
            ->add('Test Ediliyor Buton aktif degil',ButtonType::class);
    }

}