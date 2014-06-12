

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
