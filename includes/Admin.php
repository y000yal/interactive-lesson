<?php

declare(strict_types=1);

namespace InteractiveLesson;

use InteractiveLesson\Blocks\InteractiveLessonBlocks;
use InteractiveLesson\Customs\RegisterCustoms;

final class Admin
{
	public function __construct()
	{
		add_action('init', [$this, 'register_content_types']);
		$this->init_classes();
	}

	public function init_classes(  ): void {
		new InteractiveLessonBlocks();
	}

	public function register_content_types(): void
	{
		RegisterCustoms::register_post_type();
		RegisterCustoms::register_taxonomy();
	}
}
