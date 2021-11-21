<?php

namespace Slim\Controllers;

use Slim\Kernel\Context;
use Slim\Models\Level as LevelModel;
use Slim\Models\User;

final class Level implements ControllerInterface
{
    public function getAll(Context $context): void
    {
        if (!($context->getState()->get("user") instanceof User)) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "forbidden"])->sendJSON();
            return;
        }
        $products = (new LevelModel())->batch($context->getDatabase());
        $context->getResponse()->setBody($products)->sendJSON();
    }

    public function getOne(Context $context): void
    {
        if (!($context->getState()->get("user") instanceof User)) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "forbidden"])->sendJSON();
            return;
        }
        if (empty($uuid = $context->getRequest()->getQuery("uuid"))) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "bad request"])->sendJSON();
            return;
        }
        $product = (new LevelModel())->load($context->getDatabase(), $uuid);
        if ($product->checkReady()) {
            $context->getResponse()->setBody($product)->sendJSON();
        } else {
            $context->getResponse()->setStatus(404)->setBody(["message" => "not found"])->sendJSON();
        }
    }

    public function postOne(Context $context): void
    {
        if (!($context->getState()->get("user") instanceof User)) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "forbidden"])->sendJSON();
            return;
        }
        $form = $context->getRequest()->read();
        if (!isset($form['display_name'])) {
            $context->getResponse()->setStatus(400)->setBody(["message" => "bad request"])->sendJSON();
            return;
        }
        $product = new LevelModel();
        $product
            ->setDisplayName($form['display_name'])
            ->create($context->getDatabase());
        if ($product->reload($context->getDatabase())->checkReady()) {
            $context->getResponse()->setStatus(201)->send();
        } else {
            $context->getResponse()->setStatus(500)->setBody(["message" => "internal server error"])->sendJSON();
        }
    }

    public function deleteOne(Context $context): void
    {
        if (!($context->getState()->get("user") instanceof User)) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "forbidden"])->sendJSON();
            return;
        }
        if (empty($id = $context->getRequest()->getQuery("id"))) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "bad request"])->sendJSON();
            return;
        }
        (new LevelModel())->setId($id)->destroy($context->getDatabase());
        $context->getResponse()->setStatus(204)->sendJSON();
    }
}
