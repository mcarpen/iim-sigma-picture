<?php

function checkRole() {
	if( is_user_logged_in() ) {
		$user = wp_get_current_user();
		$role = ( array ) $user->roles;
		if (in_array('administrator', $role)) {
			return 'admin';
		} else {
			return 'user';
		}
	}
}