<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'motivo' => 'required|string',
            'mensagem' => 'required|string',
        ]);

        $content = "Nome: {$validated['name']}\nEmail: {$validated['email']}\nMotivo: {$validated['motivo']}\nMensagem: {$validated['mensagem']}\n\n";

        $filePath = storage_path('app/public/dados_formulario.txt');

        file_put_contents($filePath, $content, FILE_APPEND);

        return response()->json(['message' => 'Dados salvos com sucesso!']);
    }
}
