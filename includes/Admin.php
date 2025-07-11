<?php

declare( strict_types=1 );

namespace InteractiveLesson;

use InteractiveLesson\Blocks\InteractiveLessonBlocks;
use InteractiveLesson\Customs\RegisterCustoms;

final class Admin {
	public function __construct() {
		add_action( 'init', [ $this, 'register_content_types' ] );
		add_action( 'wp_enqueue_scripts',  [ $this, 'enqueue_styles'] );
		$this->init_classes();
	}

	public function enqueue_styles(): void {
		wp_enqueue_style(
			'interactive-lesson-blocks-editor',
			plugin_dir_url(__FILE__) . '../assets/css/style.css',
			array(),
			IL_VERSION
		);
	}

	public function init_classes(): void {
		new InteractiveLessonBlocks();
	}

	public function register_content_types(): void {
		RegisterCustoms::register_post_type();
		RegisterCustoms::register_taxonomy();
	}
}
