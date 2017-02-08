<?php

/**
 * Two Factor Authentication OpenLDAP user extension.
 *
 * @category   apps
 * @package    two-factor-auth-extension
 * @subpackage configuration
 * @author     eGloo <team@egloo.ca>
 * @copyright  2017 Avantech
 * @license    http://www.gnu.org/copyleft/lgpl.html GNU Lesser General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/two_factor_auth_extension/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('two_factor_auth_extension');

///////////////////////////////////////////////////////////////////////////////
// C O N F I G
///////////////////////////////////////////////////////////////////////////////

$info_map = array(
    'state' => array(
        'type' => 'integer',
        'field_type' => 'list',
        'field_options' => array(
            '0' => 'Disabled',
            '1' => 'Enabled',
        ),
        'required' => FALSE,
        'validator' => 'validate_state',
        'validator_class' => 'two_factor_auth_extension/OpenLDAP_User_Extension',
        'description' => lang('two_factor_extension_status'),
        'object_class' => 'clearTwoFactorAuthAccount',
        'attribute' => 'clearTwoFactorAuthState'
    ),

    'mail' => array(
        'type' => 'string',
        'field_type' => 'text',
        'required' => FALSE,
        'validator' => 'validate_email',
        'validator_class' => 'two_factor_auth_extension/OpenLDAP_User_Extension',
        'description' => lang('two_factor_auth_extension_email'),
        'object_class' => 'clearTwoFactorAuthAccount',
        'attribute' => 'clearTwoFactorAuthEmail'
    ),
);
