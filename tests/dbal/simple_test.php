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

namespace alexandret\seodescription\tests\dbal;

// Need to include functions.php to use phpbb_version_compare in this test
require_once __DIR__ . '/../../../../../includes/functions.php';

class simple_test extends \phpbb_database_test_case
{
	static protected function setup_extensions()
	{
		return array('alexandret/seodescription');
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	public function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/fixtures/config.xml');
	}

	public function test_config()
	{
		//@FIXME test that config_text and config elements are well added.
		// Stop here and mark this test as incomplete.
		$this->markTestIncomplete(
			'simple_test::test_config : This test has not been implemented yet.'
		);
	}

	public function test_column()
	{
		$db_tools = $this->_getDbTools();

		$this->assertTrue($db_tools->sql_column_exists(USERS_TABLE, 'user_acme'), 'Asserting that column "user_acme" exists');
		$this->assertFalse($db_tools->sql_column_exists(USERS_TABLE, 'user_acme_demo'), 'Asserting that column "user_acme_demo" does not exist');
		$this->assertFalse($db_tools->sql_column_exists(FORUMS_TABLE, 'forum_seodescription'), 'Asserting that column "forum_seodescription" exists');
		$this->assertFalse($db_tools->sql_column_exists(TOPICS_TABLE, 'topic_seodescription'), 'Asserting that column "topic_seodescription" exists');
	}

	private function _getDbTools(){
		$this->db = $this->new_dbal();

		if (phpbb_version_compare(PHPBB_VERSION, '3.2.0-dev', '<'))
		{
			// This is how to instantiate db_tools in phpBB 3.1
			$db_tools = new \phpbb\db\tools($this->db);
		}
		else
		{
			// This is how to instantiate db_tools in phpBB 3.2
			$factory = new \phpbb\db\tools\factory();
			$db_tools = $factory->get($this->db);
		}

		return $db_tools;
	}
}
