

## Description

This bundle provides comprehensive user tracking with Google Analytics for any Symfony2 project.

Inside this bundle, only the new "Universal Analytics API" (i.e. "analytics.js")
is used for pageview- and event tracking [1]. For the server-to-server (non-JavaScript)
features - especially in the context of ecommerce tracking - the bundles relies
on the "Measurement Protocol API" [2].

[1] https://developers.google.com/analytics/devguides/collection/analyticsjs/

[2] https://developers.google.com/analytics/devguides/collection/protocol/v1/

### Event tracking

Besides the widely known pageview tracking, this bundle also provides an easy way
for pushing custom events to Google via the lightweight JavaScript tracking code.

Event pushing for exceptions and other basic events, like logins and some user actions
provided by the FOSUserBundle (registration, resetting, ...) is already included
in the bundle. Please be aware that the number of events that can be sent is limited
by Google.

See https://developers.google.com/analytics/devguides/collection/analyticsjs/events

### Enhanced link attribution

The code snippet for the enhanced link attribution (```ga('require', 'linkid', 'linkid.js');```)
is included in the JavaScript tag. Please make sure, every link and every button
has a unique id, since this is required for Google to properly track the links.

See https://support.google.com/analytics/answer/2558867

### Custom dimensions and metrics

Coming soon.

See https://developers.google.com/analytics/devguides/collection/analyticsjs/custom-dims-mets

### Support for cross device tracking ("User ID")

Coming soon.

See https://developers.google.com/analytics/devguides/collection/analyticsjs/user-id

### Support for server-side A/B tests

Coming soon.

See https://developers.google.com/analytics/solutions/experiments-server-side

### License

I didn't decide on a license yet, but I'll do eventually.



## Installation

1. Include this bundle as a dependency in your ```composer.json```:

    ```javascript
    {
        ...,
        "require": {
            ...,
            "swis/google-analytics-bundle": "dev-master@dev",
            ...
        },
        ...
    }
    ```
2. Enable the bundle in your ```app/AppKernel.php```:

    ```php
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
3. Provide your Google Analytics Tracking ID somewhere in your ```app/config/config.yml```:

    ```yaml
    swis_google_analytics:
        tracking_id: UA-xxxxxxxx-x # Get this value from your Google Analytics account.
    ```
4. Include the JavaScript code snippet in your template before the closing ```</head>``` tag:

    ```html
    <html>
        <head>
            <!-- ... //-->
            {{ swis_google_analytics() }}
        </head>
        <!-- ... //-->
    </html>
    ```
5. If you want to use the Measurement Protocol features, then you need the clientId
from the Google Analytics tracking cookie. To internally track this clientId, just
include the routes from this bundle and everything else is done automatically when
you then set a userId.
You can change the prefix to whatever you want.

    ```yaml
    swis_google_analytics:
        resource:               "@SwisGoogleAnalyticsBundle/Resources/config/routing.yml"
        prefix:                 /tracking
    ```
5. That's it!



## Usage



## Configuration Reference

```yaml
swis_google_analytics:
    tracking_id:                ~       # The Google Analytics tracking ID (e.g. UA-xxxxxxxx-x). Required.
    domain:                     ~       # If set, the configured host name is sent to Google instead of the really one retrieved from the called URL.
    provide_opt_out:            false   # If set, a javascript function for opting out the Google tracking is provided. The function's name then is googleOptOut().
    site_speed_sample_rate:     100     # Defines the site speed sample rate. See https://developers.google.com/analytics/devguides/collection/analyticsjs/field-reference#siteSpeedSampleRate for details.
    anonymize_ip:               true    # Triggers the IP anonymization for privacy reasons. Required in some countries to be true.
    enable_displayfeatures:     true    # Enables the Google Analytics display features. See https://developers.google.com/analytics/devguides/collection/analyticsjs/display-features for details.
    enable_exceptions:          true    # If set, exceptions are tracked via the JavaScript API. Please make sure, that you include the twig tag into your exception template to have the event connected to the right URL within GA.
    enable_default_events:      true    # If set, default events are tracked via the JavaScript API, see the [DefaultEventsListener](https://github.com/swis/GoogleAnalyticsBundle/blob/master/Listener/DefaultEventsListener.php)
    tests:                              # This section is optional and only if you want to make use of the server-side test features.
        testID1:                        # This name of the following array should be the ID of the test as given by the Google Analytics web site, e.g. Sbz39RY3R5SwOKwKV10OxA.
            participation:      xx      # The percentage of users that should participate on the test, must be between 0 and 100. Required.
            variants:           x       # The number of variants you want to test. The original version should NOT be counted here, that is, for "original vs. variant 1 vs. variant 2" this value should be 2. Required.
        testID2:                        # This name of the following array should be the ID of the test as given by the Google Analytics web site, e.g. Sbz39RY3R5SwOKwKV10OxA.
            participation:      xx      # The percentage of users that should participate on the test, must be between 0 and 100. Required.
            variants:           x       # The number of variants you want to test. The original version should NOT be counted here, that is, for "original vs. variant 1 vs. variant 2" this value should be 2. Required.
        ...
```
