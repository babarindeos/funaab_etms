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

use App\Http\Controllers\Admin\Admin_VenueTypeController;
use App\Http\Controllers\Admin\Admin_VenueCategoryController;
use App\Http\Controllers\Admin\Admin_VenueCategoryGroupController;

use App\Http\Controllers\Admin\Admin_VenueController;
use App\Http\Controllers\Admin\Admin_StaffTitleController;
use App\Http\Controllers\Admin\Admin_StaffStatusController;

use App\Http\Controllers\Admin\Admin_StaffRoleController;

use App\Http\Controllers\Admin\Admin_ExamTypeController;
use App\Http\Controllers\Admin\Admin_ExamTimePeriodController;
use App\Http\Controllers\Admin\Admin_ExamDayController;

use App\Http\Controllers\Admin\Admin_ExamController;
use App\Http\Controllers\Admin\Admin_ExamSchedulerController;
use App\Http\Controllers\Admin\Admin_InvigilatorAllocationController;

use App\Http\Controllers\Admin\Admin_ChiefAllocationController;
use App\Http\Controllers\Admin\Admin_TimtecAllocationController;

use App\Http\Controllers\Admin\Admin_HodController;

use App\Http\Controllers\Admin\Admin_CourseCoordinatorController;
use App\Http\Controllers\Admin\Admin_MonitoringChiefController;

use App\Http\Controllers\Admin\Admin_MonitoringInvigilatorController;
use App\Http\Controllers\Admin\Admin_MonitoringTimtecController;

use App\Http\Controllers\Admin\Admin_AnnouncementController;

use App\Http\Controllers\Admin\Admin_CourseEnrolmentController;

use App\Http\Controllers\Admin\Admin_SupportVenueController;

use App\Http\Controllers\Admin\Admin_AvailabilityListController;

use App\Http\Controllers\Admin\Admin_AllocationStatisticController;
use App\Http\Controllers\Admin\Admin_AutomaticInvigilatorAllocationController;



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
use App\Http\Controllers\Staff\Staff_InvigilationController;

use App\Http\Controllers\Staff\Staff_TimtecSupervisionController;

use App\Http\Controllers\Staff\Staff_LiveChatController;
use App\Http\Controllers\Staff\Staff_ReportController;
use App\Http\Controllers\Staff\Staff_MalpracticeController;

use App\Http\Controllers\Staff\Staff_AnnouncementController;

use App\Http\Controllers\Staff\Staff_HodController;
use App\Http\Controllers\Staff\Staff_CourseController;

use App\Http\Controllers\Staff\Staff_CategoryController;

//use App\Http\Controllers\Staff\
// Manager
use App\Http\Controllers\Manager\Manager_DashboardController;
use App\Http\Controllers\Manager\Manager_AuthController;
use App\Http\Controllers\Manager\Manager_AnnouncementController;
use App\Http\Controllers\Manager\Manager_ExamDayController;

// Manager Monitoring
use App\Http\Controllers\Manager\Manager_MonitoringTimtecController;
use App\Http\Controllers\Manager\Manager_MonitoringInvigilatorController;

// Exam
use App\Http\Controllers\Manager\Manager_ExamController;

use App\Http\Controllers\Manager\Manager_ExamSchedulerController;
use App\Http\Controllers\Manager\Manager_StaffController;
use App\Http\Controllers\Manager\Manager_CourseInvigilationController;


use App\Http\Controllers\MailTestController;

use App\Http\Controllers\PasswordResetController;


// BackOffice 
use App\Http\Controllers\BackOffice\BackOffice_AuthController;




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


Route::get('/forgot_password', [PasswordResetController::class, 'forgot_password'])->name('guest.password.forgot');
Route::post('/email_verification', [PasswordResetController::class, 'email_verification'])->name('guest.password.email_verification');

Route::get('/password_reset/{token}', [PasswordResetController::class, 'password_reset_create'])->name('guest.password.reset_create');
Route::post('/password_reset/{token}', [PasswordResetController::class, 'password_reset_store'])->name('guest.password.reset.store');


