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

        return Produtos::create($request->all());
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
