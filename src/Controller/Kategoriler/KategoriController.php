<?php

namespace App\Controller\Kategoriler;
use App\Entity\Kategori;
use App\Entity\Urun;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KategoriController extends AbstractController
{
    /**
     * @Route("kategoriler/{id}",name="kategoriler_id")
     * @return Response
     */
    public function urun(Kategori $kategori)
    {

        $urunler=$kategori->getUruns();

        return $this->render('kategori/kategorideki-urunler.html.twig',[
            'urunler'=>$urunler,
            'kategori'=>$kategori
        ]);
    }

    /**
     * @Route("kategoriler",name="kategoriler")
     * @return Response
     */
    public function kategoriler()
    {
        $kategori_repo=$this->getDoctrine()->getRepository(Kategori::class);
        $kategori=$kategori_repo->findAll();
        return $this->render('kategori/kategoriler-sayfasi.html.twig',[
         'kategori'=>$kategori,
            ]);
    }

    /**
     * @Route("kategori-ekle",name="kategori_ekle")
     * @return Response
     * @throws \Exception
     */
    public function kategoriEkle()
    {
        $em=$this->getDoctrine()->getManager();

        $kategori=new Kategori();
        $kategori->setIsim('Ev Aletleri');

        $em->persist($kategori);


        $em->flush();

        return new Response(sprintf('kategori oluşturuldu Kategori id: %s',$kategori->getid()));

    }

    /**
     * @Route("kategori-sil/{id}",name="kategori_sil")
     * @param $id
     * @return Response
     */
    public function kategoriSil($id)
    {
        $em=$this->getDoctrine()->getManager();
        $kategori=$em->getRepository(Kategori::class)->find($id);
        $em->remove($kategori);

        $em->flush();

        return $this->redirectToRoute('kategoriler');

    }






}