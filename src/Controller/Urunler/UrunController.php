<?php

namespace App\Controller\Urunler;
use App\Entity\Urun;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrunController extends AbstractController
{

    //Ürün Listeleme
    /**
     * @Route("/urunler",name="urunler_listesi")
     * @return Response
     */
    public function listeleme()
    {

        $urunrepository=$this->getDoctrine()->getRepository(Urun::class);
        $urunler=$urunrepository->findAll();
        return $this->render('urun/urun-sayfası.html.twig',[
            'urunler'=>$urunler,
        ]);

    }

    /**
     * @Route("urunler/{id}",name="urun_goruntule")
     * @param Urun $urun
     * @return Response
     */
    public function goruntule(Urun $urun)
    {

        return new Response($this->renderView('urun/urun-bilgileri.html.twig',[
            'urun'=>$urun,
        ]));

    }

    //Ürün silme

    /**
     * @Route("urunler/silme/{id}",name="urun_silme")
     * @return Response
     */
    public function silme($id)
    {
        $em=$this->getDoctrine()->getManager();
        $urun=$em->getRepository(Urun::class)->find($id);

        $em->remove($urun);
        $em->flush();

        $this->addFlash('success','Ürün başarıyla silindi');
        return $this->redirectToRoute('urunler_listesi');
    }





}