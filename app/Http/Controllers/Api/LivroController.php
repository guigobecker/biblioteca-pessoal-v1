<?php

namespace App\Http\Controllers\Api;

use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LivroController extends Controller
{
    public function index() {
        $livros = Livro::all();

        if ($livros->count() > 0) {
            $dados = [
                'status' => 200,
                'livros' => $livros
            ];
    
            return response()->json($dados, 200);
        }

        else {
            $dados = [
                'status' => 404,
                'mensagem' => 'Nenhum livro encontrado.'
            ];
    
            return response()->json($dados, 404);
        }

    }
}
