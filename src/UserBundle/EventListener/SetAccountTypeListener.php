<?php

namespace UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SetAccountTypeListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onRegisterSuccess',
        );
    }

    public function onRegisterSuccess(GetResponseUserEvent $event)
    {
        $data = $event->getRequest()->request->get('fos_user_registration_form');
        $user = $event->getUser();

        if (isset($data['manager'])) {
            $user->setRoles(array('ROLE_MANAGER'));
        }
        else {
            $user->setRoles(array('ROLE_STUDENT'));
        }
    }
}
