import {registerBlockType} from "@wordpress/blocks";
import * as Quiz from './quiz'

let blocks = [
    Quiz
];
export const registerBlocks = () => {
    for (const block of blocks) {
        registerBlockType(block.name, block.settings);
    }
};

export default registerBlocks;
