<?php

namespace spec\Eher\QueroSerVoluntario\Bundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Eher\QueroSerVoluntario\Bundle\Entity\Voluntario;

class MailManagerSpec extends ObjectBehavior
{
    function let($mailer)
    {
        $mailer->beADoubleOf('\Swift_Mailer');
        $this->beConstructedWith($mailer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Eher\QueroSerVoluntario\Bundle\Model\MailManager');
    }

    function it_should_generate_a_message_with_a_voluntario()
    {
        $voluntario = new Voluntario();
        $voluntario->setNome("Alexandre Eher");
        $voluntario->setEmail("alexandre@eher.com.br");
        $voluntario->setCidade("Sorocaba");
        $voluntario->setEstado("SP");

        $this->setContactEmail("cadastro@queroservoluntario.com")
            ->generateMessageWithVoluntario($voluntario);

        $this->getMessage()->shouldHaveType('\Swift_Message');
        $this->getMessage()->getSubject()->shouldBeEqualTo(
            "Cadastro de Voluntário: Alexandre Eher (Sorocaba, SP)"
        );
        $this->getMessage()->getFrom()->shouldBeEqualTo(
            array("cadastro@queroservoluntario.com" => null)
        );
        $this->getMessage()->getTo()->shouldBeEqualTo(
            array("cadastro@queroservoluntario.com" => null)
        );
        $this->getMessage()->getReplyTo()->shouldBeEqualTo(
            array("alexandre@eher.com.br" => "Alexandre Eher")
        );
    }

    function it_should_throw_exception_without_contact_email()
    {
        $this->shouldThrow(new \Exception("Preciso do e-mail de contato"))->during('send');
    }

    function it_should_throw_exception_without_message()
    {
        $this->setContactEmail("contato@queroservoluntario.com");
        $this->shouldThrow(new \Exception("Preciso saber o que enviar"))->during('send');
    }
}
