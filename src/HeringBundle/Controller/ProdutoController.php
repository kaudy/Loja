<?php

namespace HeringBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use HeringBundle\Entity\Produto;
use HeringBundle\Form\ProdutoType;
use HeringBundle\Entity\Caixa;
use HeringBundle\Entity\CaixaItem;

/**
 * Produto controller.
 *
 * @Route("/produto")
 */
class ProdutoController extends Controller
{
    /**
     * Lists all Produto entities.
     *
     * @Route("/", name="produto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('HeringBundle:Produto')->findAll();

        return $this->render('HeringBundle:Produto:index.html.twig', array(
            'produtos' => $produtos,
        ));
    }

    /**
     * Creates a new Produto entity.
     *
     * @Route("/new", name="produto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produto = new Produto();
        $form = $this->createForm('HeringBundle\Form\ProdutoType', $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            /** 
             * @var Symfony\Component\HttpFoundation\File\UploadedFile $imagem 
             */
            $imagem = $produto->getImagem();
            
            $nomeArquivo = uniqid().'.'.$imagem->guessExtension();
            
            $imagem->move($this->getParameter('imagem_produtos'),
                    $nomeArquivo);
            
            $produto->setImagem($nomeArquivo);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto_index');
        }

        return $this->render('HeringBundle:Produto:new.html.twig', array(
            'produto' => $produto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Produto entity.
     *
     * @Route("/{id}", name="produto_show")
     * @Method("GET")
     */
    public function showAction(Produto $produto)
    {
        
        $deleteForm = $this->createDeleteForm($produto);

        return $this->render('HeringBundle:Produto:show.html.twig', array(
            'produto' => $produto,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     * Exige o produto como um json
     *
     * @Route("/find", name="produto_find")
     * @Method("POST")
     */
    public function findAction(Request $request)
    {
        $prodCod = $request->get('produto');
        
        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository('HeringBundle:Produto')->find($prodCod);
        
        if ($produto != null)
        {
            $caixaId = $request->getSession()->get('caixa_id');
            
            $caixa = $em->getRepository('HeringBundle:Caixa')->find($caixaId);
            
            $item = new CaixaItem();
            $item->setNumeroItem('1');
            $item->setCodigoItem($produto->getCodigo());
            $item->setQuantidade(1);
            $item->setValor($produto->getValor());
            
            $item->setCaixa($caixa);      
            $em->persist($item);          
            $em->flush();
        }
                

        return new JsonResponse($produto);
    }

    /**
     * Displays a form to edit an existing Produto entity.
     *
     * @Route("/{id}/edit", name="produto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produto $produto)
    {
        $deleteForm = $this->createDeleteForm($produto);
        $editForm = $this->createForm('HeringBundle\Form\ProdutoType', $produto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto_index');
        }

        return $this->render('HeringBundle:Produto:edit.html.twig', array(
            'produto' => $produto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Produto entity.
     *
     * @Route("/{id}", name="produto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produto $produto)
    {
        $form = $this->createDeleteForm($produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produto);
            $em->flush();
        }

        return $this->redirectToRoute('produto_index');
    }

    /**
     * Creates a form to delete a Produto entity.
     *
     * @param Produto $produto The Produto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produto $produto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produto_delete', array('id' => $produto->getCodigo() )))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
