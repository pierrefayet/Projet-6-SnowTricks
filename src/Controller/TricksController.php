<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentFormType;
use App\Form\DeleteTrickForm;
use App\Form\TrickFormType;
use App\Repository\CommentRepository;
use App\Services\HandleMedia;
use App\Services\HandleTags;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TricksController extends AbstractController
{
    public function __construct(private readonly HandleMedia $handleMedia, private readonly HandleTags $handleTags)
    {
    }

    #[Route('/add_trick', name: 'add_trick')]
    public function addTrick(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('addTrick.html.twig', [
            'trick' => $trick,
            'trickForm' => $form->createView(),
            'MediaType' => $form->createView()
        ]);
    }

    #[IsGranted('edit', 'trick')]
    #[Route('/update_tricks/{id}', name: 'update_tricks')]
    public function modifyArticle(Request $request, EntityManagerInterface $entityManager, Trick $trick): Response
    {
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('medias')->getData();
            if (isset($file)) {
                $this->handleMedia->handleMediaUpload($file, $trick);
            }

            $newTagsString = $form->get('newTags')->getData();
            $this->handleTags->handleTags($newTagsString, $trick, $entityManager);

            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('updateTrick.html.twig', [
            'trickForm' => $form->createView(),
            'trick' => $trick
        ]);
    }

    #[Route('/single_trick/{slug}', name: 'single_trick')]
    public function showTrick(Trick $trick, CommentRepository $commentRepository): Response
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentFormType::class, $comment, ['action' => $this->generateUrl('add_comment', ['id' => $trick->getId()]),
            'method' => 'POST',]);
        $comments = $commentRepository->paginateTrick(1, 5);
        $maxPage = ceil($comments->getTotalItemCount() / 5);

        return $this->render('singleTrick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'maxPage' => $maxPage,
            'commentForm' => $commentForm->createView()
        ]);
    }

    #[IsGranted('delete', 'trick')]
    #[Route('/delete_trick/{id}', name: 'delete_trick')]
    public function deleteTrick(
        Request                       $request,
        Trick                         $trick,
        EntityManagerInterface        $entityManager,
        AuthorizationCheckerInterface $authorizationChecker,
        SessionInterface              $session
    ): Response
    {
        if (!$authorizationChecker->isGranted('delete', $trick)) {
            $session->getFlashBag()->add('error', 'Vous ne pouvez supprimer que les figures que vous avez créées.');

            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(DeleteTrickForm::class, $trick);
        $form->handleRequest($request);
        $entityManager->remove($trick);
        $entityManager->flush();
        $session->getFlashBag()->add('success', 'La figure a été supprimée avec succès.');

        return $this->redirectToRoute('home');
    }
}
