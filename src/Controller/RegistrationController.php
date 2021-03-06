<?php

namespace App\Controller;

use App\Document\User;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Security\LoginNouAuthenticator;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\ODM\MongoDB\DocumentManager;



class RegistrationController extends AbstractController
{
    // private $emailVerifier;
    //
    // public function __construct(EmailVerifier $emailVerifier)
    // {
    //     $this->emailVerifier = $emailVerifier;
    // }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     * @todo move the logic to a service & add translation for the setting of the garden name
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, DocumentManager $dm, UserPasswordEncoderInterface $passwordEncoder, LoginNouAuthenticator $loginAuthenticator, GuardAuthenticatorHandler $guard, ValidatorInterface $validator, UserRepository $ur): Response
    {
        $user = new User();

        // $all = $ur->getAll();
        // $exists = true;
        // while ($exists == true) {
        //   $exists = false;
        //   foreach ($all as $value) {
        //     if ($value->getId() == $user->getId())
        //       $exists = true;
        //   }
        //   if($exists == true)
        //     $user = new User();
        // }


        $errors = $validator->validate($user);



        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['USER_ROLE']);
            // $entityManager = $this->getDoctrine()->getManager();
            $dm->persist($user);
            $dm->flush();

            // generate a signed url and email it to the user
            // $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //     (new TemplatedEmail())
            //         ->from(new Address('admin@yahoo.com', 'Rares_TODO'))
            //         ->to($user->getEmail())
            //         ->subject('Please Confirm your Email')
            //         ->htmlTemplate('registration/confirmation_email.html.twig')
            // );
            // do anything else you need here, like send an email



            $session = new Session();
            //session_start();
            $session->set('user_id', $user->getId());
            // return $this->redirectToRoute('app_homepage');

            return $guard->authenticateUserAndHandleSuccess($user, $request, $loginAuthenticator, 'main');
            // return $this->redirectToRoute('app_homepage');


        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }



    // #[Route('/verify/email', name: 'app_verify_email')]
    // public function verifyUserEmail(Request $request): Response
    // {
    //     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    //
    //     // validate email confirmation link, sets User::isVerified=true and persists
    //     try {
    //         $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
    //     } catch (VerifyEmailExceptionInterface $exception) {
    //         $this->addFlash('verify_email_error', $exception->getReason());
    //
    //         return $this->redirectToRoute('app_register');
    //     }
    //
    //     // @TODO Change the redirect on success and handle or remove the flash message in your templates
    //     $this->addFlash('success', 'Your email address has been verified.');
    //
    //     return $this->redirectToRoute('app_register');
    // }
}
