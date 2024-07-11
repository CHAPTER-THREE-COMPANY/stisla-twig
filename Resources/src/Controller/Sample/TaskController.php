<?php
/**
 * Created by PhpStorm.
 * User: ikawa
 * Date: 2019-05-14
 * Time: 00:46
 */

namespace App\Controller\Sample;

use App\Entity\Sample\Task;
use App\Form\Sample\Sample\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route("/sample/task")]
class TaskController extends AbstractController
{
    #[Route('/', name: 'task_index', methods: ['GET'])]
    public function index(ManagerRegistry $registry): Response
    {
        $orders =  $registry->getRepository(Task::class)->findAll();

        return $this->render('sample/task/index.html.twig', [
            'rows' => $orders,
        ]);
    }

    #[Route('/new', name: 'task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $registry): Response
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $registry->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_index');
        }

        return $this->render('sample/task/new.html.twig', [
            'rows' => $task,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'task_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Task $order, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('task_index', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('sample/task/edit.html.twig', [
            'task' => $order,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}/delete', name: 'task_delete')]
    public function delete(Request $request, Task $order, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->get('_token'))) {
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_index');
    }

}