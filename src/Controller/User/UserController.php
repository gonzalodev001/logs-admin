<?php


namespace LaSalle\GroupSeven\Controller\User;


use LaSalle\GroupSeven\Core\Domain\DomainError;
use LaSalle\GroupSeven\Form\Type\UserType;
use LaSalle\GroupSeven\User\Application\RegisterUser;
use LaSalle\GroupSeven\User\Domain\Exception\ExistingUser;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidConfirmPassword;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidEmail;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;
use LaSalle\GroupSeven\User\Domain\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
                    //return $this->json($invalidEmail->getMessage(), Response::HTTP_BAD_REQUEST);

                } catch (InvalidPassword $invalidPassword) {
                    $errors['password'] = $invalidPassword->getMessage();
                    //return $this->json($invalidPassword->getMessage(), Response::HTTP_BAD_REQUEST);

                }  catch (ExistingUser $existingUser) {
                    $errors['existing_user'] = $existingUser->getMessage();
                    //return $this->json($existingUser->getMessage(), Response::HTTP_BAD_REQUEST);
                } catch (InvalidConfirmPassword $invalidConfirmPassword) {
                    $errors['confirm_password'] = $invalidConfirmPassword->getMessage();
                }
                catch (\Exception $exception) {
                    $errors['exception'] = $exception->getMessage();
                    //return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
                }
            }

            return $this->render('User/Register_User.html.twig',
            [
                'form' => $form->createView(),
                'errors' => $errors
            ]);
            //return $this->json('ok',Response::HTTP_OK);

    }

    #[Route('/login', name: 'login', methods: ['GET'])]
    public function formUser(): Response
    {
        return $this->render('RegisterUser.html.twig');
    }
}