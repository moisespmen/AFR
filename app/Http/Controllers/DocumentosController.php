<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $documentos = Documento::query();
        if ($request->has('protocolo') && $request['protocolo']) {
            $documentos = $documentos->where('protocolo', trim($request['protocolo']));
        } else if (!$user) {
            return response()->json(['Informe o protocolo!'], 422);
        }

        $documentos = $documentos->with('user');
        if ($request->get('perPage')) {
            $documentos = $documentos->paginate($request['perPage']);
        } else {
            $documentos = $documentos->limit(50)->get();
        }
        return response()->json($documentos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            throw new \Exception('Acesso não autorizado!');
        }
        try {
            DB::beginTransaction();
            $extension = $request->file->extension();
            if ($extension !== 'jpeg' && $extension !== 'jpg' && $extension !== 'png' && $extension !== 'pdf') {
                throw new \Exception('Tipo de arquivo não permitido');
            }

            $file = $request->file('file');
            $nameFile = Str::random(16) . '.' . $extension;
            $path = Storage::putFileAs('public/documento/' .  $request['protocolo'], $file, $nameFile);
            $documento = new Documento();
            $documento->path = $path;
            $documento->descricao = $request['descricao'];
            $documento->protocolo = $request['protocolo'];
            $documento->user_id = $user->id;
            $documento->save();
            DB::commit();
            return response()->json('Documento adicionado com sucesso!');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([$e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();

        if (!$user) {
            throw new \Exception('Acesso não autorizado!');
        }

        $documento = Documento::findOrFail($id);
        Storage::delete($documento->path);

        $documento->delete();

        return response()->json('arquivo excluído com sucesso!');
    }
}
