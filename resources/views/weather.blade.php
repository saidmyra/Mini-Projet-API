<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container { width: 100%; max-width: 480px; }

        .header { text-align: center; margin-bottom: 32px; }
        .header h1 { font-size: 2rem; font-weight: 700; color: #fff; }
        .header p  { color: rgba(255,255,255,0.5); font-size: 0.9rem; margin-top: 4px; }

        .search-box { display: flex; gap: 10px; margin-bottom: 24px; }

        .search-box input {
            flex: 1;
            padding: 14px 20px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.08);
            color: #fff;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            backdrop-filter: blur(10px);
        }
        .search-box input::placeholder { color: rgba(255,255,255,0.35); }

        .search-btn {
            padding: 14px 22px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }
        .search-btn:hover { opacity: 0.9; }

        /* Error */
        .error-box {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 14px;
            padding: 16px 20px;
            color: #fca5a5;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Weather Card */
        .weather-card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 36px 32px;
            backdrop-filter: blur(20px);
            animation: fadeUp 0.4s ease forwards;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .city-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .city-name { font-size: 1.7rem; font-weight: 700; color: #fff; }
        .condition-badge {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.85);
            font-size: 0.78rem;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 30px;
        }

        .divider { height: 1px; background: rgba(255,255,255,0.08); margin: 20px 0; }

        .temp-block { display: flex; align-items: flex-end; gap: 8px; margin-bottom: 28px; }
        .temp-value { font-size: 5rem; font-weight: 700; color: #fff; line-height: 1; }
        .temp-unit  { font-size: 1.8rem; color: rgba(255,255,255,0.6); font-weight: 300; padding-bottom: 10px; }

        .stats-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .stat-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 18px 20px;
        }
        .stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255,255,255,0.45);
            margin-bottom: 8px;
        }
        .stat-value { font-size: 1.4rem; font-weight: 700; color: #fff; }
        .stat-sub   { font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
    </style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>Weather Dashboard</h1>
        <p>Search any city to get current conditions</p>
    </div>

    {{-- Search Form --}}
    <form action="{{ route('weather.search') }}" method="POST">
        @csrf
        <div class="search-box">
            <input
                type="text"
                name="ccity"
                placeholder="Enter city name..."
                value="{{ old('ccity') }}"
                autocomplete="off"
            >
            <button type="submit" class="search-btn">Search</button>
        </div>
    </form>

    {{-- Error message --}}
    @isset($error)
        <div class="error-box">{{ $error }}</div>
    @endisset

    {{-- Weather Result --}}
    @isset($city)
        <div class="weather-card">

            <div class="city-row">
                <div class="city-name">{{ $city }} <span style="font-size : 19px">{{ $country   }}</span></div>
                <div class="condition-badge">{{ $condition }}</div>
            </div>

            <div class="divider"></div>

            <div class="temp-block">
                <div class="temp-value">{{ round($temperature) }}</div>
                <div class="temp-unit">°C</div>
            </div>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-label">Wind Speed</div>
                    <div class="stat-value">{{ $windkmh }}</div>
                    <div class="stat-sub">km/h</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Condition</div>
                    <div class="stat-value" style="font-size: 0.95rem; padding-top: 4px;">{{ $condition }}</div>
                </div>
            </div>

        </div>
    @endisset

</div>

</body>
</html>
