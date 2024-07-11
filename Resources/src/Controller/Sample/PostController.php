<?php

namespace App\Controller\Sample;

use App\Entity\Sample\Post;
use App\Form\Sample\Sample\PostType;
use App\Repository\Sample\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/sample/post", name: "post")]
class PostController extends AbstractController
{
    /**
     * TODO: table.twig.html 用カスタマイズ for グループ検索
     *      引数追加
     *          Request $request
     *      コード追加
     *          $this->render(
     *              // パラメータ変更追加
     *              'posts'         => $postRepository->findByRequest($request),
     *              'repository'    => $postRepository
     *              // カスタマイズ
     *              'groups'        => [
     *                                  ['name'=>'Cat1', 'count'=>2],
     *                                  ['name'=>'Cat2', 'count'=>12]
     *                                 ]
     *          )
     */

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ){
    }

    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(PostRepository $postRepository, Request $request): Response
    {
        return $this->render('sample/post/index.html.twig', [
            //'posts'         => $postRepository->findAll(),
            'posts'         => $postRepository->findByRequest($request),
            'repository'    => $postRepository
        ]);
    }

    #[Route('/new', name: '_new', methods: ["GET","POST"])]
    public function new(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('sample/post/new.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/{id}", name: "_show", methods: ["GET"])]
    public function show(Post $post): Response
    {
        return $this->render('sample/post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route("/{id}/edit", name: "_edit", methods: ["GET","POST"])]
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('post_index', [
                'id' => $post->getId(),
            ]);
        }

        return $this->render('sample/post/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/{id}", name: "_delete", methods: ["DELETE"])]
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->get('_token'))) {
            $this->entityManager->remove($post);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    public function test(): JsonResponse
    {
        return new JsonResponse(['ikawa']);
    }
}
