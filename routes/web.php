<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AssigmentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\YourCoursesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ModuleContentController;
use App\Http\Controllers\TaskSubmissionController;
use App\Http\Controllers\ModuleContentFileController;
use App\Http\Controllers\StudentEnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get("/login", [LoginController::class, "index"])->name("login");
Route::post("/login", [LoginController::class, "autenticate"]);

Route::get("/register", [RegisterController::class, "index"])->name("register");
Route::post("/register", [RegisterController::class, "store"]);

Route::get("/logout", [LogoutController::class, "index"])->name("logout");

Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
Route::delete("/profile/delete/{user}", [ProfileController::class, "destroy"])->name("profile.delete");
Route::get('/{user:username}', [ProfileController::class, 'profile'])->middleware(['auth'])->name('profile');
// Route::get("/profile/edit/{user}", [ProfileController::class, "edit"])->name("profile.edit");
// Route::post("/profile/edit/{user}", [ProfileController::class, "update"]);

Route::get("/users/manage", [UserController::class, "index"])->middleware(['auth', "hasPermission"])->name("users.index");
Route::get("/user/back", [UserController::class, "back"])->name("user.back");
Route::get("/user/edit/{user}", [UserController::class, "edit"])->name("user.edit");
Route::post("/user/edit/{user}", [UserController::class, "update"]);
Route::delete("/user/delete/{user}", [UserController::class, "destroy"])->name("user.delete");
Route::get("/user/changeProfessor/{user}", [UserController::class, "changeProfessor"])->name("user.changeProfessor");
Route::get("/user/changeAdmin/{user}", [UserController::class, "changeAdmin"])->name("user.changeAdmin");

Route::get("/courses/index", [CourseController::class, "index"])->name("courses.index");
Route::get("/course/index/{course}", [CourseController::class, "courseIndex"])->middleware('auth')->name("course.index");
Route::get("/course/indexProfile/{course}{user}", [CourseController::class, "indexProfile"])->name("course.indexProfile");
Route::get("/courses/manage", [CourseController::class, "manage"])->middleware(['auth', "hasPermission"])->name("courses.manage");
Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');
Route::get("/course/create", [CourseController::class, "create"])->name("course.create");
Route::post("/course/create", [CourseController::class, "store"]);
Route::get("/course/back", [CourseController::class, "back"])->name("course.back");
Route::get("/course/edit/{course}", [CourseController::class, "edit"])->name("course.edit");
Route::post("/course/edit/{course}", [CourseController::class, "update"]);
Route::delete("/course/delete/{course}", [CourseController::class, "destroy"])->name("course.delete");
Route::get('/courses/{course:name}', [CourseController::class, 'show'])->middleware(['auth'])->name('course.show');

Route::get("/yourCourses/index", [YourCoursesController::class, "index"])->name("yourCourses.index");
Route::get('/yourCourses/search', [YourCoursesController::class, 'search'])->name('yourCourses.search');

Route::get("/professors/index", [ProfessorController::class, "index"])->middleware(['auth'])->name("professors.index");

Route::get("/module/index/{module}", [ModuleController::class, "index"])->name("module.index");
Route::get("/module/create/{course}", [ModuleController::class, "create"])->name("module.create");
Route::post("/module/create/{course}", [ModuleController::class, "store"]);
Route::get("/module/back", [ModuleController::class, "back"])->name("module.back");
Route::get("/module/edit/{module}", [ModuleController::class, "edit"])->name("module.edit");
Route::post("/module/edit/{module}", [ModuleController::class, "update"]);
Route::delete("/module/delete/{module}", [ModuleController::class, "destroy"])->name("module.delete");

Route::get("/moduleContent/index/{moduleContent}", [ModuleContentController::class, "index"])->name("moduleContent.index");
Route::get("/moduleContent/create/{module}", [ModuleContentController::class, "create"])->name("moduleContent.create");
Route::post("/moduleContent/create/{module}", [ModuleContentController::class, "store"]);
Route::get("/moduleContent/back", [ModuleContentController::class, "backContent"])->name("moduleContent.back");
Route::get("/moduleContent/edit/{moduleContent}", [ModuleContentController::class, "edit"])->name("moduleContent.edit");
Route::post("/moduleContent/edit/{moduleContent}", [ModuleContentController::class, "update"]);
Route::delete("/moduleContent/delete/{moduleContent}", [ModuleContentController::class, "destroy"])->name("moduleContent.delete");

Route::get("/moduleContentFile/view/{file}", [ModuleContentFileController::class, "view"])->name("view.file");

Route::get("/studentEnrollment/index", [StudentEnrollmentController::class, "index"])->name("studentEnrollment.index");
Route::get("/studentEnrollment/manage/{course}", [StudentEnrollmentController::class, "manage"])->name("studentEnrollment.manage");
Route::get("/studentEnrollment/create/{course}/{user}", [StudentEnrollmentController::class, "create"])->name("studentEnrollment.create");
Route::get("/studentEnrollment/delete/{course}/{user}", [StudentEnrollmentController::class, "delete"])->name("studentEnrollment.delete");
Route::delete("/studentEnrollment/delete/{course}/{user}", [StudentEnrollmentController::class, "destroy"])->name("studentEnrollment.destroy");
Route::get('/studentEnrollment/search', [StudentEnrollmentController::class, 'search'])->name('studentEnrollment.search');

Route::get("/assigment/create/{moduleContent}", [AssigmentController::class, "create"])->name("assigment.create");
Route::post("/assigment/create/{moduleContent}", [AssigmentController::class, "store"]);
Route::get("/assigment/edit/{assigment}", [AssigmentController::class, "edit"])->name("assigment.edit");
Route::post("/assigment/edit/{assigment}", [AssigmentController::class, "update"]);
Route::delete("/assigment/delete/{assigment}", [AssigmentController::class, "destroy"])->name("assigment.destroy");

Route::get('/taskSubmission/view/{taskSubmission}', [TaskSubmissionController::class, 'view'])->name('taskSubmission.viewFile');
// Route::get('/taskSubmission/view/{taskSubmissionId}', [TaskSubmissionController::class, 'view'])->name('taskSubmission.viewFile');
Route::post("/taskSubmission/create/{assigment}/{user}", [TaskSubmissionController::class, "store"])->name("taskSubmission.create");
Route::delete("/taskSubmission/delete/{assigment}{user}", [TaskSubmissionController::class, "destroy"])->name("taskSubmission.delete");
Route::get("/taskSubmission/grade/{submission}", [TaskSubmissionController::class, "grade"])->name("taskSubmission.grade");
Route::post("/taskSubmission/grade/{submission}", [TaskSubmissionController::class, "storeGrade"]);

Route::get('/notification/read/{notification}/{user}', [NotificationController::class, 'read'])->name('notification.read');
Route::get('/notification/readAll/{user}', [NotificationController::class, 'readAll'])->name('notification.readAll');