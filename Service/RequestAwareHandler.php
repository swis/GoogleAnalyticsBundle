<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

abstract class RequestAwareHandler
{

    /** @const FLASHBAG_NAME Used as the session parameter name for the analytics event data flashbag. */
    const FLASHBAG_NAME = 'swis_google_analytics';

    /** @var \Symfony\Component\HttpFoundation\Request $request */
    protected $request = null;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function setRequest(Request $request = null)
    {
        $this->request = $request;
    }

    /**
     * Returns a FlashBag object fot storing key value pairs within the current session.
     * The FlashBag with name FLASHBAG_NAME is created if it doen't exist.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Flash\FlashBag
     */
    protected function getSessionFlashBag()
    {
        $session = $this->request->getSession();
        if (!$session->has(static::FLASHBAG_NAME)) {
            $session->set(static::FLASHBAG_NAME, new FlashBag());
        }

        return $session->get(static::FLASHBAG_NAME);
    }
}
