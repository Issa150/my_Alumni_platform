<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileUpdaterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/{id}', name: 'app_profile')]
    public function profileUser(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);

        return $this->render('profile/pages/feeds.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user
        ]);
    }

    #[Route('/profile/feeds/{id}', name: 'my_feeds')]
    public function feeds(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        return $this->render('profile/pages/feeds.twig', [
            'user' => $user
        ]);
    }

    #[Route('/profile/resources/{id}', name: 'my_sources')]
    public function sources(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        return $this->render('profile/pages/resources.twig', [
            'user' => $user
        ]);
    }

    #[Route('/profile/my_profile/{id}', name: 'my_profile')]
    public function myProfile(
        User $user,
        UserRepository $userRepository,
        Request $request, 
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        #[Autowire('%kernel.project_dir%/public/uploads/userPictures')] string $profilePicturesDirectory,
        #[Autowire('%kernel.project_dir%/public/uploads/cv')] string $cvDirectory,
        #[Autowire('%kernel.project_dir%/public/uploads/covers')] string $coverDirectory,
        int $id
    ): Response
    {
        $user = $userRepository->findOneById($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

    $formProfileUpdater = $this->createForm(UserProfileUpdaterType::class, $user);
    $formProfileUpdater->handleRequest($request);
    
    if ($formProfileUpdater->isSubmitted()) {
        /** @var UploadedFile $pictureFile */
        $pictureFile = $formProfileUpdater->get('picture')->getData();
        $cvFile = $formProfileUpdater->get('cv')->getData();
        $coverFile = $formProfileUpdater->get('cover')->getData();

        // Process the uploaded picture file
        if ($pictureFile) {
            $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

            // Move the file to the directory where profile pictures are stored
            try {
                $pictureFile->move($profilePicturesDirectory, $newFilename);
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
                $this->addFlash('error', 'An error occurred while uploading your profile picture.');
                return $this->redirectToRoute('my_profile');
            }

            // Update the 'picture' property to store the file name
            $user->setPicture($newFilename);
        }

        // Process the uploaded CV file
        if ($cvFile) {
            $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$cvFile->guessExtension();

            // Move the file to the directory where CVs are stored
            try {
                $cvFile->move($cvDirectory, $newFilename);
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
                $this->addFlash('error', 'An error occurred while uploading your CV.');
                return $this->redirectToRoute('my_profile');
            }

            // Update the 'cv' property to store the file name
            $user->setCv($newFilename);
        }

        // Process the uploaded cover file
        if ($coverFile) {
            $originalFilename = pathinfo($coverFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$coverFile->guessExtension();

            // Move the file to the directory where covers are stored
            try {
                $coverFile->move($coverDirectory, $newFilename);
            } catch (FileException $e) {
                // Handle exception if something happens during file upload
                $this->addFlash('error', 'An error occurred while uploading your cover.');
                return $this->redirectToRoute('my_profile');
            }

            // Update the 'cover' property to store the file name
            $user->setCover($newFilename);
        }

        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'Profile updated successfully.');

        return $this->redirectToRoute('my_profile', ['id' => $user->getId()]);
    }

    return $this->render('profile/pages/my_profile.twig', [
        'user' => $user,
        'form' => $formProfileUpdater->createView(),
    ]);
    }

    #[Route('/profile/likes/{id}', name: 'my_likes')]
    public function likes(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        return $this->render('profile/pages/likes.twig', [
            'user' => $user
        ]);
    }

    #[Route('/profile/abonnement/{id}', name: 'my_abonnement')]
    public function contacts(UserRepository $userRepository, int $id): Response
    {
        $user = $userRepository->findOneById($id);
        return $this->render('profile/pages/follow.twig', [
            'user' => $user
        ]);
    }
}
