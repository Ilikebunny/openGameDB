<?php

//src/AppBundle/Repository/UsersRepository

namespace AppBundle\Repository; 

use ED\BlogBundle\Interfaces\Repository\BlogUserRepositoryInterface;
use ED\BlogBundle\Model\Repository\UserRepository as BaseUserRepository;

class UsersRepository extends BaseUserRepository implements BlogUserRepositoryInterface
{
}