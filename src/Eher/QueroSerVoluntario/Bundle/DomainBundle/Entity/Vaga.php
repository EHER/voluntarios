<?php
namespace Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\ManyToOne(targetEntity="Entidade")
     */
    private $entidade;

    /**
     * @var string
     *
     * @ORM\Column(name="como_aplicar", type="text")
     */
    private $comoAplicar;

    /**
     * @var string
     *
     * @ORM\Column(name="online", type="boolean")
     */
    private $online;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

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
     * Set descricao
     *
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
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
     * @param Entidade $entidade
     */
    public function setEntidade(Entidade $entidade)
    {
        $this->entidade = $entidade;
    }

    /**
     * Get entidade
     *
     * @return Entidade
     */
    public function getEntidade()
    {
        return $this->entidade;
    }

    /**
     * Set comoAplicar
     *
     * @param string $comoAplicar
     */
    public function setComoAplicar($comoAplicar)
    {
        $this->comoAplicar = $comoAplicar;
    }

    /**
     * Get comoAplicar
     *
     * @return string
     */
    public function getComoAplicar()
    {
        return $this->comoAplicar;
    }

    /**
     * Set online
     *
     * @param boolean $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * Get online
     *
     * @return boolean
     */
    public function isOnline()
    {
        return $this->online;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
