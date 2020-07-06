<?php


declare(strict_types=1);

namespace App\Controller;

use App\Repositories\User\UserRepository;
use App\Service\Login;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @return Response|null
     */
    public function login(Request $request): ?Response
    {
        return new Response(
            null,
            (new Login(new UserRepository()))->__invoke($request->get('email'), $request->get('password'))
        );
    }
}
