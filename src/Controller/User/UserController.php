<?php


namespace LaSalle\GroupSeven\Controller\User;


use LaSalle\GroupSeven\User\Application\RegisterUser;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidEmail;
use LaSalle\GroupSeven\User\Domain\Exception\InvalidPassword;
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

    #[Route('/register', name: 'RegisterUser', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        try {
            $uuid = Uuid::v4();
            $id = $uuid->toRfc4122();
            $this->registerUser->__invoke(
                $id,
                $request->request->get('mail'),
                $request->request->get('password')
            );
            return $this->json('ok',Response::HTTP_OK);
        } catch (InvalidEmail $invalidEmail) {
            return $this->json($invalidEmail->getMessage(), Response::HTTP_BAD_REQUEST);

        } catch (InvalidPassword $invalidPassword) {
            return $this->json($invalidPassword->getMessage(), Response::HTTP_BAD_REQUEST);

        }catch (\Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}