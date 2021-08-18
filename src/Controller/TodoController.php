<?php

namespace App\Controller;

use App\Entity\TodoBun;
use App\Form\TodoFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;

class TodoController extends AbstractController
{

  /**
   * @Route("/homepage", name="app_homepage")
   */
  public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager)
  {
    $task = new TodoBun();

    $form = $this->createForm(TodoFormType::class, $task);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->persist($task);
      $entityManager->flush();

      return new Response('Task number ' . $task->getId() . ' created');
    }

    return new Response($twig->render('app/index.html.twig', [
      'task_form' => $form->createView()
    ]));

  }
}
