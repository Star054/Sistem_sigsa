<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Método para mostrar la lista de usuarios
    public function index()
    {
        $users = User::all(); // O puedes aplicar alguna lógica de exclusión del admin actual
        return view('users.index', compact('users'));
    }

    // Método para eliminar un usuario
    public function destroy(User $user)
    {
        // Asegúrate de que el usuario no sea el admin que está logueado
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // Eliminar el usuario
        $user->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }


    public function edit($id)
    {
        // Busca el usuario por ID
        $user = User::findOrFail($id);

        // Retorna la vista con el usuario
        return view('users.edit', compact('user'));
    }



    public function update(Request $request, $id)
    {
        // Validar datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',  // Contraseña solo si se proporciona
            'rol' => 'required|in:admin,usuario',
        ]);

        $user = User::findOrFail($id);

        // Si se proporciona una nueva contraseña, la actualizamos
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Actualizamos el resto de los campos
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol = $request->rol;

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
    }
}
