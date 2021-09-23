<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriasController extends Controller
{
    public function index() {
        return Categorias::all();
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required',
            'imagem' => 'required',
        ]);

        $categorias = new Categorias();
        $categorias->nome = $request->nome;

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;
            $extension = $requestImagem->extension();
            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime('now') . '.' . $extension);
            $requestImagem->move(public_path('img/categorias'), $imagemNome);

            $categorias->imagem = $imagemNome;
        }

        $categorias->save();

        return response()->json($categorias, 200);
    }

    public function show($id) {
        $produto = Categorias::find($id);
        return $produto;
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nome' => 'required',
            'imagem' => 'required',
        ]);

        $categorias = Categorias::find($id);

        $categorias->nome = $request->nome;

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;
            $extension = $requestImagem->extension();
            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime('now') . '.' . $extension);
            File::put('img/categorias', $imagemNome);

            $categorias->imagem = $imagemNome;
        }

        $categorias->save();

        return response()->json($categorias, 200);
    }

    public function destroy($id) {
        $categorias = Categorias::find($id);

        File::delete($categorias->imagem);

        $categorias->delete();

        return response(['message' => 'Sucesso!'], 200);
    }
}
