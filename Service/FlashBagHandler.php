<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Service;

use Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent;

class FlashBagHandler extends RequestAwareHandler
{

    /**
     * Adds an event for uploading to Google Analytics via the JavaScript tag.
     *
     * @param \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent $event The event to promote.
     */
    public function addTrackingEvent(TrackingEvent $event)
    {
        if (\is_null($this->request)) {
            return;
        }

        $this->getSessionFlashBag()->add('analytics', $event);
    }
}
