<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Twig;

use Swis\Bundle\GoogleAnalyticsBundle\Service\AnalyticsHandler;
use Swis\Bundle\GoogleAnalyticsBundle\Service\TestHandler;

class GoogleAnalyticsExtension extends \Twig_Extension
{

    protected $environment;
    protected $trackingID;

    /**
     * @param string $trackingID The Google Analytics tracking ID
     */
    public function __construct($trackingID)
    {
        $this->trackingID = $trackingID;
    }

    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('swis_google_analytics', array($this, 'getGoogleAnalyticsTemplate'))
        );
    }

    public function getGoogleAnalyticsTemplate()
    {
        $error = null;
        return $this->environment->render(
            'SwisGoogleAnalyticsBundle::tracking.html.twig',
            array(
                'trackingID' => $this->trackingID,
                'analyticsFlashbagName' => AnalyticsHandler::FLASHBAG_NAME,
                'testFlashbagName' => TestHandler::FLASHBAG_NAME,
                'error' => $error
            )
        );
        return 'Hallo Welt';
    }

    public function getName()
    {
        return 'swis_google_analytics_extension';
    }
}
