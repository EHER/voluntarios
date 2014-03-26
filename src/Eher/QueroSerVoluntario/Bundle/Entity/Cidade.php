<?php

namespace Eher\QueroSerVoluntario\Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eher\QueroSerVoluntario\Bundle\Entity\Cidade
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cidade
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
     * @ORM\Column(name="nome", type="string", length=35)
     */
    private $nome;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=35)
     */
    private $slug;

    /**
     * @var object $estado
     * @ORM\ManyToOne(targetEntity="Estado")
     */
    private $estado;

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
     * @return Cidade
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
     * Set slug
     *
     * @param string $slug
     * @return Cidade
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set estado
     *
     * @param object $estado
     * @return Cidade
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }

    /**
     * Get estado
     *
     * @return object 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function __toString()
    {
        return "{$this->nome} - {$this->estado->getNome()}";
    }
}
