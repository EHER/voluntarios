<?php
namespace Eher\QueroSerVoluntario\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MensagemController extends Controller
{
    public function welcomeAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $voluntarioId = $request->get('voluntarioId');
        $nome = $request->get('nome');

        if (!empty($voluntarioId)) {
            $voluntario = $entityManager->getRepository('EherQueroSerVoluntarioDomainBundle:Voluntario')->find($voluntarioId);
            $nome = $voluntario->getNome();

            if (!$voluntario) {
                throw $this->createNotFoundException('Unable to find Voluntario entity.');
            }
        }

        return $this->render(
            'EherQueroSerVoluntarioAdminBundle:Mensagem:welcome.html.twig',
            array(
                'nome' => $nome,
            )
        );
    }

    public function recomendationAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $voluntarioId = $request->get('voluntarioId');
        $nome = $request->get('nome');
        $cidade = $request->get('cidade');

        if (!empty($voluntarioId)) {
            $dql = 'select voluntario from EherQueroSerVoluntarioDomainBundle:Voluntario voluntario join voluntario.cidade cidade where voluntario.id = :voluntarioId';
            $query = $entityManager->createQuery($dql)
                ->setParameter('voluntarioId', $voluntarioId);
            $voluntario = $query->getResult();

            if (!$voluntario) {
                throw $this->createNotFoundException('Unable to find Voluntario entity.');
            }

            $nome = $voluntario[0]->getNome();
            $cidade = $voluntario[0]->getCidade()->getNome();
        }

        $dql = "select vaga from EherQueroSerVoluntarioDomainBundle:Vaga vaga join vaga.entidade entidade join entidade.cidade cidade where cidade.id in (select c.id from EherQueroSerVoluntarioDomainBundle:Voluntario voluntario join voluntario.cidade c where voluntario.id = :voluntarioId) or vaga.online = true order by entidade.nome";
        $query = $entityManager->createQuery($dql)
            ->setParameter('voluntarioId', $voluntarioId);
        $vagas = $query->getResult();

        return $this->render(
            'EherQueroSerVoluntarioAdminBundle:Mensagem:recomendation.html.twig',
            array(
                'cidade' => $cidade,
                'vagas' => $vagas,
                'nome' => $nome,
            )
        );
    }

    public function newsAction()
    {
        return $this->render('EherQueroSerVoluntarioAdminBundle:Mensagem:news.html.twig');
    }
}
