<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelefonesController extends Controller
{
    
    public function store(\App\Telefone $telefone) {
        
        // Salvamos o telefone
        $telefone->save();

    }

}
