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
     * @Rest\Get("/historiquedepanneurs", name="app_historiquedepanneur_list")
     * @View
     */
    public function listAction(EntityManagerInterface $em)
    {
        $historiquedepanneurs = $em->getRepository('App\Entity\HistoriqueDepanneur')->findAll();
        return $historiquedepanneurs;
    }


    #$articles = $this->getDoctrine()->getRepository('App\Entity\HistoriqueDepanneur')->findAll();
        #return $articles;
    
    /**
     * @Rest\Post(
     *    path = "/historiquedepanneur",
     *    name = "historiquedepanneur"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("historiquedepanneur", converter="fos_rest.request_body")
     */
    public function createAction(Historique $historiquedepanneur, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($historiquedepanneur);
        $em->flush();
        
        return $historiquedepanneur;
    }
  /**
     * @Get(
     *     path = "/historiquedepanneur/{id}",
     *     name = "app_historiquedepanneur_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Historique $historiquedepanneur)
    {
    
        return $historiquedepanneur;
    }
 
    /**
     * @Route("/historiquedepanneur/del/{id}", name="historiquedepanneur_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historiquedepanneur = $entityManager->getRepository(HistoriqueDepanneur::class)->find($id);
 
        if (!$historiquedepanneur) {
            return $this->json('No historiquedepanneur found for id' . $id, 404);
        }
 
        $entityManager->remove($historiquedepanneur);
        $entityManager->flush();
 
        return $this->json('Deleted a historiquedepanneur successfully with id ' . $id);
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