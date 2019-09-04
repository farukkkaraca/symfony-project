<?php


namespace App\Controller\Kategoriler;
use App\Entity\Urun;
use App\Entity\Kategori;
use App\Form\KategoriyeUrunEkleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class KategoriFormController extends AbstractController
{
    /**
     * @Route("urunler/kategoriye-urun-ekle/{id}",name="kategoriye_urun_ekle")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function kategoriyeUrunEkle(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $kategori=$em->getRepository(Kategori::class)->find($id);

        $urun=new Urun();
        $urun->setIsim('');
        $urun->setOlusturulmaTarihi(new \DateTime());
        $urun->setGuncellenmeTarihi(new \DateTime());

        $form=$this->createForm(KategoriyeUrunEkleType::class,$urun);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $urun->setKategori($kategori);

            $urun=$form->getData();
            $em->persist($urun);
            $em->persist($kategori);
            $em->flush();

            $this->addFlash('success','Ürün başarıyla eklendi');
        }
        return $this->render('kategori/kategoriye-urun-ekle.html.twig',[
            'form'=>$form->createView(),
            'kategori'=>$kategori,
        ]);
    }

}