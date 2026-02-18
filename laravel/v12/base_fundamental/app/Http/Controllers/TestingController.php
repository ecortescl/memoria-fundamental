<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

/**
 * Controller para ejemplos de Testing
 * 
 * Muestra ejemplos educativos de:
 * - PHPUnit vs Pest
 * - Feature Tests
 * - Unit Tests
 * - Mocking
 * - Testing de Jobs, Events, APIs
 */
class TestingController extends Controller
{
    /**
     * Página principal de testing
     */
    public function index()
    {
        return view('ejemplos.testing.index');
    }

    /**
     * Introducción a testing
     */
    public function introduccion()
    {
        return view('ejemplos.testing.introduccion');
    }

    /**
     * PHPUnit vs Pest
     */
    public function phpunitVsPest()
    {
        return view('ejemplos.testing.phpunit-vs-pest');
    }

    /**
     * Feature Tests
     */
    public function featureTests()
    {
        $productos = Producto::limit(3)->get();
        return view('ejemplos.testing.feature-tests', compact('productos'));
    }

    /**
     * Unit Tests
     */
    public function unitTests()
    {
        return view('ejemplos.testing.unit-tests');
    }

    /**
     * Mocking
     */
    public function mocking()
    {
        return view('ejemplos.testing.mocking');
    }

    /**
     * Testing de Jobs
     */
    public function jobs()
    {
        return view('ejemplos.testing.jobs');
    }

    /**
     * Testing de Events
     */
    public function events()
    {
        return view('ejemplos.testing.events');
    }

    /**
     * Testing de APIs
     */
    public function apis()
    {
        return view('ejemplos.testing.apis');
    }

    /**
     * TDD (Test-Driven Development)
     */
    public function tdd()
    {
        return view('ejemplos.testing.tdd');
    }

    /**
     * Cobertura de código
     */
    public function cobertura()
    {
        return view('ejemplos.testing.cobertura');
    }
}
