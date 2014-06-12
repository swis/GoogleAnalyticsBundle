<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent;
use Swis\Bundle\GoogleAnalyticsBundle\Service\FlashBagHandler;

class EventListener
{

    /* @var $handler \Swis\Bundle\GoogleAnalyticsBundle\Service\FlashBagHandler */
    protected $handler;

    /**
     * @param \Swis\Bundle\GoogleAnalyticsBundle\Service\FlashBagHandler $handler
     */
    public function __construct(FlashBagHandler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * Dispatches tracking of interactive ser logins.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function onSecurityInteractiveLogin(Event $event)
    {
        $this->handler->addTrackingEvent(new TrackingEvent('accounts', 'login', 'interactive'));
    }

    /**
     * Dispatches tracking of implicit user logins.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function onSecurityImplicitLogin(Event $event)
    {
        $this->handler->addTrackingEvent(new TrackingEvent('accounts', 'login', 'implicit'));
    }

    /**
     * Dispatches tracking of FOSUB registration confirmation.
     * Event occurs after confirming the account via the email link.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function onRegistrationConfirmed(Event $event)
    {
        $this->handler->addTrackingEvent(new TrackingEvent('accounts', 'registration', 'confirmed'));
    }

    /**
     * @JmsDi\Observe("fos_user.registration.completed")
     *
     * Dispatches tracking of registration completion.
     * Event occurs after saving the user in the registration process.
     *
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function onRegistrationCompleted(Event $event)
    {
        $this->handler->addTrackingEvent(new TrackingEvent('accounts', 'registration', 'completed'));
    }

    /**
     * Dispatches tracking of symfony exceptions.
     *
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $status = $event->getResponse() != null ? $event->getResponse()->getStatusCode() : null;
        if (\is_null($status)) {
            $status = -1;
        }

        $msg = $event->getException() != null ? \substr($event->getException()->getMessage(), 0, 16) : '';
        if (empty($msg)) {
            $msg = 'unknown';
        }

        $this->handler->addTrackingEvent(new TrackingEvent('exception', $status, $msg));
    }
}
