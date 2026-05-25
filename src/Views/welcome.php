<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= \App\Core\View::e($title ?? 'Welcome') ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8fafc;
            color: #334155;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #0f172a;
        }
        p {
            font-size: 1.125rem;
            line-height: 1.75;
            margin-bottom: 2rem;
        }
        .links a {
            display: inline-block;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem;
            color: #3b82f6;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .links a:hover {
            background-color: #eff6ff;
            color: #2563eb;
        }
        .version {
            margin-top: 3rem;
            font-size: 0.875rem;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vanilla Framework</h1>
        <p>You have successfully installed the Vanilla PHP Framework. It's fast, simple, and ready for your next big idea.</p>
        <div class="links">
            <a href="/login">Login</a>
            <a href="https://github.com" target="_blank">Documentation</a>
            <a href="https://github.com" target="_blank">GitHub</a>
        </div>
        <div class="version">
            Vanilla Framework v1.0.0 (PHP <?= PHP_VERSION ?>)
        </div>
    </div>
</body>
</html>
