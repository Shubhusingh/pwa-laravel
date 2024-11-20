<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#007bff">
    <link rel="manifest" href="/manifest.json">
    <title>Laravel PWA</title>
    <style>
        /* General styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f4f8;
            color: #333;
            text-align: center;
        }
    
        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 20px;
        }
    
        p {
            font-size: 1.1em;
            margin: 20px auto;
            max-width: 600px;
            line-height: 1.6;
            color: #555;
        }
    
        .btn {
            padding: 15px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 30px;
        }
    
        .btn:hover {
            background-color: #0056b3;
        }
    
        .container {
            padding: 50px 20px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
            text-align: center;
        }
    
        .status {
            margin-top: 20px;
            font-size: 1.2em;
            color: green;
            font-weight: bold;
        }
    
        /* Add card style for information section */
        .info-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
            flex-wrap: wrap;
        }
    
        .info-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            width: 250px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
    
        .info-card:hover {
            transform: translateY(-10px);
        }
    
        .info-card i {
            font-size: 50px;
            color: #007bff;
        }
    
        .info-card h3 {
            font-size: 1.5em;
            margin-top: 20px;
            color: #333;
        }
    
        .info-card p {
            font-size: 1em;
            margin-top: 10px;
            color: #555;
        }
    
        /* Animation for the install button */
        @keyframes fadeInButton {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        /* Responsive design */
        @media (max-width: 768px) {
            .info-cards {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; margin-top: 50px; background-color:#a9a44a">
    <div class="container">
        <h1>Welcome to Laravel PWA</h1>
        <p>This is a sample Progressive Web App (PWA) setup using Laravel. Install the app on your device to enjoy fast, offline, and native-like experiences!</p>
    </div>
    <button id="installButton" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; display: none;     margin-top: 18px;
    margin-left: 45%;">
        Install App
    </button>
    <div class="info-cards">
        {{-- <div class="info-card">
            <i class="fas fa-cloud-download-alt"></i>
            <h3>Install Offline</h3>
            <p>Install this app on your device for offline access. Enjoy uninterrupted functionality even without internet access.</p>
        </div> --}}
        <div class="info-card">
            <i class="fas fa-bolt"></i>
            <h3>Fast Performance</h3>
            <p>PWAs load faster and offer a seamless user experience. Your app performs like a native app on your device.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-mobile-alt"></i>
            <h3>Responsive</h3>
            <p>PWAs are fully responsive, meaning your app looks great on any device—mobile, tablet, or desktop.</p>
        </div>
    </div>
   

    <p id="status" style="margin-top: 20px; color: green;"></p>
    <script>
        let deferredPrompt;
        const installButton = document.getElementById('installButton');
        const status = document.getElementById('status');
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
                .then((registration) => {
                    console.log('Service Worker registered with scope:', registration.scope);
                    status.textContent = 'Service Worker registered successfully!';
                })
                .catch((error) => {
                    console.error('Service Worker registration failed:', error);
                    status.textContent = 'Service Worker registration failed.';
                });
        }
        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('beforeinstallprompt event fired');
            e.preventDefault(); 
            deferredPrompt = e;
            installButton.style.display = 'block'; 
        });

        
        installButton.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt(); 
                const { outcome } = await deferredPrompt.userChoice; 
                console.log(`User response to the install prompt: ${outcome}`);
                if (outcome === 'accepted') {
                    console.log('App installed successfully');
                    status.textContent = 'App installed successfully!';
                } else {
                    console.log('App installation dismissed');
                    status.textContent = 'App installation dismissed.';
                }
                deferredPrompt = null;
                installButton.style.display = 'none';
            }
        });
    </script>
</body>
</html>




</head>
<body>

