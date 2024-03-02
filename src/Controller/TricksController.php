<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Trick;
use App\Form\DeleteTrickForm;
use App\Form\TrickFormType;
use App\Repository\CommentRepository;
use App\Services\HandleMedia;
use App\Services\Manager\CommentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/trick')]
class TricksController extends AbstractController
{
    public function __construct(
        private readonly HandleMedia $handleMedia,
        private readonly TranslatorInterface $translator,
    ) {
    }

    #[Route('/add', name: 'add_trick')]
    public function addTrick(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trick = new Trick();
        $form  = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trick);
            $file = $form->get('medias')->getData();
            if (\is_array($file)) {
                $this->handleMedia->handleMediaUpload($file, $trick);
            }

            $entityManager->flush();
            $this->addFlash('success', $this->translator->trans('tricks.success.add'));

            return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('trick/addTrick.html.twig', [
            'trick'     => $trick,
            'trickForm' => $form->createView(),
            'MediaType' => $form->createView(),
        ]);
    }

    #[IsGranted('edit', 'trick')]
    #[Route('/update/{id}', name: 'update_tricks')]
    public function modifyArticle(Request $request, EntityManagerInterface $entityManager, Trick $trick): Response
    {
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('medias')->getData();
            if (\is_array($file)) {
                $this->handleMedia->handleMediaUpload($file, $trick);
            }

            $entityManager->flush();
            $this->addFlash('success', $this->translator->trans('tricks.success.update'));

            return $this->redirectToRoute('single_trick', ['slug' => $trick->getSlug()]);
        }

        return $this->render('trick/updateTrick.html.twig', [
            'trickForm' => $form->createView(),
            'trick'     => $trick,
        ]);
    }

    #[Route('/single/{slug}', name: 'single_trick')]
    public function showTrick(Trick $trick, CommentRepository $commentRepository, CommentManager $commentManager): Response
    {
        $commentForm = $commentManager->addComment($trick);
        $comments    = $commentRepository->paginateTrick(1, 5, $trick);
        $maxPage     = ceil($comments->getTotalItemCount() / 5);

        return $this->render('trick/singleTrick.html.twig', [
            'trick'       => $trick,
            'comments'    => $comments,
            'maxPage'     => $maxPage,
            'commentForm' => $commentForm->createView(),
        ]);
    }

    #[IsGranted('delete', 'trick')]
    #[Route('/delete/{id}', name: 'delete_trick')]
    public function deleteTrick(
        Request $request,
        Trick $trick,
        EntityManagerInterface $entityManager,
    ): Response {
        $form = $this->createForm(DeleteTrickForm::class, $trick);
        $form->handleRequest($request);
        $entityManager->remove($trick);
        $entityManager->flush();
        $this->addFlash('success', $this->translator->trans('tricks.success.delete'));

        return $this->redirectToRoute('home');
    }
}
