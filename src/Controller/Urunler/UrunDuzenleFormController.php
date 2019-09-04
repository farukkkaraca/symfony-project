<?php


namespace App\Controller\Urunler;
use App\Entity\Urun;
use App\Form\UrunDuzenleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UrunDuzenleFormController extends AbstractController
{
    /**
     * @Route("urunler/duzenle/{id}",name="urun_duzenle")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function urunDuzenle(Request $request,$id)
    {
        $urun=$this->getDoctrine()->getRepository(Urun::class)->find($id);

        $form=$this->createForm(UrunDuzenleType::class,$urun);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $urun->setGuncellenmeTarihi(new \DateTime());

            $urun = $form->getData();
            $em->persist($urun);
            $em->flush();
            $this->addFlash('success','Ürün Başarıyla Düzenlendi');
        }



        return $this->render('form/new.html.twig',[
            'form'=>$form->createView(),
        ]);

    }
}
