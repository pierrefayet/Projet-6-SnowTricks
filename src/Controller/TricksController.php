<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Tag;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\CommentFormType;
use App\Form\TrickFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class TricksController extends AbstractController
{
    #[Route('/add_trick', name: 'add_trick')]
    public function addTrick(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);
        $form = $form->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setContent('content');
            $trick->setIntro('intro');
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['id' => $trick->getId()]);
        }

        return $this->render('singleTrick.html.twig', [
            'trick' => $trick,
            'trickForm' => $form->createView()
        ]);
    }

    #[IsGranted('edit', 'trick')]
    #[Route('/update_tricks/{id}', name: 'update_tricks')]
    public function modifyArticle(Request $request, EntityManagerInterface $entityManager, Trick $trick): Response
    {

        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mediasFiles = $form->get('medias')->getData();
            foreach ($mediasFiles as $file) {
                if ($file instanceof UploadedFile) {
                    $mimeType = $file->getMimeType();
                    if (str_starts_with($mimeType, 'image/')) {
                        $media = new Image();
                    }
                    if (str_starts_with($mimeType, 'video/')) {
                        $media = new video();
                    }

                    if ($media) {
                        // Sauvegarde du fichier et création de l'entité Media
                        $newFilename = uniqid() . '.' . $file->guessExtension();
                        $file->move($this->getParameter('media_directory'), $newFilename);
                        $media->setFilename($newFilename);
                        $media->setTrick($trick);
                    }
                }
            }
        }

        // tag
        // Géstion des tags existants
        $trick = $form->getData();

        // Géstion des nouveaux tags
        $newTagsString = $form->get('newTags')->getData();
        if (!empty($newTagsString)) {
            $newTagsArray = explode(',', $newTagsString);
            foreach ($newTagsArray as $tagName) {
                $tagName = trim($tagName);
                if (!empty($tagName)) {
                    $tag = $entityManager->getRepository(Tag::class)->findOneBy(['name' => $tagName]);
                    if (!$tag) {
                        $tag = new Tag();
                        $tag->setName($tagName);
                        $entityManager->persist($tag);
                    }
                    $trick->addTag($tag);
                }
            }
        }

        $entityManager->flush();

        return $this->render('updateTrick.html.twig', ['trickForm' => $form->createView(),
            'trick' => $trick]);
    }

    #[
        Route('/single_trick/{id}', name: 'single_trick')]
    public function showTrick(Trick $trick, EntityManagerInterface $entityManager,): Response
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentFormType::class, $comment, ['action' => $this->generateUrl('add_comment', ['id' => $trick->getId()]),
            'method' => 'POST',]);
        $comments = $entityManager->getRepository(Comment::class)->findBy(['commentPostId' => $trick], ['creationDate' => 'DESC']);
        return $this->render('singleTrick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
            'commentForm' => $commentForm->createView()
        ]);
    }

    #[IsGranted('delete', 'trick')]
    #[Route('/delete_trick/{id}', name: 'delete_trick')]
    public function deleteTrick(Request $request, Trick $trick, EntityManagerInterface $entityManager): Response
    {

        if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
