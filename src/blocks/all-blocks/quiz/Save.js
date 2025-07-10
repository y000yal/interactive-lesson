export default function save({ attributes }) {
    return (
        <div
            className="interactive-lesson-quiz"
            data-quiz={attributes.quizJSON}
        >
            {/* Frontend rendering will be handled by JS later */}
            <p>This quiz will be rendered on the frontend.</p>
        </div>
    );
}
