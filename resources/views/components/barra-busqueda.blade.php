<div>
    <form method="GET" action="{{ route('busqueda.resultados') }}" class="mb-4">
        <div class="flex items-center">
            <input
                type="text"
                name="buscar"
                placeholder="Buscar por CUI o nombre"
                class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300 text-gray-900"
                value="{{ request('buscar') }}"
            />
            <button type="submit" class="ml-2 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Buscar
            </button>
        </div>
    </form>
</div>
