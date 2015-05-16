<?php
namespace Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Voluntario
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
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     * @var string $email
     *
     * @ORM\Column(name="telefone", type="string", length=50)
     */
    private $telefone;

    /**
     * @var Cidade $cidade
     *
     * @ORM\ManyToOne(targetEntity="Cidade")
     *
     */
    private $cidade;

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
     * Set cidade
     *
     * @param Cidade $cidade
     */
    public function setCidade(Cidade $cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * Get cidade
     *
     * @return Cidade
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set estado
     *
     * @param Estado $estado
     */
    public function setEstado(Estado $estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
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
