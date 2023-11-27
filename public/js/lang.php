<?php
/* =============================================================================
 * $Revision: 5385 $
 * $Date: 2010-05-25 11:51:09 +0200 (Tue, 25 May 2010) $
 *
 * Vivvo CMS v4.5.2r (build 6084)
 *
 * Copyright (c) 2010, Spoonlabs d.o.o.
 * http://www.spoonlabs.com, All Rights Reserved
 *
 * Warning: This program is protected by copyright law. Unauthorized
 * reproduction or distribution of this program, or any portion of it, may
 * result in severe civil and criminal penalties, and will be prosecuted to the
 * maximum extent possible under the law. For more information about this
 * script or other scripts see http://www.spoonlabs.com
 * =============================================================================
 */

	require_once (dirname(__FILE__) . '/../conf.php');
	require_once (VIVVO_FS_INSTALL_ROOT . 'lib/vivvo/vivvo_lite_site.php');

	define('VIVVO_SKIP_URL_PARSING', 1);

	$frontend_lang = vivvo_lang::get_instance();

	header('Content-Type: application/x-javascript');

	echo "if(typeof(vivvo) == 'undefined') var vivvo = {};";
	echo 'vivvo.lang = ' . json_encode($frontend_lang->_lang_stack) . ";\n";
	echo "vivvo.lang.get = function(lang) {return (lang in vivvo.lang) ? vivvo.lang[lang] : lang };";

#EOF