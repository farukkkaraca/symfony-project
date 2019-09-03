<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnasayfaController extends AbstractController
{
    /**
     * @Route("anasayfa",name="anasayfa")
     * @return Response
     */
    public function anasayfa()
    {
        return $this->render('anasayfa/anasayfa.html.twig');

    }




}