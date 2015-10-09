<?php


namespace Malendar\Application\Service\User;

use Malendar\Application\Service\ApplicationServiceInterface;
use Malendar\Domain\Entities\Repository\UserRepositoryInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginUserService implements ApplicationServiceInterface
{
    private $userRepository;
    private $session;

    public function __construct(UserRepositoryInterface $userRepository, Session $session)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }

    public function execute($request = null)
    {
        // TODO: Implement execute() method.
        $userName = $request->get('user');
        $password = $request->get('password');
        $user = $this->userRepository->findByUsername($userName);
        if (!empty($user) && $user->validate($password)) {

            $this->session->start();
            $this->session->set('user', array('id' => $user->getUserId(), 'username' => $user->getName(), 'email' => $user->getEmail()));
            return true;
        } else {
            return false;
        }
    }
}