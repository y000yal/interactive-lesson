<?php
namespace InteractiveLesson\Blocks\Quiz;

use InteractiveLesson\Blocks\BlockAbstract;

defined( 'ABSPATH' ) || exit;

/**
 * Block registration form class.
 */
class QuizBlock extends BlockAbstract {
	/**
	 * Block name.
	 *
	 * @var string Block name.
	 */
	protected string $block_name = 'quiz';

	/**
	 * build_html
	 *
	 * @param $content
	 *
	 * @return mixed|void
	 */
	protected function build_html(  $content ) {
		return $content;
	}
}
