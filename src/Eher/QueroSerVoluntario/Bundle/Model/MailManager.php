<?php

namespace Eher\QueroSerVoluntario\Bundle\Model;

use Eher\QueroSerVoluntario\Bundle\Entity\Voluntario;

class MailManager
{
    private $mailer;
    private $contactEmail;
    private $message;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
        return $this;
    }

    public function generateMessageWithVoluntario(Voluntario $entity)
    {
        $subject = "Cadastro de Voluntário: {$entity->getNome()} ({$entity->getCidade()})";
        $this->message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setTo($this->contactEmail)
            ->setFrom($this->contactEmail)
            ->setReplyTo(array($entity->getEmail() => $entity->getNome()));
        return $this;
    }

    public function send()
    {
        if (empty($this->contactEmail)) {
            throw new \Exception("Preciso do e-mail de contato");
        }

        if (empty($this->message)) {
            throw new \Exception("Preciso saber o que enviar");
        }

        return $this->mailer->send($this->message);
    }

    public function getMessage()
    {
        return $this->message;
    }
}
