<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Storage Seguro</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; background: #f9fafb; color: #1f2937; line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 32px; font-weight: 600; color: #FF2D20; margin-bottom: 24px; }
        h2 { font-size: 24px; font-weight: 600; margin: 32px 0 16px; }
        .card { background: #fff; padding: 24px; border-radius: 4px; border: 1px solid #e5e7eb; margin-bottom: 24px; }
        .alert { background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; margin-bottom: 24px; border-radius: 4px; }
        pre { background: #1f2937; color: #f9fafb; padding: 16px; border-radius: 4px; overflow-x: auto; margin: 16px 0; }
        .back { display: inline-block; color: #FF2D20; text-decoration: none; margin-bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/ejemplos/seguridad" class="back">← Volver</a>
        
        <h1>💾 Storage Seguro</h1>

        <div class="alert">
            <strong>⚠️ Riesgos:</strong> Archivos maliciosos, path traversal, acceso no autorizado, ejecución de código.
        </div>

        <div class="card">
            <h2>✅ Subir archivos de forma segura</h2>
            <pre><code>public function upload(Request $request)
{
    $request->validate([
        'archivo' => 'required|file|mimes:pdf,jpg,png|max:10240'
    ]);
    
    // Guardar con nombre aleatorio
    $path = $request->file('archivo')->store('documentos', 'private');
    
    // O con nombre personalizado
    $nombre = Str::random(40) . '.' . $request->file('archivo')->extension();
    $path = $request->file('archivo')->storeAs('documentos', $nombre, 'private');
    
    return $path;
}</code></pre>
        </div>

        <div class="card">
            <h2>🔒 Archivos privados</h2>
            <pre><code>// Guardar en storage/app/private
Storage::disk('private')->put('documentos/archivo.pdf', $contenido);

// Descargar con autorización
public function download($id)
{
    $documento = Documento::findOrFail($id);
    
    // Verificar autorización
    if (auth()->user()->cannot('view', $documento)) {
        abort(403);
    }
    
    return Storage::disk('private')->download($documento->path);
}</code></pre>
        </div>

        <div class="card">
            <h2>🔧 URLs temporales (S3)</h2>
            <pre><code>// Generar URL temporal (expira en 5 minutos)
$url = Storage::disk('s3')->temporaryUrl(
    'documentos/archivo.pdf',
    now()->addMinutes(5)
);

// Con headers personalizados
$url = Storage::disk('s3')->temporaryUrl(
    'documentos/archivo.pdf',
    now()->addMinutes(5),
    ['ResponseContentType' => 'application/pdf']
);</code></pre>
        </div>

        <div class="card">
            <h2>❌ Vulnerabilidades comunes</h2>
            <pre><code>// ❌ Path traversal
$file = $request->input('file');  // "../../../etc/passwd"
$content = file_get_contents(storage_path($file));  // PELIGROSO

// ✅ Validar y sanitizar
$file = basename($request->input('file'));  // Elimina directorios
$path = storage_path('app/documentos/' . $file);

if (!file_exists($path) || !Str::startsWith($path, storage_path('app/documentos'))) {
    abort(404);
}

// ❌ Confiar en la extensión del cliente
$ext = $request->file('archivo')->getClientOriginalExtension();

// ✅ Detectar tipo MIME real
$ext = $request->file('archivo')->extension();
$mime = $request->file('archivo')->getMimeType();</code></pre>
        </div>

        <div class="card">
            <h2>🔧 Configuración segura</h2>
            <pre><code>// config/filesystems.php
'disks' => [
    'private' => [
        'driver' => 'local',
        'root' => storage_path('app/private'),
        'visibility' => 'private',  // No accesible por web
    ],
    
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
];</code></pre>
        </div>
    </div>
</body>
</html>
