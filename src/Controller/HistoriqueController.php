<?php
namespace App\Controller;
set_time_limit(60);
use Exception; 
use App\Entity\Historique;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/api", name="api_")
 */
class HistoriqueController extends AbstractController
{   

 
 
      /**
     * @Rest\Get("/historiques", name="app_historique_list")
     * @View
     */
    public function listAction(EntityManagerInterface $em)
    {
        $historiques = $em->getRepository('App\Entity\HistoriqueDepanneur')->findAll();
        return $historiques;
    }


    #$articles = $this->getDoctrine()->getRepository('App\Entity\HistoriqueDepanneur')->findAll();
        #return $articles;
    
    /**
     * @Rest\Post(
     *    path = "historique",
     *    name = "historique"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("historique", converter="fos_rest.request_body")
     */
    public function createAction(Historique $historique, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($historique);
        $em->flush();
        
        return $historique;
    }
  /**
     * @Get(
     *     path = "/historique/{id}",
     *     name = "app_historique_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Historique $historique)
    {
    
        return $historique;
    }
 
    /**
     * @Route("/historique/del/{id}", name="historique_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historique = $entityManager->getRepository(HistoriqueDepanneur::class)->find($id);
 
        if (!$historique) {
            return $this->json('No historique found for id' . $id, 404);
        }
 
        $entityManager->remove($historique);
        $entityManager->flush();
 
        return $this->json('Deleted a historique successfully with id ' . $id);
    }
 

    // public function new(Request $request): Response
    // {
    //     // creates a task object and initializes some data for this example
    //     $task = new Task();
    //     $task->setTask('Write a blog post');
    //     $task->setDueDate(new \DateTime('tomorrow'));

    //     $form = $this->createFormBuilder($task)
    //         ->add('task', TextType::class)
    //         ->add('dueDate', DateType::class)
    //         ->add('save', SubmitType::class, ['label' => 'Create Task'])
    //         ->getForm();
        
    //     // ...
    // }
 
}