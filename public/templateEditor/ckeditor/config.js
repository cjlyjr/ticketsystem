/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	//config.language = 'en';
	config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '../templateEditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '../templateEditor/kcfinder/browse.php?opener=ckeditor&type=images';
	
	config.filebrowserFlashBrowseUrl = '../templateEditor/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '../templateEditor/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '../templateEditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = '../templateEditor/kcfinder/upload.php?opener=ckeditor&type=flash';
	config.filebrowserUploadMethod = 'form';
	//config.extraPlugins='video';
	//config.extraPlugins = 'html5video';
	//config.extraPlugins = 'uploadfile';
	// Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
config.toolbar = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
	
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Html5video','Table', 'HorizontalRule', 'SpecialChar' ] },
	'/',
	{ name: 'styles', items: [ 'Styles', 'Format' ] },
	{ name: 'tools', items: [ 'Maximize' ] },
	{ name: 'others', items: [ '-' ] },
	{ name: 'about', items: [ 'About' ] }
];
	

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	
};
