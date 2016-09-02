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

namespace alexandret\seodescription\console\command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class demo extends \phpbb\console\command\command
{
	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\user $user User instance (mostly for translation)
	*/
	public function __construct(\phpbb\user $user)
	{
		parent::__construct($user);

		// Set up additional properties here
	}

	/**
	* Configures the current command.
	*/
	protected function configure()
	{
		$this->user->add_lang_ext('alexandret/seodescription', 'cli');
		$this
			->setName('acme:demo')
			->setDescription($this->user->lang('CLI_DEMO'))
		;
	}

	/**
	* Executes the command acme:demo.
	*
	* @param InputInterface  $input  An InputInterface instance
	* @param OutputInterface $output An OutputInterface instance
	*
	* @return null
	*/
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln($this->user->lang('CLI_DEMO_HELLO'));
	}
}
