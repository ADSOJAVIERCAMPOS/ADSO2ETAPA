    <?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfirmedCallController;
use App\Http\Controllers\ConfirmedInscriptionController;
use App\Http\Controllers\CoordinationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Document_TypeController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


//Roles
Route::get('/roles',[RoleController::class, 'index']);
Route::get('/roles/{id_rol}',[RoleController::class, 'show']);
Route::post('/roles',[RoleController::class,'store']);
Route::put('/roles/{id_rol}',[RoleController::class,'update']);
Route::delete('/roles/{id_rol}',[RoleController::class,'destroy']);

//users
Route::apiResource('users', UserController::class, ['parameters' => ['users' => 'id_user']]);
//peoples
Route::apiResource('peoples', PeopleController::class, ['parameters' => ['peoples' => 'id_person']]);
//Teachers
Route::apiResource('teachers', TeacherController::class, ['parameters' => ['teachers' => 'id_teacher']]);
//Specializations
Route::apiResource('specializations', SpecializationController::class, ['parameters' => ['specializations' => 'id_specialization']]);

//Requests
Route::apiResource('requests', RequestController::class, ['parameters' => ['requests' => 'id_request']]);

//Courses
Route::apiResource('courses', CourseController::class, ['parameters' => ['courses' => 'id_course']]);
//Categories
Route::apiResource('categories', CategoryController::class, ['parameters' => ['categories' => 'id_category']]);
//Inscription
Route::apiResource('inscriptions', InscriptionController::class, ['parameters' => ['inscriptions' => 'id_register']]);
//Countries
Route::apiResource('countries', CountryController::class, ['parameters' => ['countries' => 'id_country']]);
//Students
Route::apiResource('students', StudentController::class, ['parameters' => ['students' => 'id_student']]);
//Documents
Route::apiResource('documents_type', Document_TypeController::class, ['parameters' => ['documents_type' => 'id_document_type']]);
//Coordinations
Route::apiResource('coordinations', CoordinationController::class, ['parameters'=> ['coordinations'=>'id_coordination']]);
// mail.php
Route::get('send-email', [ConfirmedCallController::class, 'sendEmail']);

Route::post('send-reset-link', [ResetPasswordController::class, 'sendResetLink']);
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

Route::post('send-reset-link', [ResetPasswordController::class, 'sendResetLink']);

Route::post('/send-Inscription', [ConfirmedInscriptionController::class, 'sendinscription']);


