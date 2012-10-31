<?php

namespace Eher\QueroSerVoluntario\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eher\QueroSerVoluntario\Bundle\Entity\Entidade
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Entidade
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=50)
     */
    private $nome;

    /**
     * @var string $endereco
     *
     * @ORM\Column(name="endereco", type="string", length=50)
     */
    private $endereco;

    /**
     * @var string $numero
     *
     * @ORM\Column(name="numero", type="string", length=10)
     */
    private $numero;

    /**
     * @var string $complemento
     *
     * @ORM\Column(name="complemento", type="string", length=10)
     */
    private $complemento;

    /**
     * @var string $cep
     *
     * @ORM\Column(name="cep", type="string", length=8)
     */
    private $cep;

    /**
     * @var string $bairro
     *
     * @ORM\Column(name="bairro", type="string", length=50)
     */
    private $bairro;

    /**
     * @var string $cidade
     *
     * @ORM\Column(name="cidade", type="string", length=50)
     */
    private $cidade;

    /**
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=2)
     */
    private $estado;

    /**
     * @var string $telefone
     *
     * @ORM\Column(name="telefone", type="string", length=50)
     */
    private $telefone;


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
     * Set nome
     *
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
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
     * Set endereco
     *
     * @param string $endereco
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set numero
     *
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set complemento
     *
     * @param string $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * Get complemento
     *
     * @return string 
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set cep
     *
     * @param string $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * Get cep
     *
     * @return string 
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * Get bairro
     *
     * @return string 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Get cidade
     *
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
        return $this->telefone;
    }
}
