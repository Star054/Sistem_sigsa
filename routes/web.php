<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormularioSIGSAController;
use App\Http\Controllers\VacunaController;
use App\Http\Controllers\FormularioController5bA;
use App\Http\Controllers\FormularioController3CS;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaVacunasController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFTestController;
use App\Http\Controllers\PDFController3CS;
use App\Http\Controllers\PDF5bAController;
use App\Http\Middleware\CheckSession;
Use App\Http\Controllers\SimpleRegisterController;
use App\Http\Middleware\IsAdmin;
Use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([IsAdmin::class])->group(function () {
    Route::get('/simple-register', [SimpleRegisterController::class, 'create'])->name('simple-register.create');
    Route::post('/simple-register', [SimpleRegisterController::class, 'store'])->name('simple-register.store');
    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::resource('users', UserController::class);
});



// Rutas que requieren autenticación y verificación, y también el middleware CheckSession
Route::middleware(['auth', 'verified', CheckSession::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

    Route::get('/reglas5bA', function () {
        return view('reglas5bA');
    })->name('5bA');

    Route::get('/reglas3CS', function () {
        return view('reglas3CS');
    })->name('3CS');

    Route::get('/instructivo', function () {
        return view('instructivo');
    })->name('instructivo');

    // Rutas del perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de vacunas
    Route::resource('vacunas', VacunaController::class)->only(['create', 'store', 'index', 'edit', 'update', 'destroy']);

    // Rutas de formularios SIGSA
    Route::post('/formulario-sigsa', [FormularioSIGSAController::class, 'store'])->name('formulario-sigsa.store');
    Route::resource('for-sigsa-5b', FormularioSIGSAController::class);
    Route::resource('for-sigsa-5bA', FormularioController5bA::class);
    Route::resource('formularios-3cs', FormularioController3CS::class);

    // Rutas para consulta de vacunas
    Route::get('/filtros-vacunas', [ConsultaVacunasController::class, 'mostrarFiltros'])->name('vacunas.filtros');
    Route::get('/resultados-vacunas', [ConsultaVacunasController::class, 'mostrarResultados'])->name('vacunas.resultados');
    Route::get('/busqueda-resultados', [ConsultaVacunasController::class, 'buscar'])->name('busqueda.resultados');
    Route::post('/generar-pdf-filtro', [ConsultaVacunasController::class, 'generarPDF'])->name('vacunas.generarPDF');

    // Rutas para generar PDF
    Route::post('/generar-pdf-5b', [PDFController::class, 'generarPDF5b'])->name('pdf.generar5b');
    Route::post('/pdf/5bA', [PDF5bAController::class, 'generarPDF5bA'])->name('pdf.5bA');
    Route::post('pdf/3cs', [PDFController3CS::class, 'generarPDF3CS'])->name('generarPDF3CS');

    // Ruta para prueba de PDF
    Route::get('/pdf-prueba', [PDFTestController::class, 'generarPDF']);

    // Vista de formulario exitoso
    Route::get('/formulario-exitoso', function () {
        return view('formulario-exitoso');
    })->name('formulario.exitoso');
});

require __DIR__.'/auth.php';
