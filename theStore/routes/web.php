<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('pages.welcome');
});

Route::view('about-us', 'pages.about', [
  'page_name' => 'About Me Page',
  'page_desc' => 'About Me Description'
])->name("about");

Route::view('contact-me', 'pages.contact', [
  'page_name' => 'Contact Me Page',
  'page_desc' => 'Contact Me Description'
]);

Route::get('pages.category/{id}', function ($id) {
  $langs = [
    '1' => 'Arabic',
    '2' => 'English',
    '3' => 'French',
    '4' => 'German',
    '5' => 'Russain',
    '6' => 'swidesh'
  ];

  return view('category', [
    'page_name' => 'Categories Page',
    'page_desc' => 'Categories Description',
    'my_id' => $langs[$id] ?? "There Is no more languages :)"
  ]);
});
