<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

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
            $imagemNome = md5($requestImagem->imagem->getClientOriginalName() . strtotime('now') . '.' . $extension);
            $requestImagem->move(public_path('img/produtos'), $imagemNome);

            $produtos->imagem = $imagemNome;
        }

        $produtos->save();

        return response()->json($produtos, 200);
    }

    public function show($id) {
        return Produtos::find($id);
    }

    public function update(Request $request, $id) {
        $produto = Produtos::find($id);
        $produto->update($request->all());
        return $produto;
    }

    public function destroy($id) {
        return Produtos::destroy($id);
    }

    public function search($nome) {
        return Produtos::where('nome', 'like', '%'.$nome.'%')->get();
    }
}
