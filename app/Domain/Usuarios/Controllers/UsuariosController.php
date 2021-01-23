<?php

namespace App\Domain\Usuarios\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Usuarios\Service\ServiceUsuario;

class UsuariosController extends Controller
{
    protected $service;

    public function __construct(ServiceUsuario $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = $this->service->get();
        $users = collect([[
            "nome" => "gustavo",
            "idade" => 20,
            "work" => "programmer"
        ],[
            "nome" => "roger",
            "idade" => 40,
            "work" => "design"
        ],[
            "nome" => "mirella",
            "idade" => 60,
            "work" => "arquiteta"
        ]]);

        return view('usuarios.index', compact('users'));
    }

    public function create(Request $request)
    {
        try {
            $this->service->create($request->all());

            return view('usuarios.create');
        } catch (\Exception $e) {
            return view('usuarios.create');
        }

    }

    public function edit(Request $request, $usuarioId)
    {
        try {
            $user = $this->service->update($request->all(), $usuarioId);

            return view('usuarios.edit', compact('user'));
        } catch (\Exception $e) {
            return view('usuarios.edit');
        }

    }

    public function destroy($usuarioId)
    {
        try {
            $user = $this->service->delete($usuarioId);

            return view('usuarios.index', compact('user'));
        } catch (\Exception $e) {
            return view('usuarios.index');
        }
        
    }
}