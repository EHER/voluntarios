<?php
namespace Eher\QueroSerVoluntario\Bundle\FrontendBundle\Controller;

use Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Entidade;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Eher\QueroSerVoluntario\Bundle\DomainBundle\Form\EntidadeType;

class EntidadeController extends Controller
{
    private $search;

    /**
     * @Route("/entidades", name="buscar")
     * @Method("GET")
     */
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

    /**
     * @Route("/{estado}/{cidade}", name="entidades", requirements={
     *      "estado": "[a-z]{2}",
     *      "cidade": "[a-z-]+",
     * })
     * @Method("GET")
     */
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

    /**
     * @Route("/entidades/cadastrar", name="entidade_cadastrar")
     * @Method("GET")
     */
    public function formAction()
    {
        return $this->render('EherQueroSerVoluntarioFrontendBundle:Entidade:new.html.twig', [
            'entity' => new Entidade(),
            'form' => $this->createForm(new EntidadeType())->createView()
        ]);
    }

    /**
     * @Route("/entidades/cadastrar", name="entidade_create")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new EntidadeType());
        $form->bind($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirect(
                $this->generateUrl('entidade_parabens')
            );
        }

        return $this->render('EherQueroSerVoluntarioFrontendBundle:Entidade:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * @Route("/entidades/parabens", name="entidade_parabens")
     * @Method("GET")
     */
    public function parabensAction()
    {
        return $this->render('EherQueroSerVoluntarioFrontendBundle:Entidade:parabens.html.twig');
    }

    /**
     * @Route("/entidades/{geohash}", name="entidade_geohash", requirements={
     *      "geohash": "[\w]{4,12}",
     * })
     * @Method("GET")
     */
    public function geohashAction($geohash)
    {
        $em = $this->getDoctrine()->getManager();
        $this->search = $em->getRepository(Entidade::class)->createQueryBuilder('en')
            ->where('en.geohash like :geohash')
            ->setParameter('geohash', $geohash . '%')
            ->getQuery()
            ->getResult();

        return $this->render(
            'EherQueroSerVoluntarioFrontendBundle:Entidade:geohash.html.twig',
            array(
                'title' => '',
                'search' => $this->search,
            )
        );
    }
}
