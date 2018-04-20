<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 20.04.2018
 * Time: 16:17
 */

namespace PM\Bundle\LoggerBundle\Command;

use PM\Bundle\LoggerBundle\Component\Traits\HasPersistentLoggerTrait;
use PM\Bundle\LoggerBundle\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


/**
 * Class TestCommand
 *
 * @package PM\Bundle\LoggerBundle\Command
 */
class TestCommand extends ContainerAwareCommand
{
    use HasPersistentLoggerTrait;

    const NAME = 'pm:logger:test';

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Add test error for debugging');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = new SymfonyStyle($input, $output);
        $helper->title(self::NAME);

        $errorCode = $helper->ask('Any suggestions for a error code?', 999999);
        $errorType = $helper->choice('What type of error?', Entry::getTypes());

        $exception = new \RuntimeException('This exception never happend. It\'s just a simple test.', $errorCode);

        $this->getLogService()->log($errorType, $errorCode, $exception);

        $helper->success('Done!');
    }

}