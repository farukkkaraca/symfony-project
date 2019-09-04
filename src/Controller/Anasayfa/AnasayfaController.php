<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Anasayfa1Controller extends AbstractController
{
    /**
     * @Route("anasayfa-template",name="anasayfa-template")
     * @return Response
     */
    public function anasayfa()
    {
        return $this->render('anasayfa-template/anasayfa.html.twig');

    }
}