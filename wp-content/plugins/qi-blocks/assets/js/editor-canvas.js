/**
 * Lightweight bundle loaded INSIDE the WordPress editor canvas iframe (WP 6.3+/7.0).
 *
 * The full main-editor.js cannot run inside the iframe because it depends on the WordPress
 * editor JS stack (wp.data, wp.element, wp.blockEditor, ...) which is not present there.
 * This bundle only exposes the dependency-free helpers that other files call from within the
 * iframe context, attaching them to the same `qiBlocksEditor` global used in the parent.
 */
import qodefGetCurrentBlockElement from './parts-editor/get-current-block-element';
import qodefSetEditorLinkBehavior from './parts-editor/set-editor-link-behavior';
import qodefEditorBlockSelection from './parts-editor/editor-block-selection';

if ( typeof window.qiBlocksEditor === 'undefined' ) {
	window.qiBlocksEditor = {};
}

// Do not overwrite anything already provided (e.g. localized `vars`).
if ( typeof window.qiBlocksEditor.qodefGetCurrentBlockElement !== 'object' ) {
	window.qiBlocksEditor.qodefGetCurrentBlockElement = qodefGetCurrentBlockElement;
}

if ( typeof window.qiBlocksEditor.qodefSetEditorLinkBehavior !== 'object' ) {
	window.qiBlocksEditor.qodefSetEditorLinkBehavior = qodefSetEditorLinkBehavior;
}

qodefEditorBlockSelection.init( document, window.parent, { force: true } );
