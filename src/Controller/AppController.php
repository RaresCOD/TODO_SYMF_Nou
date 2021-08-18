<?php

namespace App\Controller;

use App\Entity\TODO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BooleanType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class AppController extends AbstractController
{

  //
  // public function index() {
  //   return $this->render('app/index.html.twig', [
  //     'user' => $this->getUser()
  //   ]);
  // }
  // // public function addTask(Request $request): Response
  // {
  //







  //   $task = new TODO();
  //   $task->setTask('Write a blog post');
  //   $task->setImportance(3);
  //   $task->setCompleted(false);
  //
  //   $form = $this->createFormBuilder($task)
  //           ->add('task', TextType::class)
  //           ->add('importance', IntegerType::class)
  //           ->add('completed', IntegerType::class)
  //           ->add('add', SubmitType::class, ['label' => 'Create Task'])
  //           ->getForm();
  //
  // }



}
