<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\Producto;

class SeguridadController extends Controller
{
    public function index()
    {
        return view('ejemplos.seguridad.index');
    }

    public function csrf()
    {
        return view('ejemplos.seguridad.csrf');
    }

    public function xss()
    {
        $ejemploMalo = '<script>alert("XSS")</script>';
        $ejemploBueno = htmlspecialchars($ejemploMalo);
        
        return view('ejemplos.seguridad.xss', compact('ejemploMalo', 'ejemploBueno'));
    }

    public function sqlInjection()
    {
        return view('ejemplos.seguridad.sql-injection');
    }

    public function massAssignment()
    {
        return view('ejemplos.seguridad.mass-assignment');
    }

    public function hashing()
    {
        $password = 'mi-password-secreto';
        $hashed = Hash::make($password);
        $verificado = Hash::check($password, $hashed);
        
        return view('ejemplos.seguridad.hashing', compact('password', 'hashed', 'verificado'));
    }

    public function encriptacion()
    {
        $texto = 'Información sensible';
        $encriptado = Crypt::encryptString($texto);
        $desencriptado = Crypt::decryptString($encriptado);
        
        return view('ejemplos.seguridad.encriptacion', compact('texto', 'encriptado', 'desencriptado'));
    }

    public function rateLimiting(Request $request)
    {
        $key = 'ejemplo-rate-limit:' . $request->ip();
        $maxAttempts = 5;
        $decayMinutes = 1;
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return view('ejemplos.seguridad.rate-limiting', [
                'bloqueado' => true,
                'segundos' => $seconds,
                'intentos' => RateLimiter::attempts($key)
            ]);
        }
        
        RateLimiter::hit($key, $decayMinutes * 60);
        
        return view('ejemplos.seguridad.rate-limiting', [
            'bloqueado' => false,
            'intentos' => RateLimiter::attempts($key),
            'maxAttempts' => $maxAttempts
        ]);
    }

    public function validaciones()
    {
        return view('ejemplos.seguridad.validaciones');
    }

    public function storage()
    {
        return view('ejemplos.seguridad.storage');
    }
}
