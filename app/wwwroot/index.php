<?php
/*
 * Copyright (c) 2011-2013, Valdirene da Cruz Neves Júnior <linkinsystem666@gmail.com>
 * All rights reserved.
 */

if(!file_exists('../app/config.php'))
{
	header('Location: install.php');
	exit;
}
require_once '../../core/bootstrap.php';
