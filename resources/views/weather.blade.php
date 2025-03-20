<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather - {{ $city }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .weather-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
        }
        .weather-icon {
            width: 100px;
            height: 100px;
        }
        .temperature {
            font-size: 3rem;
            font-weight: bold;
        }
        .weather-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="weather-container">
        <div class="text-center">
            <h1 class="mb-4">{{ ucfirst($city) }}</h1>
            <img src="http://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" 
                 alt="Weather Icon" 
                 class="weather-icon mb-3">
            
            <div class="temperature">
                {{ round($weather['main']['temp']) }}°C
            </div>
            
            <div class="description text-muted mb-4">
                {{ ucfirst($weather['weather'][0]['description']) }}
            </div>

            <div class="weather-details">
                <div class="detail-item">
                    <div class="text-muted">Humidity</div>
                    <div class="fw-bold">{{ $weather['main']['humidity'] }}%</div>
                </div>
                <div class="detail-item">
                    <div class="text-muted">Wind Speed</div>
                    <div class="fw-bold">{{ round($weather['wind']['speed']) }} m/s</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>