<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Service;

use Swis\Bundle\GoogleAnalyticsBundle\Events\MetricEvent;
use Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent;

class AnalyticsHandler extends RequestAwareHandler
{

    /** @const FLASHBAG_NAME Used as the session parameter name for the analytics event data flashbag. */
    const FLASHBAG_NAME = 'swis_google_analytics';

    /**
     * Adds an event for uploading to Google Analytics via the JavaScript tag.
     *
     * @param \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent $event The event to promote.
     */
    public function addTrackingEvent(TrackingEvent $event)
    {
        if (\is_null($this->session)) {
            return;
        }

        $this->getSessionFlashBag()->add('analytics', $event);
    }

    /**
     * Adds an event for uploading to Google Analytics via the JavaScript tag.
     *
     * @param \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent $event The event to promote.
     */
    public function addMetricEvent(MetricEvent $event)
    {
        if (\is_null($this->session)) {
            return;
        }

        $this->getSessionFlashBag()->add('metrics', $event);
    }

    public function persistClientID($userID, $clientID)
    {
        // TODO
    }
}
