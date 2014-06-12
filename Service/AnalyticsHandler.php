<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Service;

/**
 * This service is configured via YAML.
 */
class AnalyticsHandler extends RequestAwareHandler
{

    /** @const FLASHBAG_NAME Used as the session parameter name for the analytics data flashbag. */
    const FLASHBAG_NAME = 'google_analytics';

    /** @const MEASUREMENT_PROTOCOL_URL The HTTP endpoint of the Google Measurment Protocol API. */
    const MEASUREMENT_PROTOCOL_URL = 'http://www.google-analytics.com/collect';

    /**
     * Adds any key-value pair for uploading to Google Analytics via the JavaScript tag.
     *
     * @param string $key   The key of the pair to add.
     * @param mixed  $value The (plain) value of the pair to add.
     */
    public function setAnalyticsValue($key, $value = true)
    {
        if (\is_null($this->request)) {
            return;
        }

        return $this->getSessionFlashBag()->set($key, $value);
    }

    public function addAnalyticsTransaction()
    {
        /* if (!$this->isValidEntry($entry)) {
            return;
        }

        $affiliateID = $entry->getUser()->getAffiliateUser()->getId();
        $transactionID = \sprintf(
            '%s-%s',
            $entry->getContract()->getId(),
            $entry->getId()
        );
        $userID = $entry->getUser()->getAnalyticsClientID();

        $amount = \number_format($entry->getAmountGross(), 2, '.', '');
        $fee = \number_format($entry->getAffiliateFeeNet(), 2, '.', '');
        $vat = \number_format($entry->getAmountGross() - $entry->getAmountNet(), 2, '.', '');

        $this->sendDataViaMeasurementProtocol(
            array(
                'v' => 1,                   // Version.
                'tid' => 'UA-656425-15',    // Tracking ID / Web property / Property ID.
                'cid' => $userID,           // Anonymous Client ID.
                't' => 'transaction',       // Hit Type.

                'ti' => $transactionID,     // Transaction ID. Required.
                'ta' => $affiliateID,       // Transaction affiliation.
                'tr' => $amount,            // Transaction revenue (gross).
                'ts' => $fee,               // Transaction shipping (= Net affiliate fee).
                'tt' => $vat,               // Transaction tax.
                'cu' => 'EUR'               // Currency code.
            )
        ); */
    }

    /**
     * Sends data to Google Analytics via "Measurement Protocol"
     *
     * @param array $data THe payload.
     * @link https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide
     */
    private function sendDataViaMeasurementProtocol($data)
    {
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, self::MEASUREMENT_PROTOCOL_URL);
        \curl_setopt($ch, CURLOPT_HEADER, 0);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        \curl_setopt($ch, CURLOPT_POST, 1);
        \curl_setopt($ch, CURLOPT_POSTFIELDS, \http_build_query($data));
        $result = \curl_exec($ch);
        \curl_close($ch);

        return $result;
    }
    

}
