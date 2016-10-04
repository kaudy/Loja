<?php

namespace HeringBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use HeringBundle\Entity\Caixa;
use HeringBundle\Entity\CaixaItem;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('HeringBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/pdv", name="frente_caixa")
     */
    public function pdvAction()
    {
        //Cria o objeto caixa e seta como aberto
        $caixa = new Caixa();
        $caixa->setData(new \DateTime());
        $caixa->setStatus("ABERTO");
        $caixa->setUsuario('Teste');
        $caixa->setTotalPago(0);
        
        $item= new CaixaItem();
        $item->setNumeroItem('123456');
        $item->setCodigoItem(1);
        $item->setQuantidade(3);
        $item->setValor(11.77);
        
        //Persiste o objeto $caixa
        $em = $this->getDoctrine()->getManager();
        $em->persist($caixa);        
        $em->flush();
        $em->refresh($caixa); //Atualiza os valores do item pelos do banco de dados
        
        //Persiste o objeto $item;
        $item->setCaixa($caixa);        
        $em->persist($item);
        $em->flush();
        
        return $this->render('HeringBundle:Caixa:caixa.html.twig');
    }
}
