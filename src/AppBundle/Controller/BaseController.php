<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseController extends Controller
{
    protected function setFlash($type, $message)
    {
        return $this->get('request')->getSession()->getFlashBag()->add($type, $message);
    }

    protected function getPaginator()
    {
        return $this->get('knp_paginator');
    }
}
