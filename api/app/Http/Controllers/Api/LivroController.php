<?php

namespace App\Http\Controllers\Api;

use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LivroController extends Controller
{
    public function index() {
        $livros = Livro::all();

        if($livros->count() > 0) {
            return response()->json([
                'status' => 200,
                'livros' => $livros
            ], 200);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => 'Nenhum livro encontrado.'
            ], 404);
        }

    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:191',
            'autor' => 'required|string|max:191',
            'classificacao' => 'required|digits:1',
            'resenha' => 'required|max:1000'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        else {
            $livro = Livro::create([
                'titulo' => $request->titulo,
                'autor' => $request->autor,
                'classificacao' => $request->classificacao,
                'resenha' => $request->resenha
            ]);

            if($livro) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Livro adicionado com sucesso.' 
                ], 200);
            }

            else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Algo deu errado.' 
                ], 500);
            }
        }
    }

    public function show($id) {
        $livro = Livro::find($id);

        if($livro) {
            return response()->json([
                'status' => 200,
                'livro' => $livro 
            ], 200);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => 'Livro não encontrado.' 
            ], 404);            
        }
    }

    public function edit($id) {
        $livro = Livro::find($id);

        if($livro) {
            return response()->json([
                'status' => 200,
                'livro' => $livro 
            ], 200);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => 'Livro não encontrado.' 
            ], 404);            
        }        
    }

    public function update(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:191',
            'autor' => 'required|string|max:191',
            'classificacao' => 'required|digits:1',
            'resenha' => 'required|max:1000'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        else {
            $livro = Livro::find($id);
            


            if($livro) {
                $livro->update([
                    'titulo' => $request->titulo,
                    'autor' => $request->autor,
                    'classificacao' => $request->classificacao,
                    'resenha' => $request->resenha
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Livro atualizado com sucesso.' 
                ], 200);
            }

            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Livro não encontrado.' 
                ], 404);
            }
        }        
    }

    public function destroy($id) {
        $livro = Livro::find($id);
        
        if($livro) {
            $livro->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Livro deletado com sucesso.' 
            ], 200);
        }

        else {
            return response()->json([
                'status' => 404,
                'message' => 'Livro não encontrado.' 
            ], 404);
        }
    }
}
