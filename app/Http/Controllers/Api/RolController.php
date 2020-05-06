<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Rol;
use App\Clases\Utilitats;
use App\Http\Resources\RolResource;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class RolController extends Controller
{
    public function index()
    {
        $rols = Rol::with('usuaris')->get();
        return RolResource::collection($rols);
    }

    //crea un nuevo rol
    public function store(Request $request)
    {
        $rol = new Rol();
        $rol->nom = $request->input('nom');

        try
        {
            $rol->save();
            $resposta = (new RolResource($rol))->response()->setStatusCode(201);
        }
        catch (QueryException $e)
        {
            $missatge = Utilitats::errorMessage($e);
            $resposta = response()->json(['error' => $missatge], 400);
        }
        return $resposta;
    }

    //devuelve un rol
    public function show(Rol $rol)
    {
        $rol = Rol::with('usuaris')->find($rol->id);
        return new RolResource($rol);
    }

    public function update(Request $request, Rol $rol)
    {
        $rol->nom = $request->input('nom');

        try
        {
            $rol->save();
            $resposta = (new RolResource($rol))->response()->setStatusCode(200);
        }
        catch (QueryException $e)
        {
            $missatge = Utilitats::errorMessage($e);
            $resposta = response()->json(['error' => $missatge], 400);
        }

        return $resposta;
    }

    public function destroy(Rol $rol)
    {
        try
        {
            $rol->delete();
            $resposta = (new RolResource($rol))->response()->setStatusCode(200);
        }
        catch (QueryException $e)
        {
            $missatge = Utilitats::errorMessage($e);
            $resposta = response()->json(['error' => $missatge], 400);
        }

        return $resposta;
    }
}