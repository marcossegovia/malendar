<?php
//
//namespace Malendar\Tests\Infrastructure\Persistence;
//
//use DateTime;
//use Malendar\Infrastructure\Factory\EmailFactory;
//use Malendar\Infrastructure\Factory\MasterFactory;
//use Malendar\Infrastructure\Factory\UserFactory;
//use Malendar\Infrastructure\Factory\UuIdFactory;
//use Malendar\Infrastructure\Persistence\DoctrineUserRepository;
//use Silex\Application;
//
//class DoctrineUserRepositoryTest extends \PHPUnit_Framework_TestCase
//{
//    public function testNextUserIdReturnsUuId()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $this->assertInstanceOf('Malendar\Domain\Model\ValueObject\UuId', UuIdFactory::create());
//    }
//
//    public function testUserPersistance()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//        $user = UserFactory::create(UuIdFactory::create(), 'Pablo', EmailFactory::create('pablo@gmail.com'), false, '12745');
//        $repository->add($user);
//
//        $user = $repository->find($user->getId());
//        $this->assertTrue(count($user) == 1);
//
//        $repository->remove($user);
//    }
//
//    public function testAllUsersAreFound()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $user1 = UserFactory::create(UuIdFactory::create(), 'Marcos', EmailFactory::create('marcos@gmail.com'), false, '1234');
//        $repository->add($user1);
//        $user2 = UserFactory::create(UuIdFactory::create(), 'David', EmailFactory::create('david@gmail.com'), false, '5678');
//        $repository->add($user2);
//
//        $users = $repository->findAll();
//        $this->assertTrue(count($users) >= 2);
//
//        $repository->remove($user1);
//        $repository->remove($user2);
//    }
//
//    public function testAddingUser()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $userId = UuIdFactory::create();
//
//        $user = UserFactory::create($userId, 'Juan', EmailFactory::create('juan@gmail.com'), false, 'juanito123');
//
//        $repository->add($user);
//
//        $user = $repository->find($userId);
//        $this->assertTrue(count($user) == 1);
//
//        $repository->remove($user);
//    }
//
//    public function testFindUserByEmail()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $userSent = UserFactory::create(UuIdFactory::create(), 'troll', EmailFactory::create('troll@gmail.com'), false, 'troll123');
//
//        $repository->add($userSent);
//
//        $userReceived = $repository->findByEmail(EmailFactory::create('troll@gmail.com'));
//        $this->assertTrue($userSent->equals($userReceived));
//
//        $repository->remove($userSent);
//
//    }
//
//    public function testFindUserByUsername()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $userSent = UserFactory::create(UuIdFactory::create(), 'genius', EmailFactory::create('genius@gmail.com'), false, 'genius123');
//
//        $repository->add($userSent);
//
//        $userReceived = $repository->findByUsername('genius');
//        $this->assertTrue($userSent->equals($userReceived));
//
//        $repository->remove($userSent);
//    }
//
//
//    public function testRemoveUser()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $userSent = UserFactory::create(UuIdFactory::create(), 'Paco', EmailFactory::create('paco@gmail.com'), false, 'paco123');
//
//        $repository->add($userSent);
//
//        $user1 = $repository->findByEmail(EmailFactory::create('paco@gmail.com'));
//        $this->assertFalse(empty($user1));
//
//        $repository->remove($userSent);
//
//        $user2 = $repository->findByEmail(EmailFactory::create('paco@gmail.com'));
//        $this->assertTrue(empty($user2));
//    }
//
//    public function testUpdateUser()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        $repository = $app['user_repository'];
//
//        $userSent = UserFactory::create(UuIdFactory::create(), 'Marcos', EmailFactory::create('marcos@gmail.com'), false, 'marcos123');
//
//        $repository->add($userSent);
//
//        $userSent->setPassword('marcos321');
//        $userSent->setUsername('Marcos-Je');
//        $repository->update();
//
//        $userReceived = $repository->findByUsername('Marcos-Je');
//
//        $this->assertTrue($userSent->equals($userReceived));
//
//        $repository->remove($userSent);
//    }
//
//    public function testRepositoryRetrievesUserMasters()
//    {
//        $app = \Malendar\Infrastructure\Ui\Silex\Application::boostrap();
//        /** @var DoctrineUserRepository $repository */
//        $repository = $app['user_repository'];
//
//        $user = UserFactory::create(UuIdFactory::create(), 'Marcos', EmailFactory::create('marcos@gmail.com'), false, 'marcos123');
//        $master1 = MasterFactory::create(UuIdFactory::create(), 'Master Programacion Web', 'MPWAR', 'This master is the coolest', new DateTime('NOW'));
//        $master2 = MasterFactory::create(UuIdFactory::create(), 'Master de Robótica', 'MRSALLE', 'This master is about teaching the fundamentals of robotics', new DateTime('NOW'));
//
//        $user->addMaster($master1);
//        $user->addMaster($master2);
//        $repository->add($user);
//
//        $masters = $repository->findAllRelatedMasters($user->getId());
//        $this->assertEquals($master1, $masters[0]);
//        $this->assertEquals($master2, $masters[1]);
//
//        $repository->remove($user);
//        $repository->removeMaster($master1);
//        $repository->removeMaster($master2);
//    }
//
//}
