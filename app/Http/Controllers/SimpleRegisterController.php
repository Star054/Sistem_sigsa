<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SimpleRegisterController extends Controller
{
    public function __construct()
    {
        // Asegura que solo los administradores pueden acceder a este controlador
        $this->middleware('is_admin');
    }

    public function create()
    {
        return view('simple_register'); // Asegúrate de que la vista exista
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'rol' => ['required', 'in:admin,usuario'],  // Validación para asegurarse de que el rol sea 'admin' o 'usuario'
        ]);

        // Si la validación falla, devolver error
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        // Crear el usuario con el rol asignado desde el formulario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,  // Asignar el rol basado en el formulario
        ]);

        // Redirigir al listado de usuarios después de crear el usuario
        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito');
    }


    private function middleware(string $string)
    {
    }
}

