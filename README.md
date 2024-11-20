# Laravel PWA Setup(https://github.com/Shubhusingh/pwa-laravel)

This repository demonstrates how to set up a Progressive Web App (PWA) in a Laravel application. Follow the steps below to configure PWA features and enable offline functionality for your Laravel app.

## Prerequisites

Before you begin, ensure you have the following installed:

- [PHP](https://www.php.net/downloads.php) >= 7.3
- [Composer](https://getcomposer.org/download/)
- [Laravel](https://laravel.com/docs/8.x/installation)
- [Node.js](https://nodejs.org/) (for managing assets)
- [NPM](https://www.npmjs.com/) (for managing assets)
- A web server that supports HTTPS (required for PWA)

## Installation

1. **Install Laravel** (if you haven't already)

    First, create a new Laravel application or navigate to an existing Laravel project.

    ```bash
    composer create-project --prefer-dist laravel/laravel laravel-pwa
    cd laravel-pwa
    ```

2. **Install the PWA package**

    Install the Laravel PWA package to easily configure and manage the PWA setup.

    ```bash
    composer require ladumor/laravel-pwa
    ```

3. **Publish the PWA configuration and assets**

    Publish the configuration files for the PWA package:

    ```bash
    php artisan vendor:publish --provider="Ladumor\LaravelPWA\ServiceProvider" --tag="pwa"
    ```

    This will create a `pwa.php` configuration file in the `config` folder.

## Configuration

1. **Configure `pwa.php`**

    Edit the `config/pwa.php` file to customize your app's PWA settings. Define the app name, theme colors, and icons:

    ```php
    return [
        'name' => 'Your App Name',
        'short_name' => 'App',
        'theme_color' => '#FFFFFF',
        'background_color' => '#FFFFFF',
        'icons' => [
            [
                'src' => 'images/icons/icon-192x192.png',
                'sizes' => '192x192',
                'type' => 'image/png',
            ],
            [
                'src' => 'images/icons/icon-512x512.png',
                'sizes' => '512x512',
                'type' => 'image/png',
            ],
        ],
    ];
    ```

2. **Manifest Configuration**

    Add the link to the PWA manifest file and meta tags for theme color in your main layout file (`resources/views/layouts/app.blade.php` or wherever your `<head>` section is defined):

    ```html
    <head>
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta name="theme-color" content="{{ config('pwa.theme_color') }}">
    </head>
    ```

3. **Service Worker Setup**

    The `laravel/pwa` package will automatically generate a `service-worker.js` file in the `public/` directory. You can modify this file to suit your app’s needs, such as caching specific resources or enabling background sync.

    Ensure that the `service-worker.js` exists in the `public/` directory. It will be responsible for enabling offline functionality and caching assets.

4. **SSL Configuration**

    PWA requires that your app runs over HTTPS, especially for features like Service Workers.

    - For local development, run the Laravel app with HTTPS:

      ```bash
      php artisan serve --host=127.0.0.1 --port=8000 --secure
      ```

    - For production, make sure your web server (Apache, Nginx, etc.) is configured with SSL certificates.

## Testing PWA Features

After setting up the PWA features:

1. **Test Service Worker Registration**
    - Open the app in a browser and navigate to Developer Tools > Application > Service Workers.
    - Ensure that the service worker is correctly registered.

2. **Test Offline Mode**
    - Disconnect from the internet and try accessing your app to see if it still works offline.
    - You can simulate this using the browser's DevTools.

3. **Test Installability**
    - When visiting the app on a supported device (like Chrome or Edge), check if you get a prompt to "Add to Home Screen."
    - You can also manually trigger the install prompt if the `beforeinstallprompt` event is fired.

## Build for Production

Before deploying to production, ensure that:

1. You have updated the `manifest.json` for production assets.
2. Test your PWA features thoroughly, especially offline behavior.
3. Minify and cache assets for optimal performance.

## Contributing

If you would like to contribute to this repository, feel free to submit issues and pull requests. We welcome improvements to the PWA setup or other features.

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add your feature'`).
4. Push to your branch (`git push origin feature/your-feature`).
5. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgements

This project uses the following libraries:

- [Laravel](https://laravel.com)
- [Laravel PWA Package](https://github.com/ladumor/laravel-pwa)

---

This template provides a comprehensive guide for setting up a PWA in a Laravel application. Feel free to modify and expand it based on your project’s specific requirements.
