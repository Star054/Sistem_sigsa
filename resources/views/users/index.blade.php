<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6 text-center">Lista de Usuarios</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
                    <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                        <th class="py-3 px-6 text-left">Nombre</th>
                        <th class="py-3 px-6 text-left">Correo Electrónico</th>
                        <th class="py-3 px-6 text-left">Rol</th>
                        <th class="py-3 px-6 text-left">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="py-3 px-6 text-gray-800 dark:text-white">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-gray-800 dark:text-white">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-gray-800 dark:text-white">{{ $user->rol }}</td>
                            <td class="py-3 px-6">
                                <div class="flex space-x-2 justify-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">
                                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            Editar
                                        </button>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('simple-register.create') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-600">
                    ¿Quieres agregar un nuevo usuario? Regístralo aquí
                </a>
            </div>
        </div>
    </div>

    <!-- Script para confirmar eliminación -->
    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.');
        }
    </script>
</x-app-layout>
