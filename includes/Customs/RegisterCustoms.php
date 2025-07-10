<?php

declare(strict_types=1);

namespace InteractiveLesson\Customs;

final class RegisterCustoms
{
	public static function register_post_type(): void
	{
		register_post_type('interactive_lesson', [
			'labels' => [
				'name' => 'Interactive Lessons',
				'singular_name' => 'Interactive Lesson',
			],
			'public' => false,
			'show_ui' => false,
			'show_in_rest' => true,
			'has_archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'supports' => ['title', 'editor', 'custom-fields']
		]);
	}

	public static function register_taxonomy(): void
	{
		register_taxonomy('grade_level', 'interactive_lesson', [
			'labels' => [
				'name' => 'Grade Levels',
				'singular_name' => 'Grade Level',
			],
			'public' => false,
			'show_ui' => false,
			'has_archive' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'hierarchical' => true,
			'show_in_rest' => true,
		]);
	}
}
