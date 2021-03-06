/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'html5video';
	
	config.uiColor = '#AADC6E';
	config.contentsCss = '/css/editorstyle.css';
	
	config.filebrowserBrowseUrl = '/replyeditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl ='/replyeditor/kcfinder/browse.php?opener=ckeditor&type=images';
	
	config.filebrowserFlashBrowseUrl = '/replyeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '/replyeditor/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl ='/replyeditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = '/replyeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
	config.filebrowserUploadMethod = 'form';
};
