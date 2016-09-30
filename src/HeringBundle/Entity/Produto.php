<?php
namespace HeringBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Type(
     *     type="alpha",
     *     message="Permitido somente nome com letras."
     * )
     */
    private $nome;
    /**
     * @ORM\Column(type="string", length=20)        
     */
    private $tamanho;
    /**
     * @ORM\Column(type="decimal", scale=2)
     * @Assert\Type(
     *     type="decimal",
     *     message="Permitido somente nome com numeros."
     * )
     * @Assert\GreaterThanOrEqual(
     *      value= 0,
     *      message="Valor informado é invalido.")
     */
    private $valor;
    /**
     * @ORM\Column(type="string", length=20)
     */
    private $modelo;
    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(
     *     type="number",
     *     message="Permitido somente numeros."
     * )
     * @Assert\GreaterThanOrEqual(
     *      value= 0,
     *      message="Valor informado é invalido.")
     */
    private $quantidade;

    /**
     * @ORM\ManyToOne(targetEntity="Marca")
     * @ORM\JoinColumn(name="marca_id", referencedColumnName="id")
     */    
    private $marca;
    
    
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

    /**
     * Set marca
     *
     * @param \HeringBundle\Entity\Marca $marca
     *
     * @return Produto
     */
    public function setMarca(\HeringBundle\Entity\Marca $marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \HeringBundle\Entity\Marca
     */
    public function getMarca()
    {
        return $this->marca;
    }
}
