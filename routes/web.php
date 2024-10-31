<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\Admin\Admin_AuthController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_CollegeController;
use App\Http\Controllers\Admin\Admin_DepartmentController;
use App\Http\Controllers\Admin\Admin_StaffController;
use App\Http\Controllers\Admin\Admin_DeanController;
use App\Http\Controllers\Admin\Admin_MinistryController;
use App\Http\Controllers\Admin\Admin_DocumentController;
use App\Http\Controllers\Admin\Admin_ProfileController;

use App\Http\Controllers\Admin\Admin_TrackerController;
use App\Http\Controllers\Admin\Admin_AnalyticsController;

use App\Http\Controllers\Admin\Admin_CellController;
use App\Http\Controllers\Admin\Admin_CellTypeController;
use App\Http\Controllers\Admin\Admin_CircleController;

use App\Http\Controllers\Admin\Admin_PermissionController;

// AcademicSessionController
use App\Http\Controllers\Admin\Admin_AcademicSessionController;

// SemesterController
use App\Http\Controllers\Admin\Admin_SemesterController;

//use CourseController
use App\Http\Controllers\Admin\Admin_CourseController;

// use RemunerationRateController
use App\Http\Controllers\Admin\Admin_RemunerationRateController;


use App\Http\Controllers\Staff\Staff_AuthController;
use App\Http\Controllers\Staff\Staff_DashboardController;
use App\Http\Controllers\Staff\Staff_DocumentController;
use App\Http\Controllers\Staff\Staff_WorkflowController;
use App\Http\Controllers\Staff\Staff_GeneralMessageController;
use App\Http\Controllers\Staff\Staff_PrivateMessageController;

use App\Http\Controllers\Staff\Staff_ProfileController;

use App\Http\Controllers\Staff\Staff_CircleController;
use App\Http\Controllers\Staff\Staff_CircleGeneralRoomController;
use App\Http\Controllers\Staff\Staff_CircleTeamController;
use App\Http\Controllers\Staff\Staff_CircleAnnouncementController;




use App\Http\Controllers\Staff\Staff_CategoryController;

use App\Http\Controllers\MailTestController;


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
class User
{
    public $name;
    public $email;
};

class Job
{
    public $title;
}

Route::get('test', function(){

    $user = (object) [
        'name' => 'Seyi Babs',
        'email' => 'babarindeos@funaab.edu.ng'
    ];

    $user = new User();
    $user->name = "Seyi Babs";
    $user->email = "babarindeos@funaab.edu.ng";


    //dd($user->email);

    /* $job = (object) [
        'title' => 'Laravel Developer'
    ]; */

    $job = new Job();
    $job->title = "Laravel Developer";

    //dd($job->title);

    

    \Illuminate\Support\Facades\Mail::to($user)->send(
        new \App\Mail\JobPosted($job)
    );

    return "Done";
});


Route::get('testmail', function(){
    $user = new User();
    $user->name = "Kondi Shiva";
    $user->email = "leakscrime@gmail.com";

    \Illuminate\Support\Facades\Mail::to($user)->send(
        new \App\Mail\SimpleMail()
    );

    return "Mail successfully sent";
});

Route::get('testmailcontroller', [MailTestController::class, 'dispatch']);

Route::get('testmailparams', [MailTestController::class, 'param_dispatch']);

Route::get('testmailbody', function(){
    $name = "Babarinde Oluwaseyi Abiodun";
    return new App\Mail\MarkupMail($name);

});



Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/', [Staff_AuthController::class, 'login'])->name('staff.auth.login');



