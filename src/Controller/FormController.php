<?php


namespace App\Controller;
use App\Entity\Urun;
use App\Form\EkleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FormController extends AbstractController
{
    /**
     * @Route("urunler/yeni-urun-ekle",name="yeni_urun_ekle")
     * @param Request $request
     * @return Response
     */
    public function urunEkle(Request $request)
    {
        $urun=new Urun();
        $urun->setIsim('');
        $urun->setOlusturulmaTarihi(new \DateTime());
        $urun->setGuncellenmeTarihi(new \DateTime());

        $form=$this->createForm(EkleType::class,$urun);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();

            $urun=$form->getData();
            $em->persist($urun);
            $em->flush();

            $this->addFlash('success','Ürün başarıyla eklendi');
        }
        return $this->render('form/index.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

}