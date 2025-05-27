<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Home;
use App\Http\Livewire\About;
use App\Http\Livewire\Blogs;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Courses;
use App\Http\Livewire\Donation;
use App\Http\Livewire\BlogDetail;
use App\Http\Livewire\CourseDetail;
use App\Http\Livewire\Auth\UserLogin;
use App\Http\Livewire\CommunityAbout;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\AdminLogin;
use App\Http\Livewire\Student\Profile;
use App\Http\Livewire\Student\Results;
use App\Http\Livewire\Auth\UserRegister;
use App\Http\Livewire\CommunityRegister;
use App\Http\Livewire\Student\Certificate;
use App\Http\Livewire\Admin\Setting\MyProfile;
use App\Http\Livewire\Admin\Setting\Languages;
use App\Http\Livewire\Admin\Setting\LanguagesIndex;
use App\Http\Livewire\Admin\Setting\EditLanguage;
use App\Http\Livewire\Admin\Blog\Add as BlogAdd;
use App\Http\Livewire\Admin\Role\Add as RoleAdd;
use App\Http\Livewire\Admin\Blog\View as BlogView;
use App\Http\Livewire\Admin\Role\View as RoleView;
use App\Http\Livewire\Auth\EmailVerificationNotice;
use App\Http\Livewire\Admin\Blog\Index as BlogIndex;
use App\Http\Livewire\Admin\Course\Add as CourseAdd;
use App\Http\Livewire\Admin\Result\Add as ResultAdd;
use App\Http\Livewire\Admin\Role\Index as RoleIndex;
use App\Http\Livewire\Admin\School\Add as SchoolAdd;
use App\Http\Livewire\Admin\Course\View as CourseView;
use App\Http\Livewire\Admin\Result\Edit as ResultEdit;
use App\Http\Livewire\Admin\Result\View as ResultView;
use App\Http\Livewire\Admin\School\View as SchoolView;
use App\Http\Livewire\Admin\Session\Add as SessionAdd;
use App\Http\Livewire\Admin\Student\Add as StudentAdd;
use App\Http\Livewire\Admin\Voucher\Add as VoucherAdd;
use App\Http\Controllers\CustomEmailVerificationRequest;
use App\Http\Controllers\MediaUploadController;
use App\Http\Livewire\Admin\Course\Index as CourseIndex;
use App\Http\Livewire\Admin\Dashboard as AdminDashboard;
use App\Http\Livewire\Admin\Result\Index as ResultIndex;
use App\Http\Livewire\Admin\School\Index as SchoolIndex;
use App\Http\Livewire\Admin\Session\View as SessionView;
use App\Http\Livewire\Admin\Student\View as StudentView;
use App\Http\Livewire\Admin\Community\Add as CommunityAdd;
use App\Http\Livewire\Admin\Session\Index as SessionIndex;
use App\Http\Livewire\Admin\Student\Index as StudentIndex;
use App\Http\Livewire\Admin\Voucher\Index as VoucherIndex;
use App\Http\Livewire\Admin\Community\View as CommunityView;
use App\Http\Livewire\Community\Profile as CommunityProfile;
use App\Http\Livewire\Community\Referrals as CommunityReferrals;
use App\Http\Livewire\Community\Resources as CommunityResources;
use App\Http\Livewire\Community\Centers as CommunityCenters;

use App\Http\Livewire\Community\Results as CommunityResults;
use App\Http\Livewire\Community\Programs as CommunityPrograms;
use App\Http\Livewire\Student\Dashboard as StudentDashboard;

use App\Http\Livewire\Admin\Community\Index as CommunityIndex;
use App\Http\Livewire\Admin\Community\Patron as CommunityPatron;

