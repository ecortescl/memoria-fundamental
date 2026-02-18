<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionesController extends Controller
{
    // Ejemplo 1: Función privada simple
    private function saludar($nombre)
    {
        return "Hola, {$nombre}!";
    }
    
    // Ejemplo 2: Función con múltiples parámetros
    private function calcularTotal($precio, $cantidad, $descuento = 0)
    {
        $subtotal = $precio * $cantidad;
        $total = $subtotal - ($subtotal * $descuento / 100);
        return $total;
    }
    
    // Ejemplo 3: Función que retorna array
    private function obtenerEstadisticas()
    {
        return [
            'usuarios' => 150,
            'productos' => 45,
            'ventas' => 1200
        ];
    }
    
    public function index()
    {
        $saludo = $this->saludar('Carlos');
        $total = $this->calcularTotal(100, 3, 10);
        $estadisticas = $this->obtenerEstadisticas();
        
        return view('ejemplos.funciones.index', compact('saludo', 'total', 'estadisticas'));
    }
}
