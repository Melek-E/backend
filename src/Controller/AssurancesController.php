<?php
namespace App\Controller;
 
use App\Entity\Assurances;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get; 
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;









/**
 * @Route("/api", name="api_")
 */
class AssurancesController extends AbstractController
{ 
     /**
    * @Rest\Get("/assurances", name="app_assurances_list")
    * @View
    */
   public function listAction(EntityManagerInterface $em)
   {
       $assurances = $em->getRepository('App\Entity\Assurances')->findAll();
       return $assurances;
   }


    /**
     * @Rest\Post(
     *    path = "/assurances",
     *    name = "app_assurances_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("assurances", converter="fos_rest.request_body")
     */
    public function createAction(Assurances $assurances, PersistenceManagerRegistry $doctrine)
    {   
        
        $em = $doctrine->getManager();

        $em->persist($assurances);
        $em->flush();
        
        return $assurances;
    }

 /**
     * @Get(
     *     path = "/assurances/{id}",
     *     name = "app_assurances_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Assurances $assurances)
    {
        return $assurances;
    }




    /**
     * @Route("/assurances/{id}", name="assurances_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $assurances = $entityManager->getRepository(Assurances::class)->find($id);
 
        if (!$assurances) {
            return $this->json('No assurances found for id' . $id, 404);
        }
 
        $assurances->setName($request->request->get('name'));
        $assurances->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $assurances->getId(),
            'nom' => $assurances->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/assurances/del/{id}", name="assurances_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $assurances = $entityManager->getRepository(Assurances::class)->find($id);
 
        if (!$assurances) {
            return $this->json('No assurances found for id' . $id, 404);
        }
 
        $entityManager->remove($assurances);
        $entityManager->flush();
        return $this->json('Deleted a assurances successfully with id ' . $id);
    }
 
 
}