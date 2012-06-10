<?php

namespace Eher\QueroSerVoluntario\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eher\QueroSerVoluntario\Bundle\Entity\Voluntario
 */
class Voluntario
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $nome
     */
    private $nome;

    /**
     * @var datetime $nascimento
     */
    private $nascimento;

    /**
     * @var string $profissao
     */
    private $profissao;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $telefone
     */
    private $telefone;

    /**
     * @var string $celular
     */
    private $celular;

    /**
     * @var string $empresa
     */
    private $empresa;

    /**
     * @var boolean $ja_foi_voluntario
     */
    private $ja_foi_voluntario;

    /**
     * @var string $entidade
     */
    private $entidade;

    /**
     * @var object $area_de_trabalho
     */
    private $area_de_trabalho;

    /**
     * @var object $area_de_atuacao
     */
    private $area_de_atuacao;

    /**
     * @var string $quer_fazer
     */
    private $quer_fazer;


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
     * Set nascimento
     *
     * @param datetime $nascimento
     */
    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    /**
     * Get nascimento
     *
     * @return datetime 
     */
    public function getNascimento()
    {
        return $this->nascimento;
    }

    /**
     * Set profissao
     *
     * @param string $profissao
     */
    public function setProfissao($profissao)
    {
        $this->profissao = $profissao;
    }

    /**
     * Get profissao
     *
     * @return string 
     */
    public function getProfissao()
    {
        return $this->profissao;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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

    /**
     * Set celular
     *
     * @param string $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set ja_foi_voluntario
     *
     * @param boolean $jaFoiVoluntario
     */
    public function setJaFoiVoluntario($jaFoiVoluntario)
    {
        $this->ja_foi_voluntario = $jaFoiVoluntario;
    }

    /**
     * Get ja_foi_voluntario
     *
     * @return boolean 
     */
    public function getJaFoiVoluntario()
    {
        return $this->ja_foi_voluntario;
    }

    /**
     * Set entidade
     *
     * @param string $entidade
     */
    public function setEntidade($entidade)
    {
        $this->entidade = $entidade;
    }

    /**
     * Get entidade
     *
     * @return string 
     */
    public function getEntidade()
    {
        return $this->entidade;
    }

    /**
     * Set area_de_trabalho
     *
     * @param object $areaDeTrabalho
     */
    public function setAreaDeTrabalho($areaDeTrabalho)
    {
        $this->area_de_trabalho = $areaDeTrabalho;
    }

    /**
     * Get area_de_trabalho
     *
     * @return object 
     */
    public function getAreaDeTrabalho()
    {
        return $this->area_de_trabalho;
    }

    /**
     * Set area_de_atuacao
     *
     * @param object $areaDeAtuacao
     */
    public function setAreaDeAtuacao($areaDeAtuacao)
    {
        $this->area_de_atuacao = $areaDeAtuacao;
    }

    /**
     * Get area_de_atuacao
     *
     * @return object 
     */
    public function getAreaDeAtuacao()
    {
        return $this->area_de_atuacao;
    }

    /**
     * Set quer_fazer
     *
     * @param string $querFazer
     */
    public function setQuerFazer($querFazer)
    {
        $this->quer_fazer = $querFazer;
    }

    /**
     * Get quer_fazer
     *
     * @return string 
     */
    public function getQuerFazer()
    {
        return $this->quer_fazer;
    }
}