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
            if ($variation >= 0 && $variation < \count($params['distribution'])) {
                $this->getSessionFlashBag()->set($testID, $variation);
                return $variation;
            }

            /*
             * Participating in test. Roll a dice to choose variation.
             */

            return $this->setTestValue($testID, $this->decideVariation($params['distribution']));
        }

        /*
         * Not participating in test; set showed variation to original
         */

        return $this->setTestValue($testID, 0);
    }

    private function decideVariation($distribution)
    {
        /*
         * TODO:
         * Use multi-armed bandit to decide (weighted) variation selection,
         * see https://developers.google.com/analytics/solutions/experiments-server-side
         */

        \mt_srand();
        $rnd = \mt_rand(0, 1);

        $sum = .0;
        foreach ($distribution as $key => $percentage) {
            $sum += $percentage;
            if ($rnd < $sum) {
                return \intval($key);
            }
        }

        return 0;
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
