<?php
declare (strict_types=1);

namespace Gle\Controllers;

use Gle\Kernel\Context;

final class Employee
{
    public function getUsers(Context $context): void
    {
        $users = \Gle\Models\User::all();
        $context->getResponse()->setStatus(200)->sendJSON($users);
    }

    public function postUser(Context $context): void
    {
        $form = $context->getRequest()->read();
        $user = new \Gle\Models\User();
        $user
            ->setDisplayName($form["display_name"])
            ->setPassword($form["password"])
            ->setEmail($form["email"])
            ->setPhone($form["phone"])
            ->hashPassword()
            ->create();
        $context->getResponse()->setStatus(201)->send();
    }

    public function deleteUser(Context $context): void
    {
        $uuid = $context->getRequest()->getQuery("uuid");
        $user = new \Gle\Models\User();
        $user->setUuid($uuid)->destroy();
        $context->getResponse()->setStatus(204)->send();
    }
}
