<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_inscritos
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the login functions only once
require_once __DIR__ . '/helper.php';

$temp = 'https://dl.dropboxusercontent.com/u/52878265/inscritos.csv';

$cadastrados  = ModInscritosHelper::getInscritos($params->get('paht_file', $temp));

require JModuleHelper::getLayoutPath($module->module, 'default');
