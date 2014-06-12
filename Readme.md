
## Installation

1. Include the dependency in your ```composer.json```:
    ```
    {
        ...,
        "require": {
            ...,
            "swis/google-analytics-bundle": "1.0.*@dev",
            ...
        },
        ...
    }
    ```
2. Enable the Bundle in your ```app/AppKernel.php```:
    ```
    class AppKernel extends Kernel
    {

        public function registerBundles()
        {
            $bundles = array(
                /* ... */

                new Swis\Bundle\GoogleAnalyticsBundle\SwisGoogleAnalyticsBundle(),

                /* ... */
            );
            /* ... */
        }
        /* ... */
    }
    ```
3. Provide your Google Analytics Tracking ID somwhere in your ```app/config/config.yml```
    ```
    swis_google_analytics:
        tracking_id: UA-xxxxxxxx-x
    ```


## Configuration Reference
```
swis_google_analytics:
    tracking_id:                ~       # The Google Analytics tracking ID (e.g. UA-xxxxxxxx-x). Required.
    domain:                     ~       # If set, the configured host name is sent to Google instead of the really one retrieved from the called URL.
    provide_opt_out:            false   # If set, a javascript function for opting out the Google tracking is provided. The function's name then is googleOptOut().
    site_speed_sample_rate:     100     # Defines the site speed sample rate. See https://developers.google.com/analytics/devguides/collection/analyticsjs/field-reference#siteSpeedSampleRate for details.
    options:
        anonymize_ip:           true    # Triggers the IP anonymization for privacy reasons. Required in some countries to be true.
        enable_displayfeatures: true    # Enables the Google Analytics display features. See https://developers.google.com/analytics/devguides/collection/analyticsjs/display-features for details.
```
