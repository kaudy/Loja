<?php

namespace HeringBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use HeringBundle\Entity\Caixa;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        //return $this->render('HeringBundle:Default:index.html.twig');
        return $this->redirectToRoute('frente_caixa');
    }
    
    /**
     * @Route("/pdv", name="frente_caixa")
     */
    public function pdvAction(Request $request)
    {
        $usuario = $this->getUser();
        $caixa = new Caixa();
        $caixa->setData(new \DateTime());
        $caixa->setStatus("ABERTO");
        $caixa->setUsuario($usuario);
        $caixa->setTotalPago(0);
        

        $em = $this->getDoctrine()->getManager();               
        $em->persist($caixa);        
        $em->flush();
        
        $em->refresh($caixa);
        
        $request->getSession()->set('caixa_id', $caixa->getId());
        
        
        return $this->render('HeringBundle:Caixa:caixa.html.twig');
    }
    
    /**
     *  Lista todos os itens adicionados no carrinho
     * @Route("/list-itens", name="caixa_list")
     * @param Request $request
     */
    public function listItensAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $caixaId = $request->getSession()->get('caixa_id');        
        
        /** @var Caixa */
        $caixa = $em->getRepository('HeringBundle:Caixa')->find($caixaId);
        $itens = $caixa->getItens()->toArray();
        
        return $this->json($itens);
    }
    
    /**
     *  Cancela a compra
     * @Route("/cancelar", name="caixa_cancelar")
     * @Method("GET")
     * @param Request $request
     */
    public function cancelarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $caixaId = $request->getSession()->get('caixa_id');
        
         /** @var Caixa */
        $caixa = $em->getRepository('HeringBundle:Caixa')->find($caixaId);
        
        $caixa->setStatus('FECHADO');
        $em->persist($caixa);
        $em->flush();
        
        return $this->redirectToRoute('frente_caixa');
        
        
        
    }
}
