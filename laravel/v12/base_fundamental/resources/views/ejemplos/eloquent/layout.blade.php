<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Eloquent Avanzado</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        h1 { font-size: 36px; font-weight: 600; color: #FF2D20; margin-bottom: 12px; }
        h2 { font-size: 24px; font-weight: 600; color: #1f2937; margin: 32px 0 16px; }
        h3 { font-size: 18px; font-weight: 600; color: #374151; margin: 24px 0 12px; }
        .subtitle { font-size: 18px; color: #6b7280; margin-bottom: 32px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        code { background: #f3f4f6; padding: 2px 6px; border-radius: 3px; font-size: 14px; color: #FF2D20; font-family: 'Courier New', monospace; }
        pre { background: #1f2937; color: #f9fafb; padding: 20px; border-radius: 4px; overflow-x: auto; margin: 16px 0; font-size: 14px; line-height: 1.5; }
        pre code { background: none; color: inherit; padding: 0; }
        a { color: #FF2D20; text-decoration: none; font-weight: 500; }
        a:hover { text-decoration: underline; }
        table { width: 100%; border-collapse: collapse; margin: 16px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; }
        ul { margin: 16px 0; padding-left: 24px; }
        li { margin: 8px 0; }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
        <div style="margin-top: 40px;">
            <a href="/ejemplos/eloquent">← Volver a Eloquent Avanzado</a>
        </div>
    </div>
</body>
</html>
