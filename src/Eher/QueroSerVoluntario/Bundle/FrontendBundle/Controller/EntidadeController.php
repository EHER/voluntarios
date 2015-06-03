<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Entidade;
use Symfony\Component\HttpFoundation\Request;

class EntidadeController extends Controller
{
    private $search;

    public function searchAction(Request $request)
    {
        $cidade = $request->query->get('cidade');
        $estado = $request->query->get('estado');

        if (!empty($cidade) && !empty($estado)) {
            $em = $this->getDoctrine()->getManager();
            $this->search = $em->getRepository(Entidade::class)->createQueryBuilder('en')
                ->join('en.cidade', 'ci')
                ->join('ci.estado', 'es')
                ->where('ci.nome = :cidade')
                ->andWhere('es.nome = :estado')
                ->setParameter('cidade', $cidade)
                ->setParameter('estado', $estado)
                ->getQuery()
                ->getResult();
        }

        return $this->render(
            'EherQueroSerVoluntarioFrontendBundle:Entidade:search.html.twig',
            [
                'cidade' => $cidade,
                'estado' => $estado,
                'search' => $this->search,
            ]
        );
    }

    public function cityAndStateAction($cidade, $estado)
    {
        $em = $this->getDoctrine()->getManager();
        $this->search = $em->getRepository(Entidade::class)->createQueryBuilder('en')
            ->join('en.cidade', 'ci')
            ->join('ci.estado', 'es')
            ->where('ci.slug = :cidade')
            ->andWhere('es.nome = :estado')
            ->setParameter('cidade', $cidade)
            ->setParameter('estado', $estado)
            ->getQuery()
            ->getResult();

        return $this->render(
            'EherQueroSerVoluntarioFrontendBundle:Entidade:entidades.html.twig',
            array(
                'cidade' => $cidade,
                'estado' => $estado,
                'search' => $this->search,
            )
        );
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository(Entidade::class)->findAll();

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Entidade:index.html.twig', array(
            'entities' => $entities
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository(Entidade::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entidade entity.');
        }

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Entidade:show.html.twig', [
            'entity'      => $entity,
        ]);
    }
}
