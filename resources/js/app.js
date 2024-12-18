import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.querySelectorAll('.nav-link').forEach(item => {
    item.addEventListener('click', function() {
        // Lógica para cargar dinámicamente el contenido solo cuando se haga clic
        console.log('Cargando contenido dinámico...');
    });
});
