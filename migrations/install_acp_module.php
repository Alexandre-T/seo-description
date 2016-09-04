<?php
/**
 *
 * This file is part of the phpBB Forum Software package.
 *
 * @copyright (c) phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

namespace alexandret\seodescription\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['at_seodescription_active']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			//Configuration
			array('config.add', array('acme_demo_goodbye', 0)),
			array('config.add', array('at_seodescription_active', 0)),
			array('config_text.add', array('at_seodescription_default', '')),
			array('config_text.add', array('at_seodescription_forum', '')),
			array('config_text.add', array('at_seodescription_topic', '')),

			//Permission
			//@FIXME créer les permissions pour les modérateurs
			//array('permission.add', array('u_foo_bar')),
			//array('permission.permission_set', array('REGISTERED', 'u_foo_bar', 'group')),
			//array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_foo_bar')),
			// https://www.phpbb.com/extensions/writing/
			//@FIXME next use the core.permission event
			//$permissions = $event['permissions'];
			//$permissions['u_foo_bar'] = array('lang' => 'ACL_U_FOOBAR', 'cat' => 'misc');
			//$event['permissions'] = $permissions;
			// Finally, you need to define the permission's language key(s).
			// Simply put them in a language file that starts with permissions_,
			// and they will be automatically loaded within the ACP.
			// For example, the file permission_foobar.php would contain the following language key definition:
			//
			//$lang = array_merge($lang, array(
			//	'ACL_U_FOOBAR' => 'Can view foobar',
			//));

			//Module
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_DEMO_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_DEMO_TITLE',
				array(
					'module_basename'	=> '\alexandret\seodescription\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
