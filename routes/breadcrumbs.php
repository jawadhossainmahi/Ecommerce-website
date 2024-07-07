<?php

// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Redirect;


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

use App\Models\Category;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
 
Breadcrumbs::for('index_cartx', function (BreadcrumbTrail $trail): void {
    $trail->push('Category', route('index_cart'));
});
 
// Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, Category $user): void {
//     $trail->parent('users.index');
 
//     $trail->push($user->name, route('users.show', $user));
// });
 
// Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, User $user): void {
//     $trail->parent('users.show');
 
//     $trail->push('Edit', route('users.edit', $user));
// });



