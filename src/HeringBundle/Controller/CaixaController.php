<?php

namespace HeringBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HeringBundle\Entity\Caixa;
use HeringBundle\Entity\CaixaItem;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Caixa controller.
 *
 * @Route("/caixa")
 */
class CaixaController extends Controller
{
    /**
     * Lists all Caixa entities.
     *
     * @Route("/", name="caixa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $caixas = $em->getRepository('HeringBundle:Caixa')->findAll();

        return $this->render('HeringBundle:Caixa:index.html.twig', array(
            'caixas' => $caixas,
        ));
    }

    /**
     * Finds and displays a Caixa entity.
     *
     * @Route("/{id}", name="caixa_show")
     * @Method("GET")
     */
    public function showAction(Caixa $caixa)
    {

        return $this->render('HeringBundle:Caixa:show.html.twig', array(
            'caixa' => $caixa,
        ));
    }
    
    /**
     * Responsavel pela tela de ponto de venda
     *
     * @Route("/pdv", name="caixa_pdv")
     * @Method("GET")
     */
    public function pdvAction()
    {
        return $this->render('HeringBundle:Caixa:caixa.html.twig');
    }
    
    
    
    /**
     *  Extorna o item informado
     * @Route("/estorno/{numero}", name="caixa_extorno")
     * @param Request $request
     */
    public function extornoAction(Request $request,$numero)
    {
        $em = $this->getDoctrine()->getManager();
        $caixaId = $request->getSession()->get('caixa_id');
        
        /** @var Caixa */
        $caixa = $em->getRepository('HeringBundle:Caixa')->find($caixaId);
        $itens = $caixa->getItens();         
        $itemSel = $itens->get($numero -1);
       
        //Cria novo item para estornar
        $novoItem = new CaixaItem();
        $novoItem->setCaixa($caixa); //seta a caixa ativa
        $novoItem->setCodigoItem('111111'); //seta o codigo de estorno
        $novoItem->setQuantidade(1);
        $novoItem->setNumeroItem(1);
        
        //pega valor do item a ser estornado e transforma para negativo
        $novoItem->setValor($itemSel->getValor() * -1); 
        $novoItem->setDescricao("Estorno do Item ". $numero);
        
        $em->persist($novoItem);
        $em->flush();
        
        $retorno = array(
            "status" => "ok"
        );
        return $this->json($retorno);
    }
    
    /**
     *  Finaliza, efetua o pagamento e baixa o estoque
     * @Route("/finalizar", name="caixa_finalizar")
     * @param Request $request
     */
    public function finalizarAction(Request $request)
    {
        $total = $request->get('total-pago');
        
        $em = $this->getDoctrine()->getManager();
        $caixaId = $request->getSession()->get('caixa_id');
        
        $caixa = $em->getRepository('HeringBundle:Caixa')->find($caixaId);
        
        $caixa->setTotalPago($total);
        
        $em->persist($novoItem);
        $em->flush();
        
        $this->redirectToRoute('caixa_pdv');
    }
    
    
    
    
    
    
}
