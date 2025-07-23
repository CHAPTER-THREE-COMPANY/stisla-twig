<?php

namespace App\Controller\Defaults;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user', name: "app_user")]
class UserController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('defaults/user/index.html.twig', [
            'users' => $userRepository->findByNoneRoleUsers(),
        ]);
    }

    #[Route('/list', name: '_list', methods: ['GET'])]
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('defaults/user/list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('defaults/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('defaults/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('defaults/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/setuser', name: '_setuser', methods: ['GET'])]
    public function setUser(User $user, EntityManagerInterface $manager): Response
    {
        $roles = $user->getRoles();
        #$roles = array_merge($roles, ['ROLE_USER']);
        $roles = [...['ROLE_USER']];
        $roles = array_unique($roles);
        $user->setRoles($roles);
        $manager->persist($user);
        $manager->flush();
        $this->addFlash("success","ユーザー認証しました。");
        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
