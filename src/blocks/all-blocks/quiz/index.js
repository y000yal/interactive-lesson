import metadata from "./block.json";
import Edit from "./Edit";
import Save from "./Save";

export const name = metadata.name;

export const settings = {
    ...metadata,
    icon: 'editor-help',
    edit: Edit,
    save: Save,
};