Route::get('/admin', [Admin_AuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin', [Admin_AuthController::class, 'login'])->name('admin.auth.login');


Route::prefix('staff')->middleware(['auth', 'staff'])->group(function(){
    Route::get('/dashboard', [Staff_DashboardController::class, 'index'])->name('staff.dashboard.index');
    Route::post('/logout', [Staff_AuthController::class, 'logout'])->name('staff.auth.logout');


    // Circle
    Route::get('/circles', [Staff_CircleController::class, 'index'])->name('staff.circles.index');
    Route::get('/circles/{circle}/general_room', [Staff_CircleGeneralRoomController::class, 'general_room'])->name('staff.circles.general_room');
    Route::post('/circles/{cell}/general_room', [Staff_CircleGeneralRoomController::class, 'store'])->name('staff.circles.general_room.store');
    
    Route::get('/circles/{circle}/team', [Staff_CircleTeamController::class, 'team'])->name('staff.circles.team');

    Route::get('/circles/{circle}/announcements', [Staff_CircleAnnouncementController::class, 'announcements']
    )->name('staff.circles.announcements');

    Route::get('/circles/{circle}/create_announcement', [Staff_CircleAnnouncementController::class, 'create_announcement']
    )->name('staff.circles.create_announcement');

    Route::post('/circles/{circle}/store_announcement', [Staff_CircleAnnouncementController::class, 'store_announcement']
    )->name('staff.circles.store_announcement');

    Route::get('/circles/{circle}/announcement/{announcement}/show_announcement', [Staff_CircleAnnouncementController::class, 'show_announcement'])->name('staff.circles.show_announcement');
    Route::post('/circles/{circle}/announcement/{announcement}/store_announcement', [Staff_CircleAnnouncementController::class, 'store_announcement_comment'])->name('staff.circles.store_announcement_comment');

    // Documents
    Route::get('/documents', [Staff_DocumentController::class, 'index'])->name('staff.document.index');
    Route::get('/documents/create', [Staff_DocumentController::class, 'create'])->name('staff.documents.create');
    Route::post('/documents/store', [Staff_DocumentController::class, 'store'])->name('staff.documents.store');
    
    Route::get('/documents/{document}/show', [Staff_DocumentController::class, 'show'])->name('staff.documents.show');
    Route::get('/documents/mydocuments', [Staff_DocumentController::class, 'mydocuments'])->name('staff.documents.mydocuments');
    
    

    // Workflow
    Route::get('/workflows/{document}/flow', [Staff_WorkflowController::class, 'flow'])->name('staff.workflows.flow');
    Route::get('/workflows/{document}/add_contributor',[Staff_WorkflowController::class, 'add_contributor'])->name('staff.workflows.add_contributor');
    Route::post('/workflows/{document}/post_add_contributor', [Staff_WorkflowController::class, 'post_add_contributor'])->name('staff.workflows.post_add_contributor');

    Route::post('/workflows/{document}/search_staff', [Staff_WorkflowController::class, 'search_staff'])->name('staff.workflows.search_staff');
    Route::post('/workflows/{document}/forward_document', [Staff_WorkflowController::class, 'forward_document'])->name('staff.workflows.forward_document');

    Route::get('/workflows/{workflow}/notification_update', [Staff_WorkflowController::class, 'notification_update'])->name('staff.workflows.notification_update');

    
    Route::get('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'index'])->name('staff.workflows.general_message');
    Route::post('/workflows/{document}/general_message', [Staff_GeneralMessageController::class, 'store'])->name('staff.workflows.general_message.store');

    Route::get('/workflows/{document}/private_messages/{recipient}/my_private_messages', [Staff_PrivateMessageController::class, 'my_private_messages'])->name('staff.workflows.private_messages.my_private_messages');
    Route::get('/workflows/{document}/private_message/{recipient}', [Staff_PrivateMessageController::class, 'index'])->name('staff.workflows.private_message.index');
    Route::get('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'chat'])->name('staff.workflows.private_message.chat');

    Route::post('/workflows/{document}/private_message/{sender}/{recipient}/{chat_uuid}/chat', [Staff_PrivateMessageController::class, 'store'])->name('staff.workflows.private_message.store');



    // Profile
    Route::get('/profile/create', [Staff_ProfileController::class, 'create'])->name('staff.profile.create');
    Route::post('/profile/create', [Staff_ProfileController::class, 'store'])->name('staff.profile.store');
    Route::post('/profile/upload_avatar', [Staff_ProfileController::class, 'upload_avatar'])->name('staff.profile.upload_avatar');

    Route::get('/profile/myprofile', [Staff_ProfileController::class, 'myprofile'])->name('staff.profile.myprofile');
    
    Route::get('/profile/myprofile/edit', [Staff_ProfileController::class, 'edit'])->name('staff.profile.myprofile.edit');
    Route::post('/profile/myprofile/update', [Staff_ProfileController::class, 'update'])->name('staff.profile.myprofile.update');

    Route::post('/profile/myprofile/update_avatar', [Staff_ProfileController::class, 'update_avatar'])->name('staff.profile.myprofile.update_avatar');
    
    Route::get('/profile/user/{fileno}', [Staff_ProfileController::class, 'user_profile'])->name('staff.profile.user_profile');
    Route::get('/profile/user/{email}/user_profile', [Staff_ProfileController::class, 'email_user_profile'])->name('staff.profile.email_user_profile');

    Route::get('/profile/change_password', [Staff_ProfileController::class, 'change_password'])->name('staff.profile.change_password');
    Route::post('/profile/update_password', [Staff_ProfileController::class, 'update_password'])->name('staff.profile.update_password');



    // Categories
    Route::get('/categories/create', [Staff_CategoryController::class, 'create'])->name('staff.categories.create');
    Route::post('/categories/store', [Staff_CategoryController::class, 'store'])->name('staff.categories.store');
});



Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    
    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::post('/logout', [Admin_AuthController::class, 'logout'])->name('admin.auth.logout');


    //Cell
    Route::get('/cells', [Admin_CellController::class, 'index'])->name('admin.cells.index');
    Route::get('cells/create', [Admin_CellController::class, 'create'])->name('admin.cells.create');
    Route::post('cells/store', [Admin_CellController::class, 'store'])->name('admin.cells.store');
    
    Route::get('cells/{cell}/edit', [Admin_CellController::class, 'edit'])->name('admin.cells.edit');
    Route::post('cells/{cell}/update', [Admin_CellController::class, 'update'])->name('admin.cells.update');

    Route::get('cells/{cell}/confirm_delete', [Admin_CellController::class, 'confirm_delete'])->name('admin.cells.confirm_delete');
    Route::post('cells/{cell}/destroy', [Admin_CellController::class, 'destroy'])->name('admin.cells.destroy');




    // Cell Type
    Route::get('/cell_types', [Admin_CellTypeController::class, 'index'])->name('admin.cell_types.index');
    Route::get('cell_types/create', [Admin_CellTypeController::class, 'create'])->name('admin.cell_types.create');
    Route::post('cell_types/store', [Admin_CellTypeController::class, 'store'])->name('admin.cell_types.store');
    
    Route::get('cell_types/{cell_type}/edit', [Admin_CellTypeController::class, 'edit'])->name('admin.cell_types.edit');
    Route::post('cell_types/{cell_type}/update', [Admin_CellTypeController::class, 'update'])->name('admin.cell_types.update');

    Route::get('cell_types/{cell_type}/confirm_delete', [Admin_CellTypeController::class, 'confirm_delete'])->name('admin.cell_types.confirm_delete');
    Route::post('cell_types/{cell_type}/destroy', [Admin_CellTypeController::class, 'destroy'])->name('admin.cell_types.destroy');

    
    // Circle    
    Route::get('circles/{cell}/show', [Admin_CircleController::class, 'show'])->name('admin.circles.show');
    Route::post('circles/{cell}/add_user', [Admin_CircleController::class, 'add_user'])->name('admin.circles.add_user');

    Route::get('circles/{cell}/user/{user}/permissions', [Admin_PermissionController::class, 'index'])->name('admin.circles.permissions');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_set', [Admin_PermissionController::class, 'create_announcement_set'])->name('admin.circles.permissions.create_announcement_set');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_on', [Admin_PermissionController::class, 'create_announcement_on'])->name('admin.circles.permissions.create_announcement_on');
    Route::post('circles/{cell}/user/{user}/permissions/create_announcement_off', [Admin_PermissionController::class, 'create_announcement_off'])->name('admin.circles.permissions.create_announcement_off');
    
    
    //college
    Route::get('/colleges', [Admin_CollegeController::class, 'index'])->name('admin.colleges.index');
    Route::get('/colleges/create', [Admin_CollegeController::class, 'create'])->name('admin.colleges.create');
    Route::post('colleges/store', [Admin_CollegeController::class, 'store'])->name('admin.colleges.store');
    Route::get('colleges/{college}/show', [Admin_CollegeController::class, 'show'])->name('admin.colleges.show');
    Route::get('colleges/{college}/edit', [Admin_CollegeController::class, 'edit'])->name('admin.colleges.edit');
    Route::post('colleges/{college}/update', [Admin_CollegeController::class, 'update'])->name('admin.colleges.update');
    Route::get('college/{college}/confirm_delete', [Admin_CollegeController::class, 'confirm_delete'])->name('admin.colleges.confirm_delete');
    Route::delete('college/{college}/delete', [Admin_CollegeController::class, 'destroy'])->name('admin.colleges.delete');




    // ministry
    Route::get('/ministries', [Admin_MinistryController::class, 'index'])->name('admin.ministries.index');
    Route::get('/ministries/create', [Admin_MinistryController::class, 'create'])->name('admin.ministries.create');
    Route::post('/ministries/store', [Admin_MinistryController::class, 'store'])->name('admin.ministries.store');
    
    Route::get('/ministries/{ministry}/show', [Admin_MinistryController::class, 'show'])->name('admin.ministries.show');
    Route::get('/ministries/{ministry}/edit', [Admin_MinistryController::class, 'edit'])->name('admin.ministries.edit');
    Route::post('/ministries/{ministry}/update', [Admin_MinistryController::class, 'update'])->name('admin.ministries.update');

    Route::get('/ministries/{ministry}/destroy', [Admin_MinistryController::class, 'destroy'])->name('admin.ministries.destroy');
    Route::post('/ministries/{ministry}/confirm_delete', [Admin_MinistryController::class, 'confirm_delete'])->name('admin.ministries.confirm_delete');

    

    // Department
    Route::get('/departments', [Admin_DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('departments/create', [Admin_DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('departments/store', [Admin_DepartmentController::class, 'store'])->name('admin.departments.store');
    Route::get('departments/{department}/show', [Admin_DepartmentController::class, 'show'])->name('admin.departments.show');
    
    Route::get('departments/{department}/edit', [Admin_DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::post('departments/{department}/update', [Admin_DepartmentController::class, 'update'])->name('admin.departments.update');
    Route::get('departments/{department}/confirm_delete', [Admin_DepartmentController::class, 'confirm_delete'])->name('admin.departments.confirm_delete');
    Route::delete('departments/{department}/destroy', [Admin_DepartmentController::class, 'destroy'])->name('admin.departments.delete');
    Route::get('departments/{college}/get_departments_by_college', [Admin_DepartmentController::class, 'get_departments_by_college'])->name('admin.departments.get_departments_by_college');


    // Staff
    Route::get('staff', [Admin_StaffController::class, 'index'])->name('admin.staff.index');
    Route::get('staff/create', [Admin_StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('staff/store', [Admin_StaffController::class, 'store'])->name('admin.staff.store');

    Route::get('staff/{staff}/edit', [Admin_StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::post('staff/{staff}/update', [Admin_StaffController::class, 'update'])->name('admin.staff.update');

    // Document
    Route::get('documents', [Admin_DocumentController::class, 'index'])->name('admin.documents.index');
    Route::get('document_details/{document}', [Admin_DocumentController::class, 'show'])->name('admin.documents.show');

    // User Profile
    Route::get('/profile/user/{fileno}', [Admin_ProfileController::class, 'user_profile'])->name('admin.profile.user_profile');

    // Tracker
    Route::get('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');
    Route::get('analytics', [Admin_AnalyticsController::class, 'index'])->name('admin.analytics.index');
    Route::post('tracker', [Admin_TrackerController::class, 'index'])->name('admin.tracker.index');


    // Deans
    Route::get('deans', [Admin_DeanController::class, 'index'])->name('admin.deans.index');
    Route::get('dean/create', [Admin_DeanController::class, 'create'])->name('admin.deans.create');
    Route::post('dean/get_assigned_dean', [Admin_DeanController::class, 'get_assigned_dean'])->name('admin.deans.get_assigned_dean');

    Route::get('dean/assign_dean', [Admin_DeanController::class, 'assign_dean'])->name('admin.deans.assign_dean');
    Route::post('dean/assign_dean', [Admin_DeanController::class, 'store_assign_dean'])->name('admin.deans.store_assign_dean');


    // Settings

    // Academic Sessions
    Route::get('academic_sessions', [Admin_AcademicSessionController::class, 'index'])->name('admin.academic_sessions.index');
    Route::get('academic_sessions/create', [Admin_AcademicSessionController::class, 'create'])->name('admin.academic_sessions.create');
    Route::post('academic_sessions/store', [Admin_AcademicSessionController::class, 'store'])->name('admin.academic_sessions.store');
    Route::get('academic_sessions/{academic_session}/edit', [Admin_AcademicSessionController::class, 'edit'])->name('admin.academic_sessions.edit');
    Route::post('academic_sessions/{academic_session}/update', [Admin_AcademicSessionController::class, 'update'])->name('admin.academic_sessions.update');
    Route::get('academic_sessions/{academic_session}/confirm_delete', [Admin_AcademicSessionController::class, 'confirm_delete'])->name('admin.academic_sessions.confirm_delete');
    Route::post('academic_sessions/{academic_session}/delete', [Admin_AcademicSessionController::class, 'destroy'])->name('admin.academic_sessions.destroy');
    Route::post('academic_sessions/{academic_session}/seton_current_session', [Admin_AcademicSessionController::class, 'seton_current_session'])->name('admin.academic_sessions.seton_current_session');
    Route::post('academic_sessions/{academic_session}/setoff_current_session', [Admin_AcademicSessionController::class, 'setoff_current_session'])->name('admin.academic_sessions.setoff_current_session');

    // Semesters
    Route::get('semesters', [Admin_SemesterController::class, 'index'])->name('admin.semesters.index');
    Route::get('semesters/create', [Admin_SemesterController::class, 'create'])->name('admin.semesters.create');
    Route::post('semesters/store', [Admin_SemesterController::class, 'store'])->name('admin.semesters.store');
    Route::get('semesters/{semester}/edit', [Admin_SemesterController::class, 'edit'])->name('admin.semesters.edit');
    Route::post('semesters/{semester}/update', [Admin_SemesterController::class, 'update'])->name('admin.semesters.update');
    Route::get('semesters/{semester}/confirm_delete', [Admin_SemesterController::class, 'confirm_delete'])->name('admin.semesters.confirm_delete');
    Route::post('semesters/{semester}/delete', [Admin_SemesterController::class, 'destroy'])->name('admin.semesters.delete');
    Route::post('semesters/{semester}/seton_current_semester', [Admin_SemesterController::class, 'seton_current_semester'])->name('admin.semesters.seton_current_semester');
    Route::post('semesters/{semester}/setoff_current_semester', [Admin_SemesterController::class, 'setoff_current_semester'])->name('admin.semesters.setoff_current_semester');

    // Courses
    Route::get('courses', [Admin_CourseController::class, 'index'])->name('admin.courses.index');
    Route::get('courses/create', [Admin_CourseController::class, 'create'])->name('admin.courses.create');
    Route::post('courses/store', [Admin_CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('courses/{course}/show', [Admin_CourseController::class, 'show'])->name('admin.courses.show');
    Route::get('courses/{course}/edit', [Admin_CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::post('courses/{course}/update', [Admin_CourseController::class, 'update'])->name('admin.courses.update');
    Route::get('courses/{course}/edit', [Admin_CourseController::class, 'edit'])->name('admin.courses.edit');
    Route::get('courses/{course}/confirm_delete', [Admin_CourseController::class, 'confirm_delete'])->name('admin.courses.confirm_delete');
    Route::post('courses/{course}/delete', [Admin_CourseController::class, 'destroy'])->name('admin.courses.delete');


    // Remuneration rates
    Route::get('remuneration_rates', [Admin_RemunerationRateController::class, 'index'])->name('admin.remuneration_rates.index');
    Route::get('remuneration_rates/create', [Admin_RemunerationRateController::class, 'create'])->name('admin.remuneration_rates.create');
    Route::post('remuneration_rates/store', [Admin_RemunerationRateController::class, 'store'])->name('admin.remuneration_rates.store');
    Route::get('remuneration_rates/{rate}/show', [Admin_RemunerationRateController::class, 'show'])->name('admin.remuneration_rates.show');
    Route::get('remuneration_rates/{rate}/edit', [Admin_RemunerationRateController::class, 'edit'])->name('admin.remuneration_rates.edit');
    Route::post('remuneration_rates/{rate}/update', [Admin_RemunerationRateController::class, 'update'])->name('admin.remuneration_rates.update');
    Route::get('remuneration_rates/{rate}/confirm_delete', [Admin_RemunerationRateController::class, 'confirm_delete'])->name('admin.remuneration_rates.confirm_delete');
    Route::get('remuneration_rates/{rate}/destroy', [Admin_RemunerationRateController::class, 'destroy'])->name('admin.remuneration_rates.destroy');

});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
