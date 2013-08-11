<?php

class AdminController extends Controller
{
	/**
	 * @Auth("user")
	 * @Master("admin")
	 */
	public function __construct()
	{
	}
}