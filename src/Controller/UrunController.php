<?php

namespace App\Controller;
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
        return $this->render('urun/index.html.twig',[
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

        return new Response($this->renderView('urun/urungoruntule.html.twig',[
            'urun'=>$urun,
        ]));

    }

    //Ürün Ekleme

    /**
     * @Route("urunler/ekleme",name="urun_ekleme")
     * @return Response
     * @throws \Exception
     */
    public function ekleme()
    {
        $em=$this->getDoctrine()->getManager();
        $urun=new Urun();
        $urun
            ->setIsim('Mause Pad')
            ->setFiyat(40)
            ->setDurum('stokta var')
            ->setOlusturulmaTarihi(new \DateTime())
            ->setGuncellenmeTarihi(new \DateTime());
        $em->persist($urun);
        $em->flush();

        return new Response(sprintf('urun başarıyla oluşturuldu %s isim %s',$urun->getId(),$urun->getIsim()));
    }

    //id ile ürün getirme

    /**
     * @Route("/urunler/bul/{id}",name="urun_bul")
     * @return Response
     */
    public function bul($id,Urun $urun)
    {
        return new Response(sprintf('ürün getirildi id: %s isim: %s',$urun->getId(),$urun->getIsim()));
    }

    //Ürün Güncelleme

    /**
     * @Route("/urunler/guncelleme/{id}",name="urun_update")
     * @return Response
     */
    public function guncelleme($id, Request $request)
    {
        $isim=$request->get('isim');
        $em=$this->getDoctrine()->getManager();
        $urunrepo=$em->getRepository(Urun::class);

        $urun=$urunrepo->find($id);
        $urun
            ->setIsim($isim)
            ->setFiyat(199);

        $em->persist($urun);
        $em->flush();

        return new Response(sprintf('Ürün başarı ile güncellendi id: %s isim %s', $urun->getId(), $urun->getIsim()));
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