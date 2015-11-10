<?php


namespace Malendar\Application\Service\User;

use Exception;
use Malendar\Application\Service\ApplicationServiceInterface;
use Malendar\Application\User\LoginUserCommand;
use Silex\Application;
use SimpleBus\Message\Bus\MessageBus;

class LoginUserService implements ApplicationServiceInterface
{
    private $commandBus;

    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function execute($request = null)
    {
        // TODO: Implement execute() method.
        $command = new LoginUserCommand($request->get('user'), $request->get('password'));
        try {
            $this->commandBus->handle($command);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }

    }
}