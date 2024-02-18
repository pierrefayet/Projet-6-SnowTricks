<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Tag;
use App\Entity\Trick;
use App\Entity\Video;
use App\Form\CommentFormType;
use App\Form\DeleteTrickForm;
use App\Form\TrickFormType;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/add_trick', name: 'add_trick')]
    public function addTrick(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $trick = new Trick();
        $form = $this->createForm(TrickFormType::class, $trick);
        $form->handleRequest($request);


        $user = $security->getUser();

        if ($form->isSubmitted() && $form->isValid()) {

            $trick->setTitle('title');
            $trick->setIntro('intro');
            $trick->setContent('content');
            $trick->setAuthor($user);
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('single_trick', ['id' => $trick->getId()]);
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
        $formDelete = $this->createForm(TrickFormType::class, $trick);
        $formDelete->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            //image
            //gestion des images:
            //recuperation des media du formulaire
            $file = $form->get('media')->getData();
            if ($file !== null) {
                $mimeType = $file->getMimeType();
                if (str_starts_with($mimeType, 'image/')) {
                    $media = new Image();
                    $directory = '/image/';
                }
                if (str_starts_with($mimeType, 'video/')) {
                    $media = new Video();
                    $directory = '/video/';
                }
                if ($media !== null) {
                    // Sauvegarde du fichier et création de l'entité Media
                    $newFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . uniqid() . '.' . $file->guessExtension();
                    $file->move($this->getParameter('media_directory') . $directory, $newFilename);
                    $media->setFilename($newFilename);
                    $media->setTrick($trick);
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

        return $this->render('updateTrick.html.twig', [
            'trickForm' => $form->createView(),
            'trick' => $trick
        ]);
    }

    #[Route('/single_trick/{id}', name: 'single_trick')]
    public function showTrick(Trick $trick, EntityManagerInterface $entityManager,): Response
    {
        $comment = new Comment();
        $commentForm = $this->createForm(CommentFormType::class, $comment, ['action' => $this->generateUrl('add_comment', ['id' => $trick->getId()]),
            'method' => 'POST',]);
        $comments = [];
        if ($trick->getId() !== null) {
            $comments = $entityManager->getRepository(Comment::class)->findBy(['trick' => $trick], ['creationDate' => 'DESC']);
        }
        return $this->render('singleTrick.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
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
