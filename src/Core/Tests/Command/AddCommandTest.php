<?php

declare(strict_types=1);

/*
 * This file is part of the dotfiles project.
 *
 *     (c) Anthonius Munthi <me@itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dotfiles\Core\Tests\Command;

use Dotfiles\Core\Command\AddCommand;
use Dotfiles\Core\Exceptions\InvalidOperationException;
use Dotfiles\Core\Tests\Helper\CommandTestCase;

/**
 * Class AddCommandTest.
 *
 * @covers \Dotfiles\Core\Command\AddCommand
 */
class AddCommandTest extends CommandTestCase
{
    public function testAddDir(): void
    {
        $backupDir = $this->getParameters()->get('dotfiles.backup_dir');
        $tester = $this->getTester('add');
        // test with recursive option
        $tester->execute(array(
            'path' => '.ssh',
            '-r' => true,
        ));
        $output = $tester->getDisplay(true);

        $this->assertContains('ssh', $output);
        $this->assertFileExists($backupDir.'/src/defaults/home/ssh/id_rsa');
        $this->assertFileExists($backupDir.'/src/defaults/home/ssh/id_rsa.pub');

        // test with recursive option
        $tester->execute(array(
            'path' => '.ssh',
            '-r' => true,
            '-m' => null,
        ));
        $this->assertFileExists($backupDir.'/src/dotfiles/home/ssh/id_rsa');
        $this->assertFileExists($backupDir.'/src/dotfiles/home/ssh/id_rsa.pub');

        // test without recursive option
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessageRegExp('/without recursive/is');
        $tester->execute(array(
            'path' => '.ssh',
        ));
        $output = $tester->getDisplay(true);
        $this->assertContains('without recursive', $output);
    }

    public function testAddFile(): void
    {
        $backupDir = $this->getParameters()->get('dotfiles.backup_dir');
        $tester = $this->getTester('add');
        $tester->execute(array(
            'path' => '.bashrc',
        ));
        $output = $tester->getDisplay(true);

        $this->assertContains('bashrc', $output);
        $this->assertFileExists($backupDir.'/src/defaults/home/bashrc');

        $tester->execute(array(
            'path' => '.bashrc',
            '-m' => null,
        ));
        $this->assertFileExists($backupDir.'/src/dotfiles/home/bashrc');

        $homeDir = $this->getParameters()->get('dotfiles.home_dir');
        $tester->execute(array(
            'path' => $homeDir.'/.bashrc',
            '-m' => null,
        ));
        $this->assertFileExists($backupDir.'/src/dotfiles/home/bashrc');

        $tester->execute(array(
            'path' => 'bashrc',
            '-m' => null,
        ));
        $this->assertFileExists($backupDir.'/src/dotfiles/home/bashrc');
    }

    public function testAddNonExistingPath(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessageRegExp('/Can not find/is');
        $tester = $this->getTester('add');
        $tester->execute(array(
            'path' => 'foo',
        ));
    }

    /**
     * @return mixed
     */
    protected function configureCommand()
    {
        $this->createHomeDirMock(__DIR__.'/fixtures/home');
        $this->command = $this->getContainer()->get(AddCommand::class);
    }
}
