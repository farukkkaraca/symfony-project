<?php

namespace App\Controller\Urunler;
use App\Entity\Urun;
use App\Form\UrunDuzenleType;
use App\Form\UrunEkleType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class UrunController extends AbstractController
{
    /**
     * @Route("/urunler",name="urunler_listesi")
     * @return Response
     */

    public function listeleme(Request $request ,PaginatorInterface $paginator)
    {

        $urunrepository=$this->getDoctrine()->getRepository(Urun::class);

        $ad=$request->get('isim',"");
        $min_fyt= $request->get('min-fiyat',0);
        $max_fyt=$request->get('max-fiyat',1000000);

        $queryBuilder=$urunrepository->UrunSirala($min_fiyat=$min_fyt,$max_fiyat=$max_fyt,$isim=$ad);
        $listUrunler = $paginator->paginate($queryBuilder,$request->query->getInt('page', 1),
            20
        );
        return $this->render('urun/urun-sayfası.html.twig',[
            'urunler'=>$listUrunler,
        ]);

    }

    /**
     * @Route("urunler/{id}",name="urun_goruntule",requirements={"id":"\d+"})
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

    /**
     * @Route("urun-ekle",name="yeni_urun_ekle")
     */
    public function urunEkle(Request $request)
    {
        $urun=new Urun();

        $form=$this->createForm(UrunEkleType::class,$urun);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            #$urun=$form->getData();
            $urun->setOlusturulmaTarihi(new \DateTime());
            $urun->setGuncellenmeTarihi(new \DateTime());
            $em->persist($urun);
            $em->flush();
            $this->addFlash('success','Ürün başarıyla eklendi');

        }

        return $this->render('urun/urun-ekle-form.html.twig',[
            'form'=>$form->createView()
        ]);

    }

    //ürün düzenleme formu

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

        return $this->render('urun/urun-duzenle.html.twig',[
            'form'=>$form->createView(),
        ]);


    }



}