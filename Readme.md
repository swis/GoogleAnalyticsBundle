

1. Include the dependency in your ```composer.json```:
    ```
    {
        "require": {
            ...
            "swis/google-analytics-bundle": "1.0.*@dev",
        },
        ...
    }

    ```
2. Enable the Bundle in your ```AppKernel.php```:
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
