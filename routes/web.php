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

Route::get('/register','homeController@register');

Route::get('/login','homeController@login')->name('login');

Route::get('/logout','homeController@logout')->name('logout');

Route::get('/register','homeController@register')->name('register');

Route::post('/login','homeController@UserLogin');

Route::get('/forget-password','homeController@forgetpassword')->name('forget-password');

Route::post('/Register','homeController@UserRegister');

Route::group(['middleware' => 'CheckLogin'], function () {

    Route::get('/','homeController@index')->name('/');

    Route::post('/subcategory-select','ProductController@SubcategorySelect');

    Route::post('/currency-country-id','GlobalController@Currency');

    Route::get('/tracking','TrackingController@Tracking');


    Route::get('/category','ProductController@category')->name('category');
    Route::get('/view-category','ProductController@ViewCategory');
    Route::post('/add-category','ProductController@AddCategory');
    Route::get('/delete-category','ProductController@DeleteCategory');
    Route::get('/view-edit-category','ProductController@ViewEditCategory');
    Route::post('/update-category','ProductController@UpdateCategory');

    Route::get('/subcategory','ProductController@subcategory')->name('subcategory');
    Route::get('/view-subcategory','ProductController@ViewSubcategory');
    Route::post('/add-subcategory','ProductController@AddSubcategory');
    Route::get('/delete-subcategory','ProductController@DeleteSubcategory');
    Route::get('/view-edit-subcategory','ProductController@ViewEditSubcategory');
    Route::post('/update-subcategory','ProductController@UpdateSubcategory');

    Route::get('/unit','ProductController@Unit')->name('unit');
    Route::get('/view-unit','ProductController@ViewUnit');
    Route::post('/add-unit','ProductController@AddUnit');
    Route::get('/delete-unit','ProductController@DeleteUnit');
    Route::get('/view-edit-unit','ProductController@ViewEditUnit');
    Route::post('/update-unit','ProductController@UpdateUnit');

    Route::get('/product','ProductController@product')->name('product');
    Route::post('/add-product','ProductController@AddProduct');
    Route::get('/view-product','ProductController@ViewProduct');
    Route::get('/view-single-product','ProductController@ViewSingleProduct');
    Route::get('/delete-item','ProductController@DeleteItem');

    Route::get('/price-list','ProductController@PriceList')->name('PriceList');
    Route::get('/view-price-list','ProductController@ViewPriceList');
    Route::post('/add-price-list','ProductController@AddPriceList');
    Route::get('/delete-price-list','ProductController@DeletePriceList');
    Route::get('/view-edit-price-list','ProductController@ViewEditPriceList');
    Route::post('/update-price-list','ProductController@UpdatePriceList');

    Route::get('/supplier','SupplierController@Supplier')->name('supplier');
    Route::post('/add-supplier','SupplierController@AddSupplier');
    Route::get('/view-supplier','SupplierController@ViewSupplier');
    Route::get('/delete-supplier','SupplierController@DeleteSupplier');

    Route::get('/supplier/{data}','SupplierController@SupplierIndividual');
    Route::get('/view-single-supplier','SupplierController@ViewSingleSupplier');

    Route::get('/customer','CustomerController@Customer')->name('customer');
    Route::post('/add-customer','CustomerController@AddCustomer')->name('add.customer');
    Route::get('/view-customer','CustomerController@ViewCustomer')->name('view.customer');
    Route::get('/delete-customer','CustomerController@DeleteCustomer')->name('delete.customer');

    Route::get('/customer/{data}','CustomerController@CustomerIndividual');
    Route::get('/view-single-customer','CustomerController@ViewSingleCustomer');

    Route::get('/expenses','ExpensesController@Expenses')->name('expenses');
    Route::get('/view-expenses','ExpensesController@ViewExpenses')->name('view.expenses');
    Route::post('/add-expenses','ExpensesController@AddExpenses');
    Route::get('/delete-expenses','ExpensesController@DeleteExpenses')->name('delete.expenses');
    Route::get('/view-edit-expenses','ExpensesController@ViewEditExpenses')->name('view.edit.expenses');
    Route::post('/update-expenses','ExpensesController@UpdateExpenses')->name('update.expenses');

    Route::get('/expenses-list','ExpensesController@ExpensesList')->name('expenses.list');
    Route::get('/view-expenses-list','ExpensesController@ViewExpensesList')->name('view.expenses.list');
    Route::post('/add-expenses-list','ExpensesController@AddExpensesList');
    Route::get('/delete-expenses-list','ExpensesController@DeleteExpensesList')->name('delete.expenses.list');
    Route::get('/view-edit-expenses-list','ExpensesController@ViewEditExpensesList')->name('view.edit.expenses.list');
    Route::post('/update-expenses-list','ExpensesController@UpdateExpensesList')->name('update.expenses.list');

    Route::get('/warehouses','WarehouseController@Warehouses')->name('warehouses');
    Route::get('/view-warehouses','WarehouseController@ViewWarehouses')->name('view.warehouses');
    Route::post('/add-warehouses','WarehouseController@AddWarehouses');
    Route::get('/delete-warehouses','WarehouseController@DeleteWarehouses')->name('delete.warehouses');
    Route::get('/view-edit-warehouses','WarehouseController@ViewEditWarehouses')->name('view.edit.warehouses');
    Route::post('/update-warehouses','WarehouseController@UpdateWarehouses')->name('update.warehouses');


});






