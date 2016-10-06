<?php

namespace HeringBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="caixa_item")
 */
class CaixaItem implements \JsonSerializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $numeroItem;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $codigoItem;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $quantidade;
    
    /**
     * @ORM\Column(type="decimal", scale=2)
     */  
    private $valor;
    
    /**
     * @ORM\ManyToOne(targetEntity="\HeringBundle\Entity\Caixa", inversedBy="itens")
     * @ORM\JoinColumn(name="caixa_id", referencedColumnName="id")
     */
    private $caixa;

    
    /**
     * 
     * @return array
     */
    public function jsonSerialize()
    {
        return array(
            "id"=> $this->getId(),
            "codigo" => $this->getCodigoItem(),
            "valor" => $this->getValor(),
            "quantidade" => $this->getQuantidade()
        );
    } 
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numeroItem
     *
     * @param integer $numeroItem
     *
     * @return CaixaItem
     */
    public function setNumeroItem($numeroItem)
    {
        $this->numeroItem = $numeroItem;

        return $this;
    }

    /**
     * Get numeroItem
     *
     * @return integer
     */
    public function getNumeroItem()
    {
        return $this->numeroItem;
    }

    /**
     * Set codigoItem
     *
     * @param integer $codigoItem
     *
     * @return CaixaItem
     */
    public function setCodigoItem($codigoItem)
    {
        $this->codigoItem = $codigoItem;

        return $this;
    }

    /**
     * Get codigoItem
     *
     * @return integer
     */
    public function getCodigoItem()
    {
        return $this->codigoItem;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return CaixaItem
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return integer
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return CaixaItem
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set caixa
     *
     * @param \HeringBundle\Entity\Caixa $caixa
     *
     * @return CaixaItem
     */
    public function setCaixa(\HeringBundle\Entity\Caixa $caixa = null)
    {
        $this->caixa = $caixa;

        return $this;
    }

    /**
     * Get caixa
     *
     * @return \HeringBundle\Entity\Caixa
     */
    public function getCaixa()
    {
        return $this->caixa;
    }
    

}