use App\Http\Livewire\Admin\Course\EditSeries;
use App\Http\Livewire\Admin\Course\EditSeriesContent;
use App\Http\Livewire\Admin\CourseCategory\Add as CourseCategoryAdd;
use App\Http\Livewire\Admin\CourseCategory\Edit as CourseCategoryEdit;
use App\Http\Livewire\Admin\CourseCategory\Index as CourseCategoryIndex;
use App\Http\Livewire\Admin\Exam\Add as ExamAdd;
use App\Http\Livewire\Admin\Exam\Index as ExamIndex;
use App\Http\Livewire\Admin\Exam\View as ExamView;
use App\Http\Livewire\Admin\LocalGovernment\Add as LocalGovernmentAdd;
use App\Http\Livewire\Admin\LocalGovernment\Index as LocalGovernmentIndex;
use App\Http\Livewire\Admin\LocalGovernment\View as LocalGovernmentView;
use App\Http\Livewire\Admin\State\Add as StateAdd;
use App\Http\Livewire\Admin\State\Index as StateIndex;
use App\Http\Livewire\Admin\State\View as StateView;
use App\Http\Livewire\Admin\TertiaryInstitution\Add as TertiaryAdd;
use App\Http\Livewire\Admin\TertiaryInstitution\Index as TertiaryIndex;
use App\Http\Livewire\Admin\TertiaryInstitution\View as TertiaryView;
use App\Http\Livewire\Admin\Town\Add as TownAdd;
use App\Http\Livewire\Admin\Town\Index as TownIndex;
use App\Http\Livewire\Admin\Town\View as TownView;
use App\Http\Livewire\Community\Dashboard as CommunityDashboard;
use App\Http\Livewire\Community\Certificate as CommunityCertificate;
use App\Http\Livewire\Community\Patron as CommunityMemberPatron;
use App\Http\Livewire\Community\ResultView as CommunityResultView;
use App\Http\Livewire\DonationSuccess;
use App\Http\Livewire\Purchase;
use App\Http\Livewire\Questionaire;
use App\Http\Livewire\QuestionaireNotice;
use App\Http\Livewire\QuestionaireSubmitted;
use App\Http\Livewire\Series;
use App\Http\Livewire\Student\ResultView as StudentResultView;
use App\Http\Livewire\Success;
use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\ResetPassword;
use App\Http\Livewire\Admin\Exam\EditQuestion;
use App\Http\Livewire\PrivacyPolicy;

use App\Http\Livewire\Admin\CommunityCenter\Add as CommunityCenterAdd;
use App\Http\Livewire\Admin\CommunityCenter\View as CommunityCenterView;
use App\Http\Livewire\Admin\CommunityCenter\Index as CommunityCenterIndex;
use App\Http\Livewire\Admin\CommunityCenter\Maintenance as CommunityMaintenance;

use App\Http\Livewire\Admin\CommunityResource\Add as CommunityResourceAdd;
use App\Http\Livewire\Admin\CommunityCenter\View as CommunityResourceView;
use App\Http\Livewire\Admin\CommunityResource\Edit as CommunityResourceEdit;
use App\Http\Livewire\Admin\CommunityResource\ViewLogs as CommunityResourceLogs;
use App\Http\Livewire\Admin\Setting\AddResourceType;

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

// App main routes
Route::middleware(['seo'])->group(function () {
    Route::get('/', Home::class)->name('index');
    Route::get('/club/about', About::class)->name('club.about');
    Route::get('/contact', Contact::class)->name('contact');
    Route::get('/programs', Courses::class)->name('courses');
    Route::get('/program/{course:slug}', CourseDetail::class)->name('course.detail');
    Route::get('/program/{course:slug}/lesson/{serial_no}', Series::class)
        ->middleware('deny.lock.lesson.access')
        ->name('course.detail.lesson');
    Route::get('/blogs', Blogs::class)->name('blogs');
    Route::get('/blog/{blog:slug}', BlogDetail::class)->name('blog.detail');
    Route::get('/communities/about', CommunityAbout::class)->name('communities.about');
    Route::get('/communities/register', CommunityRegister::class)
        ->name('communities.register')
        ->middleware('guest.community.member');
    Route::get('/donate', Donation::class)->name('donation');
    Route::get('/purchase/program/{course:slug}', Purchase::class)
        ->middleware('auth.unauthorize')
        ->name('purchase.course');
    Route::get('/transaction/success', Success::class)
        ->middleware('check.payment.complete')
        ->name('transaction.success');

    Route::get('/donation/success', DonationSuccess::class)
        // ->middleware('check.payment.complete')
        ->name('donation.success');

    // Questionaire page route
    Route::get('exam/question', Questionaire::class)
        ->middleware(['deny.access.test.page', 'exam.not.set'])
        ->name('exam.question');

    Route::get('exam/notice', QuestionaireNotice::class)
        ->middleware('exam.notice.access')
        ->name('exam.notice');

    Route::get('exam/question/submitted', QuestionaireSubmitted::class)
        ->name('exam.question.submitted');

    // Student Login & Register routes
    Route::get('/login', UserLogin::class)
    ->name('student.login')
    ->middleware('guests');

    // FORGET PASSWORD
    Route::get('/forgot-password', ForgotPassword::class)->name('forgot.password')->middleware('guests');

    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset')->middleware('guest');
 //END OF FORGET PASSWORD

    Route::get('/club/register', UserRegister::class)
    ->name('student.register')
    ->middleware(['check.portal.status', 'guest']);

    Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy.policy');
});

