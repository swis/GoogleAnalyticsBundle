<?php

namespace Swis\Bundle\GoogleAnalyticsBundle\Events;

class MetricEvent
{

    /** @var string */
    protected $name;

    /** @var mixed */
    protected $value;

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __construct($name, $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @param string $name
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\MetricEvent
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $value
     * @return \Swis\Bundle\GoogleAnalyticsBundle\Events\MetricEvent
     */
    public function setValue($value = null)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
