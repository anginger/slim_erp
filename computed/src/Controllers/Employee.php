<?php
declare (strict_types=1);

namespace Slim\Controllers;

use Slim\Kernel\Context;
use Slim\Models\User;

final class Employee
{
    public function getUsers(Context $context): void
    {
        $users = (new User())->all($context->getDatabase());
        $context->getResponse()->setStatus(200)->setBody($users)->sendJSON();
    }

    public function postUser(Context $context): void
    {
        $form = $context->getRequest()->read();
        $user = new User();
        $user
            ->setDisplayName($form["display_name"])
            ->setPassword($form["password"])
            ->setEmail($form["email"])
            ->setPhone($form["phone"])
            ->hashPassword()
            ->create($context->getDatabase());
        $context->getResponse()->setStatus(201)->send();
    }

    public function deleteUser(Context $context): void
    {
        $uuid = $context->getRequest()->getQuery("uuid");
        $user = new User();
        $user->setUuid($uuid)->destroy($context->getDatabase());
        $context->getResponse()->setStatus(204)->send();
    }
}
