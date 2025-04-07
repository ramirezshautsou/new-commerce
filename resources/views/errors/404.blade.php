    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 — Не туда попал</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #0d1117;
            color: #c9d1d9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            margin-bottom: 0;
            color: #f85149;
        }

        p {
            font-size: 1.5rem;
            margin-top: 0.5rem;
        }

        a {
            margin-top: 2rem;
            display: inline-block;
            padding: 12px 24px;
            background: #238636;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        a:hover {
            background: #2ea043;
        }

        .emoji {
            font-size: 3rem;
        }
    </style>
</head>
<body>
<div>
    <div class="emoji">🕵️‍♂️</div>
    <h1>404</h1>
    <p>Похоже, ты заблудился. Такой страницы нет.</p>
    <a href="{{ url('/') }}">На главную</a>
</div>
</body>
</html>
