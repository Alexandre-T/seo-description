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

class install_user_schema extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return $this->db_tools->sql_column_exists($this->table_prefix . 'forums', 'forum_seodescription');
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_schema()
	{
		return array(
			'add_tables'		=> array(
				$this->table_prefix . 'acme_demo'	=> array(
					'COLUMNS'		=> array(
						'acme_id'			=> array('UINT', null, 'auto_increment'),
						'acme_name'			=> array('VCHAR:255', ''),
					),
					'PRIMARY_KEY'	=> 'acme_id',
				),
			),
			'add_columns'	=> array(
				//@FIXME suppress demo and tests
				$this->table_prefix . 'users'			=> array(
					'user_acme'				=> array('UINT', 0),
				),
				$this->table_prefix . 'forums'			=> array(
					'forum_seodescription'	=> array('VCHAR:255', ''),
				),
				$this->table_prefix . 'topics'			=> array(
					'topic_seodescription'	=> array('VCHAR:255', ''),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				//@FIXME suppress demo and tests
				$this->table_prefix . 'users'			=> array(
					'user_acme',
				),
				$this->table_prefix . 'forums'			=> array(
					'forum_seodescription',
				),
				$this->table_prefix . 'topics'			=> array(
					'topic_seodescription',
				),
			),
			'drop_tables'		=> array(
				$this->table_prefix . 'acme_demo',
			),
		);
	}
}
