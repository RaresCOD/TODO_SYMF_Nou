<?php

namespace App\Controller;

use App\Document\TodoSiMaiBun;
use App\Form\UpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ODM\MongoDB\DocumentManager;


class UpdateController extends AbstractController
{
    #[Route('/update', name: 'update')]
    public function index(Request $request, DocumentManager $entityManager): Response
    {
      $userId = $this->get('session')->get('user_id');
      $TaskC = $this->get('session')->get('task_c');
      $task = new TodoSiMaiBun();

      $form = $this->createForm(UpdateType::class, $task);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $task->setIdUser($userId);
        $task->setCompleted($TaskC);
        $entityManager->persist($task);
        $entityManager->flush();


        return $this->redirectToRoute('app_homepage');
      }


      return $this->render('update/index.html.twig', [
          'task_form' => $form->createView(),
      ]);
    }
}
