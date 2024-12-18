<div class="container mx-auto px-4 py-6">
    <!-- Tabla principal para Consulta, Control, etc. -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse mb-6 border border-black dark:border-white">
            <thead>
            <tr>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Consulta</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Control</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Semana de gestación</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Viene</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Fue</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Referido a</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Descripción de diagnóstico/control</th>
                <th class="border border-black dark:border-white p-2 text-center text-gray-900 dark:text-gray-100">Código CIE-10</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <!-- Consulta -->
                <td class="border border-black dark:border-white p-0">
                    <select name="consulta" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        <option value="1">1 - Primera consulta</option>
                        <option value="2">2 - Reconsulta</option>
                        <option value="3">3 - Interconsulta</option>
                        <option value="4">4 - Emergencia</option>
                    </select>
                </td>

                <!-- Control -->
                <td class="border border-black dark:border-white p-0">
                    <select name="control" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Prenatal</option>
                        <option value="2">2 - Puerperio</option>
                        <option value="3">3 - Planificación Familiar</option>
                        <option value="4">4 - Profilaxia Sexual</option>
                        <option value="5">5 - Papanicolaou</option>
                        <option value="6">6 - IVAA</option>
                    </select>
                </td>

                <!-- Semana de gestación -->
                <td class="border border-black dark:border-white p-0">
                    <input type="number" name="semana_gestacion" min="1" max="42"
                           class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                           placeholder="1-42">
                </td>

                <!-- Viene -->
                <td class="border border-black dark:border-white p-0">
                    <select name="viene" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Viene Referido</option>
                        <option value="2">2 - Viene Contra Referido</option>
                    </select>
                </td>

                <!-- Fue -->
                <td class="border border-black dark:border-white p-0">
                    <select name="fue" class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Sin seleccionar</option> <!-- Opción vacía -->
                        <option value="0">0 - No aplica</option>
                        <option value="1">1 - Fue Referido</option>
                        <option value="2">2 - Fue Contra Referido</option>
                    </select>
                </td>

                <!-- Referido a -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="referido_a"
                              class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>

                <!-- Descripción de diagnóstico/control -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="diagnostico_control"
                              class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>


                <!-- Código CIE-10 -->
                <td class="border border-black dark:border-white p-0">
                    <textarea name="codigo_cie"
                              class="w-full h-full border-none p-2 text-black dark:text-white dark:bg-gray-900 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                              rows="1"
                              oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
