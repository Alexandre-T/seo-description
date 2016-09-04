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

namespace alexandret\seodescription\acp;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $config, $request, $template, $user;
		//global $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang_ext('alexandret/seodescription', 'common');
		$this->tpl_name = 'acp_demo_body';
		$this->page_title = $user->lang('ACP_DEMO_TITLE');
		add_form_key('acme/demo');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('acme/demo'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('acme_demo_goodbye', $request->variable('acme_demo_goodbye', 0));

			trigger_error($user->lang('ACP_DEMO_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'				     	=> $this->u_action,
			'ACME_DEMO_GOODBYE'		     	=> $config['acme_demo_goodbye'],
			'AT_SEO_DESCRIPTION_ACTIVE'		=> $config['at_seodescription_active'],
			'AT_SEO_DESCRIPTION_DEFAULT'	=> $config['at_seodescription_default'],
			'AT_SEO_DESCRIPTION_FORUM'		=> $config['at_seodescription_forum'],
			'AT_SEO_DESCRIPTION_TOPIC'		=> $config['at_seodescription_topic'],
		));
	}
}
