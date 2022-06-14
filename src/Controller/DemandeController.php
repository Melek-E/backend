<?php
namespace App\Controller;
 
use App\Entity\Demande;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

/**
 * @Route("/api", name="api_")
 */
class DemandeController extends AbstractController
{ 
    
    /**
    * @Rest\Get("/demandes", name="app_demandes_list")
    * @View
    */
   public function listAction(EntityManagerInterface $em)
   {
       $demandes = $em->getRepository('App\Entity\Demande')->findAll();
       return $demandes;
   }
 
   


    /**
     * @Rest\Post(
     *    path = "/demande",
     *    name = "app_demande_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("demande", converter="fos_rest.request_body")
     */
    public function createAction(Demande $demande, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($demande);
        $em->flush();
        
        return $demande;
    }

  /**
     * @Get(
     *     path = "/demande/{id}",
     *     name = "app_demande _show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Demande $demande)
    {
        return $demande;
    }
 
    /**
     * @Route("/demande/{id}", name="demande_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $demande = $entityManager->getRepository(Demande::class)->find($id);
 
        if (!$demande) {
            return $this->json('No demande found for id' . $id, 404);
        }
 
        $demande->setName($request->request->get('name'));
        $demande->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $demande->getId(),
            'name' => $demande->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/demande/del/{id}", name="demande_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $demande = $entityManager->getRepository(Demande::class)->find($id);
 
        if (!$demande) {
            return $this->json('No demande found for id' . $id, 404);
        }
 
        $entityManager->remove($demande);
        $entityManager->flush();
 
        return $this->json('Deleted a demande successfully with id ' . $id);
    }
 
 
}