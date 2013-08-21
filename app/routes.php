<?php
/*
 * Copyright (c) 2011, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */


/**
 * As rotas são para reescrita de URL. Veja um exemplo:
 * Route::add('^([\d]+)-([a-z0-9\-]+)$','home/view/$1/$2');
 * 
 * Também é possível criar prefixos. Veja um exemplo:
 * Route::prefix('admin');
 */

Route::prefix('admin');
Route::add('^admin/?$', 'admin/user/login');
Route::add('^([\d]{4})\/([\d]{1,2})\/([\d]{1,2})\/([a-zA-Z0-9\-]+)$', 'home/post/$4/$1/$2/$3');
Route::add('^([a-zA-Z0-9\-]+)$', 'post/index/$1');
Route::add('^category/([a-zA-Z0-9\-]+)$', 'category/category/$1');