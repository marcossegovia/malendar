<?php


namespace Malendar\Application\User;


use Exception;
use Malendar\Domain\Entities\User\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginUserCommandHandler
{
    private $userRepository;
    private $session;

    public function __construct(UserRepositoryInterface $userRepository, Session $session)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }
    public function handle(LoginUserCommand $command)
    {
        $user = $this->userRepository->findByUsername($command->username());
        if (!empty($user) && $user->validate($command->password())) {

            $this->session->start();
            $this->session->set('user', array('id' => $user->getUserId(), 'username' => $user->getName(), 'email' => $user->getEmail()));

        } else {
            throw new Exception('User not in the database or Password not valid');
        }
    }
}