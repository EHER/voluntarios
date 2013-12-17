<?php

namespace Eher\QueroSerVoluntario\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eher\QueroSerVoluntario\Bundle\Entity\Vaga
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Vaga
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @var Entidade
     *
     * @ORM\Column(name="entidade", type="string", length=255)
     */
    private $entidade;

    /**
     * @var string
     *
     * @ORM\Column(name="email_template", type="text")
     */
    private $emailTemplate;


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
     * @return Vaga
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
     * Set descricao
     *
     * @param string $descricao
     * @return Vaga
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set entidade
     *
     * @param \stdClass $entidade
     * @return Vaga
     */
    public function setEntidade($entidade)
    {
        $this->entidade = $entidade;

        return $this;
    }

    /**
     * Get entidade
     *
     * @return \stdClass 
     */
    public function getEntidade()
    {
        return $this->entidade;
    }

    /**
     * Set emailTemplate
     *
     * @param string $emailTemplate
     * @return Vaga
     */
    public function setEmailTemplate($emailTemplate)
    {
        $this->emailTemplate = $emailTemplate;

        return $this;
    }

    /**
     * Get emailTemplate
     *
     * @return string 
     */
    public function getEmailTemplate()
    {
        return $this->emailTemplate;
    }
}
