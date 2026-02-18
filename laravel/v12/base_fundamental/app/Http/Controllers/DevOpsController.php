<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DevOpsController extends Controller
{
    public function index()
    {
        return view('ejemplos.devops.index');
    }

    public function docker()
    {
        return view('ejemplos.devops.docker');
    }

    public function cicd()
    {
        return view('ejemplos.devops.cicd');
    }

    public function git()
    {
        return view('ejemplos.devops.git');
    }

    public function deploy()
    {
        return view('ejemplos.devops.deploy');
    }

    public function logs()
    {
        // Ejemplos de logs
        Log::info('Información general');
        Log::warning('Advertencia');
        Log::error('Error crítico', ['user_id' => 1]);
        
        return view('ejemplos.devops.logs');
    }

    public function monitoreo()
    {
        return view('ejemplos.devops.monitoreo');
    }
}
