<?php

namespace HeringBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="produto")
 */
class Produto
{
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id    
     */
    private $codigo;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tamanho;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $valor;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $modelo;
    /**
     * @ORM\Column(type="integer")    
     */
    private $quantidade;

    
    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Produto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Produto
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set tamanho
     *
     * @param string $tamanho
     *
     * @return Produto
     */
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    /**
     * Get tamanho
     *
     * @return string
     */
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Produto
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
     * Set modelo
     *
     * @param string $modelo
     *
     * @return Produto
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set quantidade
     *
     * @param integer $quantidade
     *
     * @return Produto
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
}