Route::get('/admin', [Admin_AuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin', [Admin_AuthController::class, 'login'])->name('admin.auth.login');


Route::get('/backoffice', [Manager_AuthController::class, 'index'])->name('manager.auth.index');
Route::post('/backoffice', [Manager_AuthController::class, 'login'])->name('manager.auth.login');



Route::prefix('backoffice')->middleware(['auth', 'manager'])->group(function(){
    Route::get('/dashboard', [Manager_DashboardController::class, 'index'])->name('manager.dashboard.index');
    Route::post('/logout', [Manager_AuthController::class, 'logout'])->name('manager.auth.logout');

// Create Announcement
    Route::get('announcements', [Manager_AnnouncementController::class, 'index'])->name('manager.announcements.index');
    Route::get('announcements/{announcement}/show', [Manager_AnnouncementController::class, 'show'])->name('manager.announcements.show');

    Route::get('announcements/create', [Manager_AnnouncementController::class, 'create'])->name('manager.announcements.create');

    Route::post('announcements/store', [Manager_AnnouncementController::class, 'store'])->name('manager.announcements.store');

    Route::post('announcements/{announcement}/comments/store', [Manager_AnnouncementController::class, 'store_comment'])->name('manager.announcements.comments.store');
    Route::delete('announcements/{comment}/comments/delete', [Manager_AnnouncementController::class, 'delete_comment'])->name('manager.announcements.comments.delete_comment');
    
    Route::get('announcements/{announcement}/notify', [Manager_AnnouncementController::class, 'notify'])->name('manager.announcements.notify');
    Route::post('announcements/{announcement}/notify', [Manager_AnnouncementController::class, 'post_notify'])->name('manager.announcements.post_notify');

    Route::get('announcements/{announcement}/edit', [Manager_AnnouncementController::class, 'edit'])->name('manager.announcements.edit');
    Route::post('announcements/{announcement}/update', [Manager_AnnouncementController::class, 'update'])->name('manager.announcements.update');

    Route::get('announcements/{announcement}/confirm_delete', [Manager_AnnouncementController::class, 'confirm_delete'])->name('manager.announcements.confirm_delete');
    Route::delete('announcements/{announcement}/delete', [Manager_AnnouncementController::class, 'destroy'])->name('manager.announcements.delete');

    Route::get('announcements/{announcement}/delete_file', [Manager_AnnouncementController::class, 'delete_file'])->name('manager.announcements.delete_file');



    // ExamDay
    Route::get('exams/exam_days', [Manager_ExamDayController::class, 'index'])->name('manager.exams.exam_days.index');
    Route::get('exams/exam_days/select_exam_days', [Manager_ExamDayController::class, 'select_exam_days'])->name('manager.exams.exam_days.select_exam_days');
    Route::post('exams/exam_days/select_exam_days', [Manager_ExamDayController::class, 'load_exam_day_schedule'])->name('manager.exams.exam_days.load_exam_day_schedule');
    Route::get('exams/exam_days/day/{exam_day}/exam_schedule', [Manager_ExamDayController::class, 'exam_day_schedule'])->name('manager.exams.exam_days.exam_day_schedule');  



    // Monitoring Timtec 
    Route::get('monitoring/timtecs/select_exam_timtec', [Manager_MonitoringTimtecController::class, 'select_exam_timtec'])->name('manager.monitoring.timtecs.select_exam_timtec');
    Route::get('monitoring/exams/{exam}/timtecs/{timtec_member}/observations', [Manager_MonitoringTimtecController::class, 'timtec_observation'])->name('manager.monitoring.exams.timtecs.observations');



    // Monitoring Invigilator
    Route::get('monitoring/invigilators/select_exam_invigilator', [Manager_MonitoringInvigilatorController::class, 'select_exam_invigilator'])->name('manager.monitoring.invigilators.select_exam_invigilator');
    Route::get('monitoring/exams/{exam}/invigilators/{invigilator}/invigilation', [Manager_MonitoringInvigilatorController::class, 'invigilations'])->name('manager.monitoring.exams.invigilators.invigilations');


    // Exams
    Route::get('exams', [Manager_ExamController::class, 'index'])->name('manager.exams.index');
    Route::get('exams/{exam}/show', [Manager_ExamController::class, 'show'])->name('manager.exams.show');


    Route::get('exams/{exam}/days', [Manager_ExamDayController::class, 'index'])->name('manager.exams.days.index');
    Route::get('exams/exam_scheduler/{exam_day}/scheduler', [Manager_ExamSchedulerController::class, 'scheduler'])->name('manager.exams.exam_scheduler.scheduler');


    // Staff
    Route::get('staff', [Manager_StaffController::class, 'index'])->name('manager.staff.index');

    // Course Invigilation 
    Route::get('course_invigilation', [Manager_CourseInvigilationController::class, 'index'])->name('manager.course.invigilation.index');
    Route::post('course_invigilation', [Manager_CourseInvigilationController::class, 'invigilation'])->name('manager.course.invigilation.get_result');

    Route::get('courses/fetch_course', [Manager_CourseInvigilationController::class, 'fetch_course'])->name('manager.courses.fetch_course');

});




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


    //My Invigilation
    Route::get('exams/current_session/exams', [Staff_InvigilationController::class, 'select_exam'])->name('staff.exams.current_session.exams');
    Route::get('exams/{exam}/invigilations/my_schedule', [Staff_InvigilationController::class, 'get_my_schedule'])->name('staff.exams.invigilations.my_schedule');
    


    // TIMTEC Supervision
    Route::get('exams/timtec_supervision/current_session/exams', [Staff_TimtecSupervisionController::class, 'select_exam'])->name('staff.exams.timec_supervision.current_session.exams');
    Route::get('exams/{exam}/timtec_supervisions/my_schedule', [Staff_TimtecSupervisionController::class, 'get_my_schedule'])->name('staff.exams.timtec_supervisions.my_schedule');
    
    
    // Attendance
    Route::get('exams/timtec_supervisions/{supervision}/attendance', [Staff_TimtecSupervisionController::class, 'attendance'])->name('staff.exams.timtec_supervisions.attendance');
    Route::post('exam/timtec_supervisions/{supervision}/attendance', [Staff_TimtecSupervisionController::class, 'store_attendance'])->name('staff.exams.timtec_supervisions.attendance.store');


    // Exam Live Chat
    Route::get('exams/{exam}/live_chat', [Staff_LiveChatController::class, 'index'])->name('staff.exams.live_chat');
    Route::post('exams/{exam}/live_chat', [Staff_LiveChatController::class, 'store'])->name('staff.exams.live_chat.store');
    Route::delete('exams/{comment}/live_chat', [Staff_LiveChatController::class, 'destroy'])->name('staff.exams.live_chat.delete');



    // Exam Report
    Route::get('exams/reports', [Staff_ReportController::class, 'index'])->name('staff.exams.reports.index');
    Route::get('exams/reports/show', [Staff_ReportController::class, 'show'])->name('staff.exams.reports.show');
    Route::get('exams/{exam}/exam_schedules/{exam_schedule}/report/create', [Staff_ReportController::class, 'create'])->name('staff.exams.exam_schedules.report.create');
    Route::post('exams/{exam}/exam_schedules/{exam_schedule}/report/store', [Staff_ReportController::class, 'store'])->name('staff.exams.exam_schedules.report.store');


    // Malpractice
    Route::get('exams/malpractice', [Staff_MalpracticeController::class, 'index'])->name('staff.exams.malpractice.index');
    Route::get('exams/malpractice/show', [Staff_MalpracticeController::class, 'show'])->name('staff.exams.malpractice.show');
    Route::get('exams/{exam}/exam_schedules/{exam_schedule}/malpractice/create', [Staff_MalpracticeController::class, 'create'])->name('staff.exams.exam_schedules.malpractice.create');
    Route::post('exams/{exam}/exam_schedules/{exam_schedule}/malpractice/store', [Staff_MalpracticeController::class, 'store'])->name('staff.exams.exam_schedules.malpractice.store');


    // Announcement
    Route::get('announcements', [Staff_AnnouncementController::class, 'index'])->name('staff.announcements.index');
    Route::get('announcements/{announcement}/show', [Staff_AnnouncementController::class, 'show'])->name('staff.announcements.show');

    Route::post('announcements/{announcement}/comments/store', [Staff_AnnouncementController::class, 'store_comment'])->name('staff.announcements.comments.store');
    Route::delete('announcements/{comment}/comments/delete', [Staff_AnnouncementController::class, 'delete_comment'])->name('staff.announcements.comments.delete_comment');
   

    // HOD
    Route::get('users/hod/my_department', [Staff_HodController::class, 'index'])->name('staff.hod.department.index');
    Route::get('users/hod/department/courses/{course}/show', [Staff_CourseController::class, 'show'])->name('staff.hod.department.course.show');

    Route::get('users/courses/my_courses', [Staff_CourseController::class, 'my_courses'])->name('staff.courses.my_courses');


    
    
    // 

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
    Route::get('departments/get_departments_by_college', [Admin_DepartmentController::class, 'get_departments_by_college'])->name('admin.departments.get_departments_by_college');


    // Staff
    Route::get('staff', [Admin_StaffController::class, 'index'])->name('admin.staff.index');
    Route::get('staff/create', [Admin_StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('staff/store', [Admin_StaffController::class, 'store'])->name('admin.staff.store');

    Route::get('staff/{staff}/edit', [Admin_StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::post('staff/{staff}/update', [Admin_StaffController::class, 'update'])->name('admin.staff.update');

    Route::get('staff/{user}/confirm_delete', [Admin_StaffController::class, 'confirm_delete'])->name('admin.staff.confirm_delete');
    Route::delete('staff/{user}/delete', [Admin_StaffController::class, 'destroy'])->name('admin.staff.delete');


    Route::get('staff/fetch_staff', [Admin_StaffController::class, 'fetch_staff'])->name('admin.staff.fetch_staff');

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

    Route::get('courses/fetch_course', [Admin_CourseController::class, 'fetch_course'])->name('admin.courses.fetch_course');


    // Remuneration rates
    Route::get('remuneration_rates', [Admin_RemunerationRateController::class, 'index'])->name('admin.remuneration_rates.index');
    Route::get('remuneration_rates/create', [Admin_RemunerationRateController::class, 'create'])->name('admin.remuneration_rates.create');
    Route::post('remuneration_rates/store', [Admin_RemunerationRateController::class, 'store'])->name('admin.remuneration_rates.store');
    Route::get('remuneration_rates/{rate}/show', [Admin_RemunerationRateController::class, 'show'])->name('admin.remuneration_rates.show');
    Route::get('remuneration_rates/{rate}/edit', [Admin_RemunerationRateController::class, 'edit'])->name('admin.remuneration_rates.edit');
    Route::post('remuneration_rates/{rate}/update', [Admin_RemunerationRateController::class, 'update'])->name('admin.remuneration_rates.update');
    Route::get('remuneration_rates/{rate}/confirm_delete', [Admin_RemunerationRateController::class, 'confirm_delete'])->name('admin.remuneration_rates.confirm_delete');
    Route::post('remuneration_rates/{rate}/delete', [Admin_RemunerationRateController::class, 'destroy'])->name('admin.remuneration_rates.delete');



    // Venue Types
    Route::get('venue_types', [Admin_VenueTypeController::class, 'index'])->name('admin.venue_types.index');
    Route::get('venue_types/create', [Admin_VenueTypeController::class, 'create'])->name('admin.venue_types.create');
    Route::post('venue_types/store', [Admin_VenueTypeController::class, 'store'])->name('admin.venue_types.store');
    Route::get('venue_types/{venue_type}/edit', [Admin_VenueTypeController::class, 'edit'])->name('admin.venue_types.edit');
    Route::post('venue_types/{venue_type}/update', [Admin_VenueTypeController::class, 'update'])->name('admin.venue_types.update');
    Route::get('venue_types/{venue_type}/confirm_delete', [Admin_VenueTypeController::class, 'confirm_delete'])->name('admin.venue_types.confirm_delete');
    Route::delete('venue_types/{venue_type}/delete', [Admin_VenueTypeController::class, 'delete'])->name('admin.venue_types.delete');


    // Venue Category
    Route::get('venue_categories', [Admin_VenueCategoryController::class, 'index'])->name('admin.venue_categories.index');
    Route::get('venue_categories/create', [Admin_VenueCategoryController::class, 'create'])->name('admin.venue_categories.create');
    Route::get('venue_categories/{category}/show', [Admin_VenueCategoryController::class, 'show'])->name('admin.venue_categories.show');
    Route::post('venue_categories/store', [Admin_VenueCategoryController::class, 'store'])->name('admin.venue_categories.store');
    Route::get('venue_categories/{venue_category}/edit', [Admin_VenueCategoryController::class, 'edit'])->name('admin.venue_categories.edit');
    Route::post('venue_categories/{venue_category}/update', [Admin_VenueCategoryController::class, 'update'])->name('admin.venue_categories.update');
    Route::get('venue_categories/{venue_category}/confirm_delete', [Admin_VenueCategoryController::class, 'confirm_delete'])->name('admin.venue_categories.confirm_delete');
    Route::delete('venue_categories/{venue_category}/delete', [Admin_VenueCategoryController::class, 'delete'])->name('admin.venue_categories.delete');
    

    // Venue Category Group
    Route::get('venue_categories_group', [Admin_VenueCategoryGroupController::class, 'index'])->name('admin.venue_categories_group.index');
    Route::get('venue_categories_group/create', [Admin_VenueCategoryGroupController::class, 'create'])->name('admin.venue_categories_group.create');
    Route::post('venue_categories_group/store', [Admin_VenueCategoryGroupController::class, 'store'])->name('admin.venue_categories_group.store');
    Route::get('venue_categories_group/{group}/show', [Admin_VenueCategoryGroupController::class, 'show'])->name('admin.venue_categories_group.show');
    Route::get('venue_categories_group/{group}/edit', [Admin_VenueCategoryGroupController::class, 'edit'])->name('admin.venue_categories_group.edit');
    Route::post('venue_categories_group/{group}/update', [Admin_VenueCategoryGroupController::class, 'update'])->name('admin.venue_categories_group.update');
    Route::get('venue_categories_group/{group}/confirm_delete', [Admin_VenueCategoryGroupController::class, 'confirm_delete'])->name('admin.venue_categories_group.confirm_delete');
    Route::delete('venue_categories_group/{group}/delete', [Admin_VenueCategoryGroupController::class, 'delete'])->name('admin.venue_categories_group.delete');


    Route::get('venue_categories_group/{group}/add_category', [Admin_VenueCategoryGroupController::class, 'add_category'])->name('admin.venue_categories_group.add_category');
    Route::post('venue_categories_group/{group}/add_category', [Admin_VenueCategoryGroupController::class, 'store_category'])->name('admin.venue_categories_group.store_category');
    Route::post('venue_categories_group/{group_item}/remove_category', [Admin_VenueCategoryGroupController::class, 'remove_category'])->name('admin.venue_categories_group.remove_category');



    // Create Venue
    Route::get('venues', [Admin_VenueController::class, 'index'])->name('admin.venues.index');
    Route::get('venues/create', [Admin_VenueController::class, 'create'])->name('admin.venues.create');
    Route::post('venues/store', [Admin_VenueController::class, 'store'])->name('admin.venues.store');
    Route::get('venues/{venue}/show', [Admin_VenueController::class, 'show'])->name('admin.venues.show');
    Route::get('venues/{venue}/edit', [Admin_VenueController::class, 'edit'])->name('admin.venues.edit');
    Route::post('venues/{venue}/update', [Admin_VenueController::class, 'update'])->name('admin.venues.update');
    Route::get('venues/{venue}/confirm_delete', [Admin_VenueController::class, 'confirm_delete'])->name('admin.venues.confirm_delete');
    Route::delete('venues/{venue}/delete', [Admin_VenueController::class, 'destroy'])->name('admin.venues.delete');    


    // Staff Title
    Route::get('staff/titles', [Admin_StaffTitleController::class, 'index'])->name('admin.staff.titles.index');
    Route::get('staff/titles/create', [Admin_StaffTitleController::class, 'create'])->name('admin.staff.titles.create');
    Route::get('staff/titles/{title}/show', [Admin_StaffTitleController::class, 'show'])->name('admin.staff.titles.show');
    Route::post('staff/titles/store', [Admin_StaffTitleController::class, 'store'])->name('admin.staff.titles.store');
    Route::get('staff/titles/{title}/edit', [Admin_StaffTitleController::class, 'edit'])->name('admin.staff.titles.edit');
    Route::post('staff/titles/{title}/update', [Admin_StaffTitleController::class, 'update'])->name('admin.staff.titles.update');
    Route::get('staff/titles/{title}/confirm_delete', [Admin_StaffTitleController::class, 'confirm_delete'])->name('admin.staff.titles.confirm_delete');
    Route::delete('staff/titles/{title}/delete', [Admin_StaffTitleController::class, 'destroy'])->name('admin.staff.titles.destroy');



    // Staff Status
    Route::get('staff/statuses', [Admin_StaffStatusController::class, 'index'])->name('admin.staff.statuses.index');
    Route::get('staff/statuses/create', [Admin_StaffStatusController::class, 'create'])->name('admin.staff.statuses.create');
    Route::get('staff/statuses/{status}/show', [Admin_StaffStatusController::class, 'show'])->name('admin.staff.statuses.show');
    Route::post('staff/statuses/store', [Admin_StaffStatusController::class, 'store'])->name('admin.staff.statuses.store');
    Route::get('staff/statuses/{status}/edit', [Admin_StaffStatusController::class, 'edit'])->name('admin.staff.statuses.edit');
    Route::post('staff/statuses/{status}/update', [Admin_StaffStatusController::class, 'update'])->name('admin.staff.statuses.update');
    Route::get('staff/statuses/{status}/confirm_delete', [Admin_StaffStatusController::class, 'confirm_delete'])->name('admin.staff.statuses.confirm_delete');
    Route::delete('staff/statuses/{status}/delete', [Admin_StaffStatusController::class, 'destroy'])->name('admin.staff.statuses.destroy');


     // Staff Role
     Route::get('staff/roles', [Admin_StaffRoleController::class, 'index'])->name('admin.staff.roles.index');
     Route::get('staff/roles/create', [Admin_StaffRoleController::class, 'create'])->name('admin.staff.roles.create');
     Route::get('staff/roles/{role}/show', [Admin_StaffRoleController::class, 'show'])->name('admin.staff.roles.show');
     Route::post('staff/roles/store', [Admin_StaffRoleController::class, 'store'])->name('admin.staff.roles.store');
     Route::get('staff/roles/{role}/edit', [Admin_StaffRoleController::class, 'edit'])->name('admin.staff.roles.edit');
     Route::post('staff/roles/{role}/update', [Admin_StaffRoleController::class, 'update'])->name('admin.staff.roles.update');
     Route::get('staff/roles/{role}/confirm_delete', [Admin_StaffRoleController::class, 'confirm_delete'])->name('admin.staff.roles.confirm_delete');
     Route::delete('staff/roles/{role}/delete', [Admin_StaffRoleController::class, 'destroy'])->name('admin.staff.roles.destroy');


     // Assign Role
     Route::get('staff/roles/assign_role/create', [Admin_StaffRoleController::class, 'assign_role'])->name('admin.staff.roles.assign_role.create');
     Route::get('staff/roles/{role}/assign_role', [Admin_StaffRoleController::class, 'assign_role'])->name('admin.staff.roles.assign_role');
     Route::post('staff/roles/{role}/assign_role/store', [Admin_StaffRoleController::class, 'store_assign_role'])->name('admin.staff.roles.store_assign_role');


     Route::post('staff/roles/{assigned_role}/remove', [Admin_StaffRoleController::class, 'remove_assigned_role'])->name('admin.staff.roles.remove_assigned_role');
    

     // Exam Types
     Route::get('exams/exam_types', [Admin_ExamTypeController::class, 'index'])->name('admin.exams.exam_types.index');
     Route::get('exams/exam_types/create', [Admin_ExamTypeController::class, 'create'])->name('admin.exams.exam_types.create');
     Route::post('exams/exam_types/store', [Admin_ExamTypeController::class, 'store'])->name('admin.exams.exam_types.store');
     Route::get('exams/exam_types/{exam_type}/edit', [Admin_ExamTypeController::class, 'edit'])->name('admin.exams.exam_types.edit');
     Route::post('exams/exam_types/{exam_type}/update', [Admin_ExamTypeController::class, 'update'])->name('admin.exams.exam_types.update');
     Route::get('exams/exam_types/{exam_type}/confirm_delete', [Admin_ExamTypeController::class, 'confirm_delete'])->name('admin.exams.exam_types.confirm_delete');
     Route::delete('exams/exam_types/{exam_type}/delete', [Admin_ExamTypeController::class, 'destroy'])->name('admin.exams.exam_types.delete');


     // Exam Time Period     
     Route::get('exams/exam_time_periods', [Admin_ExamTimePeriodController::class, 'index'])->name('admin.exams.exam_time_periods.index');
     Route::get('exams/exam_time_periods/create', [Admin_ExamTimePeriodController::class, 'create'])->name('admin.exams.exam_time_periods.create');
     Route::post('exams/exam_time_periods/store', [Admin_ExamTimePeriodController::class, 'store'])->name('admin.exams.exam_time_periods.store');
     Route::get('exams/exam_time_periods/{exam_time_period}/edit', [Admin_ExamTimePeriodController::class, 'edit'])->name('admin.exams.exam_time_periods.edit');
     Route::post('exams/exam_time_periods/{exam_time_period}/update', [Admin_ExamTimePeriodController::class, 'update'])->name('admin.exams.exam_time_periods.update');
     Route::get('exams/exam_time_periods/{exam_time_period}/confirm_delete', [Admin_ExamTimePeriodController::class, 'confirm_delete'])->name('admin.exams.exam_time_periods.confirm_delete');
     Route::delete('exams/exam_time_periods/{exam_time_period}/delete', [Admin_ExamTimePeriodController::class, 'destroy'])->name('admin.exams.exam_time_periods.delete');


      // Exam Day    
      Route::get('exams/exam_days', [Admin_ExamDayController::class, 'index'])->name('admin.exams.exam_days.index');
      Route::get('exams/exam_days/create', [Admin_ExamDayController::class, 'create'])->name('admin.exams.exam_days.create');
      Route::post('exams/exam_days/store', [Admin_ExamDayController::class, 'store'])->name('admin.exams.exam_days.store');
      Route::get('exams/exam_days/{exam_day}/edit', [Admin_ExamDayController::class, 'edit'])->name('admin.exams.exam_days.edit');
      Route::post('exams/exam_days/{exam_day}/update', [Admin_ExamDayController::class, 'update'])->name('admin.exams.exam_days.update');
      Route::get('exams/exam_days/{exam_day}/confirm_delete', [Admin_ExamDayController::class, 'confirm_delete'])->name('admin.exams.exam_days.confirm_delete');
      Route::delete('exams/exam_days/{exam_day}/delete', [Admin_ExamDayController::class, 'destroy'])->name('admin.exams.exam_days.delete');
 
      Route::get('exams/exam_days/select_exam_days', [Admin_ExamDayController::class, 'select_exam_days'])->name('admin.exams.exam_days.select_exam_days');
      Route::post('exams/exam_days/select_exam_days', [Admin_ExamDayController::class, 'load_exam_day_schedule'])->name('admin.exams.exam_days.load_exam_day_schedule');
      Route::get('exams/exam_days/day/{exam_day}/exam_schedule', [Admin_ExamDayController::class, 'exam_day_schedule'])->name('admin.exams.exam_days.exam_day_schedule');  


      // Exams
      Route::get('exams', [Admin_ExamController::class, 'index'])->name('admin.exams.index');
      Route::get('exams/create', [Admin_ExamController::class, 'create'])->name('admin.exams.create');
      Route::post('exams/store', [Admin_ExamController::class, 'store'])->name('admin.exams.store');
      Route::get('exams/{exam}/show', [Admin_ExamController::class, 'show'])->name('admin.exams.show');
      Route::get('exams/{exam}/edit', [Admin_ExamController::class, 'edit'])->name('admin.exams.edit');
      Route::post('exams/{exam}/update', [Admin_ExamController::class, 'update'])->name('admin.exams.update');
      Route::get('exams/{exam}/confirm_delete', [Admin_ExamController::class, 'confirm_delete'])->name('admin.exams.confirm_delete');
      Route::delete('exams/{exam}/delete', [Admin_ExamController::class, 'destroy'])->name('admin.exams.delete');


    //   // Exam Day
      //Route::get('exams/days', [Admin_ExamDayController::class, 'index'])->name('admin.exams.days.index');
      Route::get('exams/{exam}/days', [Admin_ExamDayController::class, 'index'])->name('admin.exams.days.index');
      Route::get('exams/{exam}/days/create', [Admin_ExamDayController::class, 'create'])->name('admin.exams.days.create');
      Route::post('exams/{exam}/days/store', [Admin_ExamDayController::class, 'store'])->name('admin.exams.days.store');
      Route::get('exams/{exam}/days/{day}/edit', [Admin_ExamDayController::class, 'edit'])->name('admin.exams.days.edit');
      Route::post('exams/{exam}/days/{day}/update', [Admin_ExamDayController::class, 'update'])->name('admin.exams.days.update');
      Route::get('exams/{exam}/days/{day}/confirm_delete', [Admin_ExamDayController::class, 'confirm_delete'])->name('admin.exams.days.confirm_delete');
      Route::delete('exams/{exam}/days/{day}/delete', [Admin_ExamDayController::class, 'destroy'])->name('admin.exams.days.delete');


      // Exam Scheduler
      Route::get('exams/exam_scheduler/exam_day/select', [Admin_ExamSchedulerController::class, 'select_exam_day'])->name('admin.exams.exam_scheduler.select_exam_day');
      Route::post('exams/exam_scheduler/exam_day/select', [Admin_ExamSchedulerController::class, 'load_scheduler'])->name('admin.exams.exam_scheduler.load_scheduler');
      Route::get('exams/exam_scheduler/{exam_day}/scheduler', [Admin_ExamSchedulerController::class, 'scheduler'])->name('admin.exams.exam_scheduler.scheduler');
      Route::post('exams/exam_scheduler/{exam_day}/scheduler', [Admin_ExamSchedulerController::class, 'post_scheduler'])->name('admin.exams.exam_scheduler.post_scheduler');
      Route::get('exams/exam_scheduler/scheduler/{schedule}/edit', [Admin_ExamSchedulerController::class, 'edit_schedule'])->name('admin.exams.exam_scheduler.schedule.edit');
      Route::post('exams/exam_scheduler/scheduler/{schedule}/update', [Admin_ExamSchedulerController::class, 'update_schedule'])->name('admin.exams.exam_scheduler.schedule.update');
      Route::delete('exams/exam_scheduler/scheduler/{schedule}/destroy', [Admin_ExamSchedulerController::class, 'destroy'])->name('admin.exams.exam_scheduler.schedule.delete');

      

      //Add Support Venue
      Route::get('exams/exam_scheduler/{exam_day}/scheduler/{schedule}/support_venue', [Admin_SupportVenueController::class, 'index'])->name('admin.exams.exam_scheduler.support_venue.index');
      Route::post('exams/exam_scheduler/{exam_day}/scheduler/{schedule}/support_venue', [Admin_SupportVenueController::class, 'store'])->name('admin.exams.exam_scheduler.support_venue.store');
      Route::delete('exams/exam_scheduler/support_venues/{support_venue}/delete', [Admin_SupportVenueController::class, 'destroy'])->name('admin.exams.exam_scheduler.support_venue.delete');



      // Invigilator Allocation
      Route::get('exams/invigilator_allocation/exam_day/select', [Admin_InvigilatorAllocationController::class, 'select_exam_day'] )->name('admin.exams.invigilator_allocation.select_exam_day');
      Route::post('exams/invigilator_allocation/exam_day/select', [Admin_InvigilatorAllocationController::class, 'load_allocator'] )->name('admin.exams.invigilator_allocation.load_invigilator_allocator');
      Route::get('exams/invigilator_allocation/{exam_day}/allocator', [Admin_InvigilatorAllocationController::class, 'allocator'] )->name('admin.exams.invigilator_allocation.allocator');
      Route::post('exams/invigilator_allocation/{exam_day}/allocator', [Admin_InvigilatorAllocationController::class, 'post_allocator'] )->name('admin.exams.invigilator_allocation.post_allocator');
      Route::get('exams/invigilator_allocation/allocator/{allocation}/edit', [Admin_InvigilatorAllocationController::class, 'update_allocation'] )->name('admin.exams.invigilator_allocation.update_allocation');
      Route::delete('exams/invigilator_allocation/allocator/{allocation}/destroy', [Admin_InvigilatorAllocationController::class, 'destroy'] )->name('admin.exams.invigilator_allocation.destroy');
      
      Route::get('exams/{exam}/invigilator_allocation/automatic_allocation', [Admin_AutomaticInvigilatorAllocationController::class, 'index'])->name('admin.exams.invigilator_allocation.automatic_allocation');

      Route::get('invigilators/fetch_invigilator', [Admin_InvigilatorAllocationController::class, 'fetch_invigilator'])->name('admin.invigilators.fetch_invigilator');


       // Chief  Allocation
       Route::get('exams/chief_allocation/exam_day/select', [Admin_ChiefAllocationController::class, 'select_exam_day'] )->name('admin.exams.chief_allocation.select_exam_day');
       Route::post('exams/chief_allocation/exam_day/select', [Admin_ChiefAllocationController::class, 'load_allocator'] )->name('admin.exams.chief_allocation.load_chief_allocator');
       Route::get('exams/chief_allocation/{exam_day}/allocator', [Admin_ChiefAllocationController::class, 'allocator'] )->name('admin.exams.chief_allocation.allocator');
       Route::post('exams/chief_allocation/{exam_day}/allocator', [Admin_ChiefAllocationController::class, 'post_allocator'] )->name('admin.exams.chief_allocation.post_allocator');
       Route::get('exams/chief_allocation/allocator/{allocation}/edit', [Admin_ChiefAllocationController::class, 'update_allocation'] )->name('admin.exams.chief_allocation.update_allocation');
       Route::delete('exams/chief_allocation/allocator/{allocation}/destroy', [Admin_ChiefAllocationController::class, 'destroy'] )->name('admin.exams.chief_allocation.destroy');


       // TIMTEC  Allocation
       Route::get('exams/timtec_allocation/exam_day/select', [Admin_TimtecAllocationController::class, 'select_exam_day'] )->name('admin.exams.timtec_allocation.select_exam_day');
       Route::post('exams/timtec_allocation/exam_day/select', [Admin_TimtecAllocationController::class, 'load_allocator'] )->name('admin.exams.timtec_allocation.load_timtec_allocator');
       Route::get('exams/timtec_allocation/{exam_day}/allocator', [Admin_TimtecAllocationController::class, 'allocator'] )->name('admin.exams.timtec_allocation.allocator');
       Route::post('exams/timtec_allocation/{exam_day}/allocator', [Admin_TimtecAllocationController::class, 'post_allocator'] )->name('admin.exams.timtec_allocation.post_allocator');
       Route::get('exams/timtec_allocation/allocator/{allocation}/edit', [Admin_TimtecAllocationController::class, 'update_allocation'] )->name('admin.exams.timtec_allocation.update_allocation');
       Route::delete('exams/timtec_allocation/allocator/{allocation}/destroy', [Admin_TimtecAllocationController::class, 'destroy'] )->name('admin.exams.timtec_allocation.destroy');


       // HOD
       Route::get('departments/hods', [Admin_HodController::class, 'index'])->name('admin.departments.hods.index');
       Route::get('departments/{department}/hods/create', [Admin_HodController::class, 'create'])->name('admin.departments.hods.create');
       Route::post('departments/{department}/hods/store', [Admin_HodController::class, 'store'])->name('admin.departments.hods.store');
       Route::get('departments/{department}/hods/{hod}/edit', [Admin_HodController::class, 'edit'])->name('admin.departments.hods.edit');
       Route::post('departments/{department}/hods/{hod}/update', [Admin_HodController::class, 'update'])->name('admin.departments.hods.update');


       // Course Coordinator
       Route::get('courses/coordinators', [Admin_CourseCoordinatorController::class, 'index'])->name('admin.courses.coordinators.index');
       Route::get('courses/{course}/coordinators/create', [Admin_CourseCoordinatorController::class, 'create'])->name('admin.courses.coordinators.create');
       Route::post('courses/{course}/coordinators/store', [Admin_CourseCoordinatorController::class, 'store'])->name('admin.courses.coordinators.store');
       Route::delete('course/{course}/coordinators/{coordinator}/delete', [Admin_CourseCoordinatorController::class, 'destroy'])->name('admin.courses.coordinators.delete');


       // Monitoring Chief
       Route::get('monitoring/chiefs/select_exam_chief', [Admin_MonitoringChiefController::class, 'select_exam_chief'])->name('admin.monitoring.chiefs.select_exam_chief');

       // Monitoring Timtec 
       Route::get('monitoring/timtecs/select_exam_timtec', [Admin_MonitoringTimtecController::class, 'select_exam_timtec'])->name('admin.monitoring.timtecs.select_exam_timtec');
       Route::get('monitoring/exams/{exam}/timtecs/{timtec_member}/observations', [Admin_MonitoringTimtecController::class, 'timtec_observation'])->name('admin.monitoring.exams.timtecs.observations');



       // Monitoring Invigilator
       Route::get('monitoring/invigilators/select_exam_invigilator', [Admin_MonitoringInvigilatorController::class, 'select_exam_invigilator'])->name('admin.monitoring.invigilators.select_exam_invigilator');
       Route::get('monitoring/exams/{exam}/invigilators/{invigilator}/invigilation', [Admin_MonitoringInvigilatorController::class, 'invigilations'])->name('admin.monitoring.exams.invigilators.invigilations');


       // Create Announcement
       Route::get('announcements', [Admin_AnnouncementController::class, 'index'])->name('admin.announcements.index');
       Route::get('announcements/{announcement}/show', [Admin_AnnouncementController::class, 'show'])->name('admin.announcements.show');

       Route::get('announcements/create', [Admin_AnnouncementController::class, 'create'])->name('admin.announcements.create');

       Route::post('announcements/store', [Admin_AnnouncementController::class, 'store'])->name('admin.announcements.store');

       Route::post('announcements/{announcement}/comments/store', [Admin_AnnouncementController::class, 'store_comment'])->name('admin.announcements.comments.store');
       Route::delete('announcements/{comment}/comments/delete', [Admin_AnnouncementController::class, 'delete_comment'])->name('admin.announcements.comments.delete_comment');
        
       Route::get('announcements/{announcement}/notify', [Admin_AnnouncementController::class, 'notify'])->name('admin.announcements.notify');
       Route::post('announcements/{announcement}/notify', [Admin_AnnouncementController::class, 'post_notify'])->name('admin.announcements.post_notify');

       Route::get('announcements/{announcement}/edit', [Admin_AnnouncementController::class, 'edit'])->name('admin.announcements.edit');
       Route::post('announcements/{announcement}/update', [Admin_AnnouncementController::class, 'update'])->name('admin.announcements.update');

       Route::get('announcements/{announcement}/confirm_delete', [Admin_AnnouncementController::class, 'confirm_delete'])->name('admin.announcements.confirm_delete');
       Route::delete('announcements/{announcement}/delete', [Admin_AnnouncementController::class, 'destroy'])->name('admin.announcements.delete');

       Route::get('announcements/{announcement}/delete_file', [Admin_AnnouncementController::class, 'delete_file'])->name('admin.announcements.delete_file');



       // Course Enrolment
       Route::get('courses/{course}/enrolments/{semester}/enrolment', [Admin_CourseEnrolmentController::class, 'get_enrolment'])->name('admin.courses.enrolments.enrolment');
       Route::post('courses/{course}/enrolments/enrolment', [Admin_CourseEnrolmentController::class, 'set_enrolment'])->name('admin.courses.enrolments.set_enrolment');



       // Availability List
       Route::get('exams/availability_list', [Admin_AvailabilityListController::class, 'index'])->name('admin.exams.availability_list.index');
       Route::get('exams/availability_list/create', [Admin_AvailabilityListController::class, 'create'])->name('admin.exams.availability_list.create');
       Route::post('exams/availability_list/upload', [Admin_AvailabilityListController::class, 'upload'])->name('admin.exams.availability_list.upload');
       Route::delete('exams/availability_list/{user}/delete', [Admin_AvailabilityListController::class, 'destroy'])->name('admin.exams.availability_list.delete');
       Route::get('exams/availability_list/confirm_truncate', [Admin_AvailabilityListController::class, 'confirm_truncate'])->name('admin.exams.availability_list.confirm_truncate');
       Route::delete('exams/availability_list/truncate', [Admin_AvailabilityListController::class, 'truncate_list'])->name('admin.exams.availability_list.truncate_list');



       // Allocation Statistics
       Route::get('exams/allocation_statistics/select_exam', [Admin_AllocationStatisticController::class, 'select_exam'])->name('admin.exams.allocation_statistics.select_exam');
       Route::get('exams/{exam}/allocation_statistics', [Admin_AllocationStatisticController::class, 'index'])->name('admin.exams.allocation_statistics.index');

       
    });    








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php';
