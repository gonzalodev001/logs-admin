<?php


namespace LaSalle\GroupSeven\Controller\User;

use LaSalle\GroupSeven\Form\Type\UserType;
use LaSalle\GroupSeven\User\Application\RegisterUser;
use LaSalle\GroupSeven\User\Domain\Exception\ExistingUser;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidConfirmPassword;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidEmail;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class UserController extends AbstractController
{
    public function __construct(private RegisterUser $registerUser)
    {
    }

    #[Route('/register', name: 'RegisterUser')]
    public function register(Request $request): Response
    {
            $errors = array(
                "email" => "",
                "password" => "",
                "existing_user" => "",
                "confirm_password" => "",
                "code_error" => "",
                "exception" => ""
            );
            $form = $this->createForm(UserType::class);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                try {
                    $uuid = Uuid::v4();
                    $id = $uuid->toRfc4122();
                    $this->registerUser->__invoke(
                        $id,
                        $form->getData()['mail'],
                        $form->getData()['password'],
                        $form->getData()['confirmPassword']
                    );
                }catch (InvalidEmail $invalidEmail) {
                    $errors['email'] = $invalidEmail->getMessage();
                    $errors['code_error'] = $invalidEmail->errorCode();

                } catch (InvalidPassword $invalidPassword) {
                    $errors['password'] = $invalidPassword->getMessage();
                    $errors['code_error'] = $invalidPassword->errorCode();

                }  catch (ExistingUser $existingUser) {
                    $errors['existing_user'] = $existingUser->getMessage();
                    $errors['code_error'] = $existingUser->errorCode();

                } catch (InvalidConfirmPassword $invalidConfirmPassword) {
                    $errors['confirm_password'] = $invalidConfirmPassword->getMessage();
                    $errors['code_error'] = $invalidConfirmPassword->errorCode();
                }
                catch (\Exception $exception) {
                    $errors['exception'] = $exception->getMessage();
                }

                //return $this->redirect('/log-summary/dev');
                //return $this->redirectToRoute('dashboard_summary', );
                if (!$form->getErrors()) {
                    return $this->render('Emails/confirm_registration.html.twig');
                }

            }

            return $this->render('User/Register_User.html.twig',
            [
                'form' => $form->createView(),
                'errors' => $errors
            ]);

    }

    #[Route('/login', name: 'login', methods: ['GET'])]
    public function formUser(): Response
    {
        return $this->render('login.html.twig');
    }
}