// Student dashboard routes
Route::middleware(['auth', 'seo'])->group(function() {
    Route::get('/student/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('/student/profile', Profile::class)->name('student.profile');
    Route::get('/student/results', Results::class)->name('student.results');
    Route::get('/student/result/view/{exam_result}', StudentResultView::class)->name('student.result.view');
    Route::get('/student/certificate', Certificate::class)->name('student.certificate');
});

// Community membership dashboard routes
Route::middleware(['auth.community', 'community.verified', 'seo'])->group(function() {
    Route::get('/community/member/dashboard', CommunityDashboard::class)->name('community.member.dashboard');
    Route::get('/community/member/profile', CommunityProfile::class)->name('community.member.profile');
    Route::get('/community/member/referrals', CommunityReferrals::class)->name('community.member.referrals');
    Route::get('/community/member/resources', CommunityResources::class)->name('community.member.resources');
    Route::get('/community/member/centers', CommunityCenters::class)->name('community.member.centers');
    Route::get('/community/member/results', CommunityResults::class)->name('community.member.results');
    Route::get('/community/member/result/view/{exam_result}', CommunityResultView::class)->name('community.member.result.view');
    Route::get('/community/member/certificate', CommunityCertificate::class)->name('community.member.certificate');
    Route::get('/community/member/patron', CommunityMemberPatron::class)->name('community.member.patron');
    // Route::get('/community/member/voucher-service', VoucherService::class)->name('community.member.voucher');
});

// Email Verification handling route
Route::get('/email/verify', EmailVerificationNotice::class)
    ->middleware(['auth.community', 'throttle:6,1'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (CustomEmailVerificationRequest $request) {
    $request->fulfill();
    $user = Auth::guard('community')->user();
    Mail::to($user)->send(new Welcome($user));
    return redirect()->route('community.member.dashboard');
})->middleware(['auth.community', 'signed'])->name('verification.verify');

// Admin Login Route
Route::get('/admin/login', AdminLogin::class)->name('admin.login')->middleware('guest.admin');

// Admin panel routes
Route::middleware('auth.admin')->group(function() {
    Route::middleware(['auth.role.super.admin'])->group(function(){
        Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/admin/students', StudentIndex::class)->name('admin.students');
        Route::get('/admin/student/add', StudentAdd::class)->name('admin.student.add');
        Route::get('/admin/student/view/{user}', StudentView::class)->name('admin.student.view');
        Route::get('/admin/programs', CourseIndex::class)->name('admin.courses');
        Route::get('/admin/program/add', CourseAdd::class)->name('admin.course.add');
        Route::get('/admin/program/view/{course}', CourseView::class)->name('admin.course.view');
        Route::get('/admin/program/view/{course}/lesson/{series}', EditSeries::class)->name('admin.course.lesson.view');
        Route::get('/admin/program/categories', CourseCategoryIndex::class)->name('admin.course.categories');
        Route::get('/admin/program/category/add', CourseCategoryAdd::class)->name('admin.course.category.add');
        Route::get('/admin/program/category/edit/{category}', CourseCategoryEdit::class)->name('admin.course.category.edit');
        Route::get('/admin/sessions', SessionIndex::class)->name('admin.sessions');
        Route::get('/admin/session/add', SessionAdd::class)->name('admin.session.add');
        Route::get('/admin/session/view/{session}', SessionView::class)->name('admin.session.view');
        Route::get('/admin/exams', ExamIndex::class)->name('admin.exams');
        Route::get('/admin/exam/add', ExamAdd::class)->name('admin.exam.add');
        Route::get('/admin/exam/view/{exam}', ExamView::class)->name('admin.exam.view');
        Route::get('/admin/exam/view/{exam}/question/{questions}', EditQuestion::class)->name('admin.exam.question.view');
        Route::get('/admin/result-management', ResultIndex::class)->name('admin.results');
        Route::get('/admin/result-management/add', ResultAdd::class)->name('admin.result.add');
        Route::get('/admin/result-management/view/{course:slug}', ResultView::class)->name('admin.result.view');
        Route::get('/admin/result-management/edit/{course:slug}', ResultEdit::class)->name('admin.result.edit');

        // Route::get('/admin/schools', SchoolIndex::class)->name('admin.schools');
        Route::get('/admin/community-center', CommunityCenterIndex::class)->name('admin.community-center');
        Route::get('/admin/community-center/maintenance', CommunityMaintenance::class)->name('admin.community-center.maintenance');
        Route::get('/admin/community-center/add', CommunityCenterAdd::class)->name('admin.community-center.add');
        Route::get('/admin/community-center/view/{center}', CommunityCenterView::class)->name('admin.community-center.view');

        Route::get('/admin/community-resource/add', CommunityResourceAdd::class)->name('admin.community-resource.add');
        Route::get('/admin/community-resource/logs/{resource}', CommunityResourceLogs::class)->name('admin.community-resource.logs');
        Route::get('/admin/community-resource/edit/{resource}', CommunityResourceEdit::class)->name('admin.community-resource.edit');
        Route::get('/admin/community-resource/view/{resource}', CommunityResourceView::class)->name('admin.community-resource.view');


        Route::get('/admin/schools', SchoolIndex::class)->name('admin.schools');
        Route::get('/admin/school/add', SchoolAdd::class)->name('admin.school.add');
        Route::get('/admin/school/view/{school}', SchoolView::class)->name('admin.school.view');

        Route::get('/admin/tertiary-institutions', TertiaryIndex::class)->name('admin.tertiary.institutions');
        Route::get('/admin/tertiary-institution/add', TertiaryAdd::class)->name('admin.tertiary.institution.add');
        Route::get('/admin/tertiary-institution/view/{tertiary_institution}', TertiaryView::class)->name('admin.tertiary.institution.view');

        Route::get('/admin/community/patrons', CommunityPatron::class)->name('admin.communities.patrons');
        Route::get('/admin/community/members', CommunityIndex::class)->name('admin.communities');
        Route::get('/admin/community/member/add', CommunityAdd::class)->name('admin.communities.add');
        Route::get('/admin/community/member/view/{member}', CommunityView::class)->name('admin.communities.view');

        Route::get('/admin/states', StateIndex::class)->name('admin.states');
        Route::get('/admin/states/add', StateAdd::class)->name('admin.states.add');
        Route::get('/admin/states/view/{state}', StateView::class)->name('admin.states.view');
        Route::get('/admin/local-governments', LocalGovernmentIndex::class)->name('admin.local.governments');
        Route::get('/admin/local-government/add', LocalGovernmentAdd::class)->name('admin.local.government.add');
        Route::get('/admin/local-government/view/{local_government}', LocalGovernmentView::class)->name('admin.local.government.view');
        Route::get('/admin/towns', TownIndex::class)->name('admin.towns');
        Route::get('/admin/towns/add', TownAdd::class)->name('admin.town.add');
        Route::get('/admin/towns/view/{town}', TownView::class)->name('admin.town.view');
        Route::get('/admin/program/view/{course}/lesson/{series}/content/{series_content}', EditSeriesContent::class)->name('admin.course.lesson.content.view');
    });

    // For general
    Route::get('/admin/blogs', BlogIndex::class)->name('admin.blogs');
    Route::get('/admin/blog/add', BlogAdd::class)->name('admin.blog.add');
    Route::get('/admin/blog/view/{blog}', BlogView::class)->name('admin.blog.view');
    Route::get('/admin/settings', MyProfile::class)->name('admin.setting');
    Route::get('/admin/settings/resource-type/add', AddResourceType::class)->name('admin.resource-type.add');
    Route::get('/admin/settings/language', Languages::class)->name('admin.language');
    Route::get('/admin/settings/editlanguage/{ContentLanguage}', EditLanguage::class)->name('admin.editlanguage');
     Route::get('/admin/settings/allthelanguages', LanguagesIndex::class)->name('admin.allthelanguages');
    // For super admin only
    Route::middleware('auth.role.super_admin')->group(function(){
        Route::get('/admin/roles', RoleIndex::class)->name('admin.roles');
        Route::get('/admin/role/add', RoleAdd::class)->name('admin.role.add');
        Route::get('/admin/role/view/{admin}', RoleView::class)->name('admin.role.view');
        Route::get('/admin/vouchers', VoucherIndex::class)->name('admin.vouchers');
        Route::get('/admin/voucher/generate', VoucherAdd::class)->name('admin.voucher.add');
    });
});

Route::post('/image/upload', [MediaUploadController::class, 'storeImage'])->name('image.upload');