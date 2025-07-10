import { useEffect } from '@wordpress/element';
import { useState } from '@wordpress/element';
import { TextareaControl } from '@wordpress/components';

const Edit = ({ attributes, setAttributes }) => {
    const [jsonInput, setJsonInput] = useState(attributes.quizJSON);

    // Auto-format on blur
    const handleBlur = () => {
        try {
            const parsed = JSON.parse(jsonInput);
            const formatted = JSON.stringify(parsed, null, 2);
            setJsonInput(formatted);
            setAttributes({ quizJSON: formatted });
        } catch (e) {
            // Optional: Handle parse error (e.g., show warning)
            console.warn('Invalid JSON:', e);
        }
    };

    // Update state on typing
    const handleChange = (value) => {
        setJsonInput(value);
    };

    return (
        <div className="interactive-lesson-quiz-editor">
            <TextareaControl
                label="Quiz JSON"
                help="Paste or edit your quiz JSON here. It will be auto-formatted."
                value={jsonInput}
                onChange={handleChange}
                onBlur={handleBlur}
                rows={12}
            />
        </div>
    );
};

export default Edit;
