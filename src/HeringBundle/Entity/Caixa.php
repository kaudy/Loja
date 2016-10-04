<?php

namespace HeringBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="caixa")
 */
class Caixa 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="CaixaItem", mappedBy="caixa")
     */
    private $itens;
    
    /**
     * @ORM\Column(type="decimal", scale=2)
     */     
    private $totalPago;
    
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $status;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $data;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $usuario;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itens = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set totalPago
     *
     * @param string $totalPago
     *
     * @return Caixa
     */
    public function setTotalPago($totalPago)
    {
        $this->totalPago = $totalPago;

        return $this;
    }

    /**
     * Get totalPago
     *
     * @return string
     */
    public function getTotalPago()
    {
        return $this->totalPago;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Caixa
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Caixa
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set usuario
     *
     * @param integer $usuario
     *
     * @return Caixa
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return integer
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add iten
     *
     * @param \HeringBundle\Entity\CaixaItem $iten
     *
     * @return Caixa
     */
    public function addIten(\HeringBundle\Entity\CaixaItem $iten)
    {
        $this->itens[] = $iten;

        return $this;
    }

    /**
     * Remove iten
     *
     * @param \HeringBundle\Entity\CaixaItem $iten
     */
    public function removeIten(\HeringBundle\Entity\CaixaItem $iten)
    {
        $this->itens->removeElement($iten);
    }

    /**
     * Get itens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItens()
    {
        return $this->itens;
    }
}
