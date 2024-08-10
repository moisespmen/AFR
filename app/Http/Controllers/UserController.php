<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user || ($user->email !== 'anaflavia@soluccontconsultorias.com' && $user->email !== 'moisespmen@gmail.com')) {
            abort(403, 'Não autorizado!');
        }

        $users = User::all();
        return response()->json($users);
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
        $val = Validator::make($request->all(), [
            'name' => "required",
            'email' => "required|email",
        ]);
        if ($val->fails()) {
            throw new \Exception($val->errors());
        }
        try {
            DB::beginTransaction();
            if ($request->get('id')) {
                $user = User::findOrFail($request['id']);
            } else {
                $user = new User();
            }
            $user->name = $request['name'];
            $user->email = $request['email'];
            if ($request->get('password') && $request['password'] == $request['confirm']) {
                $user->password = bcrypt($request['password']);
            }
            $user->save();
            DB::commit();
            return response()->json('Usuário salvo com sucesso');
        } catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage());
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
        //
    }

    public function me()
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
}
