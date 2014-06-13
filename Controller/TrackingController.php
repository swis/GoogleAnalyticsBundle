<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TrackingController extends Controller
{

    /**
     * @Route(
     *     "/add-client-id/{userID}/{clientID}",
     *     name     = "swis_google_analytics.add_client_id",
     *     defaults = { "clientID" = "" }
     * )
     */
    public function addClientIdAction($userID, $clientID)
    {
        $this->get('swis_google_analytics.analytics_handler')->persistClientID($userID, $clientID);

        return new Response();
    }
}
