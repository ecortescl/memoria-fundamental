<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariablesController extends Controller
{
    // Ejemplo 1: Variables básicas
    public function basicas()
    {
        $nombre = "Juan";
        $edad = 25;
        $precio = 99.99;
        $activo = true;
        
        return view('ejemplos.variables.basicas', compact('nombre', 'edad', 'precio', 'activo'));
    }
    
    // Ejemplo 2: Arrays
    public function arrays()
    {
        $frutas = ['Manzana', 'Banana', 'Naranja'];
        $persona = [
            'nombre' => 'María',
            'edad' => 30,
            'ciudad' => 'Madrid'
        ];
        
        return view('ejemplos.variables.arrays', compact('frutas', 'persona'));
    }
    
    // Ejemplo 3: Variables desde Request
    public function desdeRequest(Request $request)
    {
        $nombre = $request->input('nombre', 'Invitado');
        $email = $request->query('email', 'no@email.com');
        
        return view('ejemplos.variables.request', compact('nombre', 'email'));
    }
}
