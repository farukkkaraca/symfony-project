<?php
namespace App\Controller\BizeUlasin;
use App\Form\BizeUlasinType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BizeUlasinController extends  AbstractController
{
    /**
     * @Route("bize-ulasin",name="bize_ulasin")
     */
    public function bizeUlasin(Request $request)
    {
        $form=$this->createForm(BizeUlasinType::class);
        $form->handleRequest($request);
        return $this->render('bize-ulasin.html.twig',[
            'form'=>$form->createView(),
        ]);


    }

}
