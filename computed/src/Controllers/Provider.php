<?php

namespace Slim\Controllers;

use Slim\Kernel\Context;
use Slim\Models\Provider as ProviderModel;
use Slim\Models\User;

final class Provider implements ControllerInterface
{
    public function getAll(Context $context): void
    {
        if (!($context->getState()->get("user") instanceof User)) {
            $context->getResponse()->setStatus(403)->setBody(["message" => "forbidden"])->sendJSON();
            return;
        }
        $products = (new ProviderModel())->batch($context->getDatabase());
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
        $product = (new ProviderModel())->load($context->getDatabase(), $uuid);
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
        if (
            !isset($form['display_name']) ||
            !isset($form["contact_name"]) ||
            !isset($form['contact_phone']) ||
            !isset($form["contact_address"])
        ) {
            $context->getResponse()->setStatus(400)->setBody(["message" => "bad request"])->sendJSON();
            return;
        }
        $product = new ProviderModel();
        $product
            ->setDisplayName($form['display_name'])
            ->setContactName($form["contact_name"])
            ->setContactPhone($form['contact_phone'])
            ->setContactAddress($form["contact_address"])
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
        (new ProviderModel())->setId($id)->destroy($context->getDatabase());
        $context->getResponse()->setStatus(204)->send();
    }
}
