<?php
namespace InteractiveLesson\Blocks;

use InteractiveLesson\Blocks\Quiz\QuizBlock;

defined( 'ABSPATH' ) || exit;
/**
 * User registration blocks class.
 */
class InteractiveLessonBlocks {
	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init_hooks();
	}


	private function init_hooks(): void {
		add_filter( 'block_categories_all', array( $this, 'block_categories' ), PHP_INT_MAX, 2 );
		add_action( 'init', array( $this, 'register_block_types' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );
	}
	/**
	 * Enqueue Block Editor Assets.
	 *
	 * @return void.
	 */
	public function enqueue_block_editor_assets(): void {
		global $pagenow;
		$enqueue_script = array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-components', 'react', 'react-dom', 'tooltipster' );

		if ( 'widgets.php' === $pagenow ) {
			unset( $enqueue_script[ array_search( 'wp-editor', $enqueue_script ) ] );
		}

		wp_register_script(
			'interactive-lesson-blocks-editor',
			IL_PLUGIN_URL . 'chunks/blocks.js',
			[
				'wp-blocks',
				'wp-element',
				'wp-i18n',
				'wp-editor',
				'wp-components',
				'wp-block-editor'
			],
			IL_VERSION,
			true
		);

		wp_enqueue_style(
			'interactive-lesson-blocks-editor',
			plugin_dir_url(__FILE__) . '../../assets/css/style.css',
			array(),
			IL_VERSION
		);

		wp_enqueue_script( 'interactive-lesson-blocks-editor' );
	}

	/**
	 * Add "User Registration" category to the blocks listing in post edit screen.
	 *
	 * @param array $block_categories All registered block categories.
	 * @return array
	 * @since 3.1.5
	 */
	public function block_categories( array $block_categories ): array {

		return array_merge(
			array(
				array(
					'slug'  => 'interactive-lesson',
					'title' => esc_html__( 'Interactive Lesson', 'interactive-lesson' ),
					'icon' => '',
				),
			),
			$block_categories
		);
	}
	/**
	 * Register block types.
	 *
	 * @return void
	 */
	public function register_block_types(): void {
		$block_types = $this->get_block_types();

		foreach ( $block_types as $block_type ) {
			new $block_type();
		}
	}


	private function get_block_types() {

		$il_blocks_classes = array(
			QuizBlock::class,
		);

		return apply_filters(
			'interactive_lesson_block_types',
			$il_blocks_classes
		);
	}
}
