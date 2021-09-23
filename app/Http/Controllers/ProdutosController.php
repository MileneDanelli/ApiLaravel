<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdutosController extends Controller
{
    public function index() {
        return Produtos::all();
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required',
            'imagem' => 'required',
            'id_categoria' => 'required'
        ]);

        $produtos = new Produtos();
        $produtos->nome = $request->nome;
        $produtos->id_categoria = $request->id_categoria;

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;
            $extension = $requestImagem->extension();
            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime('now') . '.' . $extension);
            $requestImagem->move(public_path('img/produtos'), $imagemNome);

            $produtos->imagem = $imagemNome;
        }

        $produtos->save();

        return response()->json($produtos, 200);
    }

    public function show($id) {
        $produto = Produtos::selectRaw('produtos.id, produtos.nome, produtos.imagem, categorias.nome as nome_categoria')
            ->join('categorias', 'produtos.id_categoria', 'categorias.id')
            ->find($id);
        return $produto;
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nome' => 'required',
            'imagem' => 'required',
            'id_categoria' => 'required'
        ]);

        $produtos = Produtos::find($id);

        $produtos->nome = $request->nome;
        $produtos->id_categoria = $request->id_categoria;

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $requestImagem = $request->imagem;
            $extension = $requestImagem->extension();
            $imagemNome = md5($requestImagem->getClientOriginalName() . strtotime('now') . '.' . $extension);
            $requestImagem->put(public_path('img/produtos'), $imagemNome);

            $produtos->imagem = $imagemNome;
        }

        $produtos->save();

        return response()->json($produtos, 200);
    }

    public function destroy($id) {
        $produtos = Produtos::find($id);

        File::delete($produtos->imagem);

        $produtos->delete();

        return response(['message' => 'Sucesso!'], 200);
    }
}
