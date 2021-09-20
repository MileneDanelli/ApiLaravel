<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index() {
        return Categorias::all();
    }

    public function store(Request $request) {
        $request->validate([
           'nome' => 'required',
            'imagem' => 'required'
        ]);

        return Categorias::create($request->all());
    }

    public function show($id) {
        return Categorias::find($id);
    }

    public function update(Request $request, $id) {
        $categoria = Categorias::find($id);
        $categoria->update($request->all());
        return $categoria;
    }

    public function destroy($id) {
        return Categorias::destroy($id);
    }
}
