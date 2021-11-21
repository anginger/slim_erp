<?php

namespace Slim\Controllers;

use Slim\Kernel\Context;
use Slim\Models\User;

final class Authentic implements ControllerInterface
{
    public function getSession(Context $context): void
    {
    }

    public function postSession(Context $context): void
    {
        $form = $context->getRequest()->read();
        $user = new User();
        $user->setUsername($form['username'])->setPassword($form['password']);
        $context->getResponse()->setStatus(201)->send();
    }

    public function deleteSession(Context $context): void
    {

    }
}
