<?php

return [
	'roles' => [
		'admin'
	],

	'categories' => [
		'users' => [
			'users.create',
			'users.view',
			'users.edit',
			'users.delete',
		],
		'posts' => [
			'posts.create',
			'posts.view',
			'posts.edit',
			'posts.delete',
		],
		'settings' => [
			'settings.update',
		],
	],
];
