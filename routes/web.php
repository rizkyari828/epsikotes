<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('workspace');
});
*/
Route::get('/testAPI', 'Dashboard\DasboardPage@index');

Route::get('/testExcel', 'TestExcel@index');



Route::resource('/', 'Authenticate\LoginPage');
Route::post('/processLogin', 'Authenticate\LoginPage@prosesLogin');
Route::get('/processLogin', function () {
    return redirect('/');
});
Route::get('/processLogout', 'Authenticate\LoginPage@prosesLogout');
Route::post('/checkLogin', 'Authenticate\LoginPage@checkSession');

Route::resource('/workspace', 'WorkspaceController');
Route::resource('/dashboard', 'Dashboard\DasboardPage');
Route::post('/getResultByJob', 'Dashboard\DasboardPage@getRecomendationByJob');
Route::post('/getResultByNetwork', 'Dashboard\DasboardPage@getRecomendationByNetwork');

/*start route basic setup*/
Route::resource('/peopleenter', 'Peopleentermaintenance\PeopleentermaintenancePage');
Route::resource('/peopleenteradd', 'Peopleentermaintenance\PeopleentermaintenancePageAdd');
Route::get('/peopleenterreset', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@resetPasswordPeople');
Route::post('/getRoles', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@roles');
Route::post('/peopleEnterMaintenanceProcess', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@processPeopleEnter');
Route::post('/getPeopleEnterAll', 'Peopleentermaintenance\PeopleentermaintenancePage@allPeopleEnter');
Route::post('/getEachMenu', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@eachMenu');
Route::post('/getPersonId', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@getFindUserName');
Route::post('/findUserNumber', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@findPasswordPeople');
Route::post('/getExistsUserName', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@existsUserName');
Route::post('/getExistsUserId', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@existsUserId');
Route::get('/viewPerson/{personId}/{action}/{menuType}', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@index');
Route::post('/resetPassword', 'Peopleentermaintenance\PeopleentermaintenancePageAdd@processResetPassword');
//test box html
Route::get('/testbox', 'Peopleentermaintenance\PeopleentermaintenancePage@testBox');

/*end route basic setup*/

/*start route Personel Informations*/
Route::resource('/personelinformations', 'Personeladmin\PersoneladminPage');
Route::resource('/detailpersonelinformations', 'Personeladmin\PersoneladminPageAdd');
/*end route Personel Informations*/

/*start route Norma Setup*/
Route::resource('/normasetup', 'Norma\NormaPage');
Route::resource('/normaadd', 'Norma\NormaAddPage');
Route::post('/getCategories', 'Norma\NormaPage@categories');
Route::post('/getCategoriesAll', 'Norma\NormaPage@allCategories');
Route::post('/normasetupProcess', 'Norma\NormaAddPage@processNorma');
Route::get('/normaview/{normaId}', 'Norma\NormaAddPage@index');
Route::post('/getNormaVersion', 'Norma\NormaAddPage@getNormaByVersion');
/*end route Norma Setup*/

/*start route Narration Setup*/
Route::resource('/narrationsetup', 'Questionmanagement\NarrationPage');
Route::resource('/narrationadd', 'Questionmanagement\NarrationAddPage');
Route::post('/narrationProcess', 'Questionmanagement\NarrationAddPage@processNarration');
Route::post('/getNameNarration', 'Questionmanagement\NarrationPage@getNameNarration');
Route::post('/getExistingNameNarration', 'Questionmanagement\NarrationAddPage@existsNameNarration');
Route::get('/narrationView/{narrationId}', 'Questionmanagement\NarrationAddPage@index');
/*end route Narration Setup*/

/*start route Category Setup*/
Route::resource('/categorysetup', 'Questionmanagement\CategoryPage');
Route::resource('/categoryadd', 'Questionmanagement\CategoryAddPage');
Route::post('/getSubCategories', 'Questionmanagement\CategoryPage@subCategories');
Route::post('/gategoryProcess', 'Questionmanagement\CategoryAddPage@processCategory');
Route::post('/getAllCateogry', 'Questionmanagement\CategoryPage@allCategories');
Route::get('/categoryview/{categoryId}', 'Questionmanagement\CategoryAddPage@index');
Route::get('/categoryValidate', 'Questionmanagement\CategoryAddPage@index');
Route::post('/getCategoryByVersion', 'Questionmanagement\CategoryAddPage@getCategoryByVersion');
//Route::post('/gategoryProcess', 'Questionmanagement\CategoryAddPage@processCategory');
Route::post('/getExistsCategoryName', 'Questionmanagement\CategoryAddPage@getExistsCategoryName');
/*end route Category Setup*/

/*start route Jobmapping Setup*/
Route::resource('/jobmappingsetup', 'Jobmapping\JobmappingPage');
Route::resource('/jobmappingsetupadd', 'Jobmapping\JobmappingAddPage');
Route::post('/getJobs', 'Jobmapping\JobmappingPage@jobs');
Route::post('/getJobMapping', 'Jobmapping\JobmappingPage@jobMapping');
Route::post('/getJobMappingAll', 'Jobmapping\JobmappingPage@jobMappingAll');
Route::post('/getNarrations', 'Jobmapping\JobmappingAddPage@narrations');
Route::post('/jobmappingProcess', 'Jobmapping\JobmappingAddPage@processJobMapping');
Route::get('/jobMappingView/{jobMappingId}', 'Jobmapping\JobmappingAddPage@index');
/*end route Jobmapping Setup*/

/*start route Jobmapping Setup*/
Route::resource('/psikotestschedule', 'Schedulepsikotes\SchedulepsikotesPage');
Route::resource('/psikotestscheduleadd', 'Schedulepsikotes\SchedulepsikotesPageAdd');
Route::post('/getNetworks', 'Schedulepsikotes\SchedulepsikotesPageAdd@networks');
Route::post('/getLocation', 'Schedulepsikotes\SchedulepsikotesPageAdd@locations');
Route::post('/getLastEducation', 'Schedulepsikotes\SchedulepsikotesPageAdd@lookUpLastEducations');
Route::get('/psikotestscheduledetail/{applicantId}', 'Schedulepsikotes\SchedulepsikotesPageAdd@detail');
Route::post('/psikotestScheduleProcess', 'Schedulepsikotes\SchedulepsikotesPageAdd@processScheduled');
Route::post('/psikotestRescheduleProcess', 'Schedulepsikotes\SchedulepsikotesPageAdd@processRescheduled');
Route::post('/findApplicant', 'Schedulepsikotes\SchedulepsikotesPageAdd@findApplicant');
Route::post('/getPsikotestSchedulleAll', 'Schedulepsikotes\SchedulepsikotesPage@getPsikotestSchedulleAll');
Route::post('/getUserNamePsikotest', 'Schedulepsikotes\SchedulepsikotesPage@getUserName');
Route::post('/getUserIdPsikotest', 'Schedulepsikotes\SchedulepsikotesPage@getUserId');
Route::post('/getScheduleHistory', 'Schedulepsikotes\SchedulepsikotesPageAdd@getAllScheduleHistory');
Route::get('/cancelScheduleForm/{id}', 'Schedulepsikotes\SchedulepsikotesPage@cancelScheduleForm');
Route::post('/cancelSchedule', 'Schedulepsikotes\SchedulepsikotesPage@cancelSchedule');
/*end route Jobmapping Setup*/

/*start route Psikotest Result*/
Route::resource('/psikotestresult', 'PsikotestResult\PsikotestResultPage');
Route::post('/getResultAll', 'PsikotestResult\PsikotestResultPage@getAllResult');
Route::post('/getResultByParameter', 'PsikotestResult\PsikotestResultPage@getResultByParameter');
Route::get('/reportResultExcel/{full_name}/{paramApplicantId}/{ktp}/{psi_result}/{recomendation}/{network}/{location}/{planDateFrom}/{planDateTo}/{startDateFrom}/{startDateTo}/{jobName}', 'PsikotestResult\PsikotestResultPage@reportResultExcel');
Route::get('/getResultDetail/{applicantId}/{scheduleHistoryId}', 'PsikotestResult\PsikotestResultPage@getResultDetail');
Route::get('/psychogram/{applicantId}/{name}/{jobname}/{recomendation}/{date}/{schedule}/{jobMapingId}/{jobid}', 'PsikotestResult\PsikotestResultPage@getPsychogram');
/*end route Psikotest Result*/

/*start route SubCategory Setup*/
Route::get('subcategory','SubCategoryController@index');
Route::get('sub-category','SubCategoryController@getSubCategory');
Route::get('lookup/sub-category','SubCategoryController@lookupfindByName');
Route::get('viewsubcategory/{id}','SubCategoryController@viewSubCategory');
Route::get('viewQuestion/{id}','SubCategoryController@viewQuestion');
Route::get('getViewQuestion/{id}','SubCategoryController@getViewQuestion');
Route::get('viewAnswer/{id}','SubCategoryController@viewAnswer');
Route::get('getViewAnswer/{id}/{type_answer}','SubCategoryController@getViewAnswer');
Route::get('addsubcategory','SubCategoryController@addSubCategory');
//Route::post('getSubCategories', 'SubCategoryController@subCategories');
Route::post('addSubCate', 'SubCategoryController@saveAddSubCategory');
Route::get('editsubcategory/{id}','SubCategoryController@editSubCategory');
/*end route SubCategory Setup*/


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/applicantList', 'ApplicantListController@index');
