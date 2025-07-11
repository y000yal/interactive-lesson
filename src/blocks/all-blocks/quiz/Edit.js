
import {Disabled, PanelBody, TextareaControl, TextControl} from '@wordpress/components';
import {InspectorControls, useBlockProps} from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import metadata from "./block.json";


const ServerSideRender = wp.serverSideRender
    ? wp.serverSideRender
    : wp.components.ServerSideRender;
const Edit = (props) => {

    const blockName = metadata.name;
    const useProps = useBlockProps();
    const {
        attributes: { quizJSON },
        setAttributes,
    } = props;
    const setJsonInput = (JSON) => {
        setAttributes({ quizJSON: JSON });
    };

    return (
        <div {...useProps}>
            <InspectorControls>
                <PanelBody title={__("Quiz Control", "interactive-lesson")}>
                    <TextareaControl
                        label={__("Insert Quiz JSON", "interactive-lesson")}
                        value={quizJSON}
                        onChange={setJsonInput}
                        rows={20}
                    />
                </PanelBody>
            </InspectorControls>
            <Disabled>
                <ServerSideRender
                    block={blockName}
                    attributes={{ ...props.attributes }}
                />
            </Disabled>

        </div>
    );
};

export default Edit;
