<?php


namespace Malendar\Application\Service\User;

use Malendar\Application\Service\ApplicationServiceInterface;
use Malendar\Infrastructure\Persistence\UserCaseRepository;
use Silex\Application;

class LoginUserService implements ApplicationServiceInterface
{
    private $userRepository;
    private $app;

    public function __construct(Application $app)
    {
        $this->userRepository = $app['user_repository'];
        $this->app = $app;
    }
    public function execute($request = null)
    {
        // TODO: Implement execute() method.
        $this->app['session']->start();
        $userName = $request->get('user');
        $password = $request->get('password');
        $user = $this->userRepository->findByUsername($userName);

        if (!empty($user) && $user->validate($password)) {
            $this->app['session']->set('id', $user->getHashCode());
            $this->app['session']->set('username', $user->getName());
            $this->app['session']->set('email', $user->getEmail());
            return true;
        } else {
            return false;
        }
    }
}