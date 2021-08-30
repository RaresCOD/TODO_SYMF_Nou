<?php

namespace App\Controller;

use App\Entity\TodoSiMaiBun;
use App\Form\TodoFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Helper\QuestionHelper;
use App\Controller\TodoController;
use Symfony\Component\HttpFoundation\Session\Session;


class TodoController extends AbstractController
{

  /**
   * @Route("/homepage", name="app_homepage")
   */
  public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager)
  {
    if ($this->get('session')->has('user_id')) {
      $userId = $this->get('session')->get('user_id');

      $task = new TodoSiMaiBun();

      $form = $this->createForm(TodoFormType::class, $task);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $task->setIdUser($userId);
        $entityManager->persist($task);
        $entityManager->flush();


        return new Response($twig->render('app/TaskAdded.html.twig', [
          'task' => $task
        ]));
      }

      $tasks = $this->getDoctrine()->getRepository('App:TodoSiMaiBun')->findAll();

      return new Response($twig->render('app/index.html.twig', [
        'task_form' => $form->createView(),
        'tasks' => $tasks,
        'Id' => $userId
      ]));
    } else {
      return new Response($twig->render('app/LogError.html.twig'));
    }


  }

    /**
   *
   * @Route("/entity-remove/{id}", requirements={"id" = "\d+"}, name="delete_task")
   *
   */
   public function deleteTask(int $id) {
     $entityManager = $this->getDoctrine()->getManager();
     $task = $entityManager->getRepository(TodoSiMaiBun::class)->find($id);
     $entityManager->remove($task);
     $entityManager->flush();
     return $this->redirectToRoute('app_homepage');
   }

   public function execute(InputInterface $input, OutputInterface $output)
  {
      // ...
      $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');

      $bundleName = $helper->ask($input, $output, $question);
  }

   /**
  *
  * @Route("/entity-update/{id}", requirements={"id" = "\d+"}, name="update_task")
  *
  */
  public function updateTask(int $id) {
    $entityManager = $this->getDoctrine()->getManager();
    $task = $entityManager->getRepository(TodoSiMaiBun::class)->find($id);
    // $helper = $this->
    // $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');
    // $bundleName = $helper->ask($input, $output, $question);
    $session = new Session;
    $session->set('task_c', $task->getCompleted());
    print_r($task->getCompleted());
    $entityManager->remove($task);
    $entityManager->flush();
    return $this->redirectToRoute('update');
    //return $this->render('app/update.html.twig');
    // $task->setTask("Nou");
    // $entityManager->flush();
    // return $this->redirectToRoute('app_homepage');
  }

  /**
  *
  * @Route("/entity-complete/{id}", requirements={"id" = "\d+"}, name="complete_task")
  *
  */
  public function completeTask(int $id) {
    $entityManager = $this->getDoctrine()->getManager();
    $task = $entityManager->getRepository(TodoSiMaiBun::class)->find($id);
    $task->setCompleted(1);
    $entityManager->flush();
    return $this->redirectToRoute('app_homepage');
  }

  /**
 *
 * @Route(name="log_out")
 *
 */
 public function logout() {
   session_destroy();
   return $this->redirectToRoute('app_login');
 }
}
