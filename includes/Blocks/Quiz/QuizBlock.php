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
	protected function build_html($content) {
		$attr = $this->attributes;
		$json = !empty($attr['quizJSON']) ? $attr['quizJSON'] : '';

		if (empty($json)) {
			$message = __("No data available", "interactive-lesson");
			return "<p>$message</p>";
		}

		$quiz_data = json_decode($json, true);
		if (!is_array($quiz_data) || empty($quiz_data['questions'])) {
			$message = __("Invalid quiz data", "interactive-lesson");
			return "<p>$message</p>";
		}

		ob_start();

		$title = esc_html($quiz_data['title'] ?? __('Quiz', 'interactive-lesson'));
		?>
        <div class="interactive-quiz" data-lesson-id="<?php echo esc_attr($this->attributes['id'] ?? ''); ?>">
            <form class="interactive-quiz-form">
                <h2><?php echo $title; ?></h2>

				<?php foreach ($quiz_data['questions'] as $index => $question): ?>
                    <div class="interactive-quiz-question">
                        <p class="question-text"><?php echo esc_html($question['question']); ?></p>

                        <div class="interactive-quiz-options two-column">
							<?php foreach ($question['options'] as $opt_index => $option): ?>
								<?php $input_id = "q{$index}_opt{$opt_index}"; ?>
                                <div class="interactive-quiz-option">
                                    <input
                                            type="radio"
                                            name="question_<?php echo esc_attr($index); ?>"
                                            id="<?php echo esc_attr($input_id); ?>"
                                            value="<?php echo esc_attr($option); ?>"
                                            required
                                    />
                                    <label for="<?php echo esc_attr($input_id); ?>">
										<?php echo esc_html($option); ?>
                                    </label>
                                </div>
							<?php endforeach; ?>
                        </div>
                    </div>
				<?php endforeach; ?>

                <button type="submit"><?php esc_html_e('Submit', 'interactive-lesson'); ?></button>
            </form>
            <div class="interactive-quiz-result" style="display:none;"></div>
        </div>
		<?php

		return ob_get_clean();
	}


}
