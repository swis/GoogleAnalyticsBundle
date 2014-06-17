<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Service;

class TestHandler extends RequestAwareHandler
{

    /** @const FLASHBAG_NAME Used as the session parameter name for the test data flashbag. */
    const FLASHBAG_NAME = 'swis_google_test';

    /** @const COOKIE_PREFIX Used as a name prefix for the test data cookie. */
    const KEY_PREFIX = 'swis_google_test_';

    /** @var array */
    protected $config;

    /**
     * @param array $config The "tests" section of the bundle config array
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getTestVariation($testID)
    {
        if (\is_null($this->session)) {
            return;
        }

        foreach ($this->config as $key => $params) {
            if ($key != $testID) {
                continue;
            }

            /*
             * Try to find out if there was made a decision yet.
             */

            $variation = \intval($this->getTestValue($testID));
            if ($variation >= 0 && $variation <= $params['variants']) {
                $this->getSessionFlashBag()->set($testID, $variation);
                return $variation;
            }

            /*
             * Decide things.
             */

            if ($this->decideParticipation($params['participation'])) {
                // participating in test; roll a dice to choose showed variation
                return $this->setTestValue($testID, $this->decideVariation($params['variants']));
            }
        }

        /*
         * Not participating in test; set showed variation to original
         */
        return $this->setTestValue($testID, 0);
    }

    private function decideParticipation($percentageParticipating)
    {
        /*
         * TODO:
         * Get participation percentage from Google API,
         * see https://developers.google.com/analytics/solutions/experiments-server-side
         */

        \mt_srand();
        return \mt_rand(1, 100) <= $percentageParticipating;
    }

    private function decideVariation($variationCount)
    {
        /*
         * TODO:
         * Use multi-armed bandit to decide (weighted) variation selection,
         * see https://developers.google.com/analytics/solutions/experiments-server-side
         */

        \mt_srand();
        return \mt_rand(1, $variationCount);
    }

    private function setTestValue($testID, $variation)
    {
        $key = self::KEY_PREFIX . $testID;
        $this->session->set($key, $variation);
        $this->getSessionFlashBag()->set($key, $variation);

        return $variation;
    }

    private function getTestValue($testID)
    {
        return $this->session->get(self::KEY_PREFIX . $testID, -1);
    }
}
