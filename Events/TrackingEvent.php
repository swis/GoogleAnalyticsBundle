<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Events;

class TrackingEvent
{

    /** @var string */
    protected $category;

    /** @var string */
    protected $action;

    /** @var string */
    protected $label;

    /** @var float */
    protected $value;

    /**
     * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/events
     *
     * @param string $category
     * @param string $action
     * @param string $label
     * @param float $value
     */
    public function __construct($category, $action, $label = null, $value = null)
    {
        $this->setCategory($category);
        $this->setAction($action);
        $this->setLabel($label);
        $this->setValue($value);
    }

    /**
     * @param string $action
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $category
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $label
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent
     */
    public function setLabel($label = null)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param float $value
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\TrackingEvent
     */
    public function setValue($value = null)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
