<?php


namespace ChapterThree\C3Bundle\Service;


use Symfony\Component\Notifier\Bridge\Slack\Block\SlackActionsBlock;
use Symfony\Component\Notifier\Bridge\Slack\Block\SlackDividerBlock;
use Symfony\Component\Notifier\Bridge\Slack\Block\SlackImageBlockElement;
use Symfony\Component\Notifier\Bridge\Slack\Block\SlackSectionBlock;
use Symfony\Component\Notifier\Bridge\Slack\SlackOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

class Slack
{
    private $chatter;
    private $options;

    public function __construct(ChatterInterface $chatter)
    {
        $this->chatter = $chatter;
    }

    public function addBlockSection($message) {
        $this->getOptions()
            ->block((new SlackSectionBlock())
                ->text($message));
    }

    public function addBlockSectionWithImage($message, $imageUrl, $imageText = 'Image') {
        $this->getOptions()
            ->block((new SlackSectionBlock())
                ->accessory(
                    new SlackImageBlockElement(
                        $imageUrl,
                        $imageText
                    )
                )
                ->text($message)
            );
        //->block($contributeToSymfonyBlocks);
    }

    public function addBlockDivider() {
            $this->getOptions()
                ->block(new SlackDividerBlock());
    }

    public function getOptions() {
        if (!isset($this->options)) {
            $this->options = new SlackOptions();
        }
        return $this->options;
    }

    public function send($message) {
        /**
         * full Slack
         */
        // Create Slack Actions Block and add some buttons
        $contributeToSymfonyBlocks = (new SlackActionsBlock())
            ->button(
                'Improve Documentation',
                'https://symfony.com/doc/current/contributing/documentation/standards.html',
                'primary'
            )
            ->button(
                'Report bugs',
                'https://symfony.com/doc/current/contributing/code/bugs.html',
                'danger'
            );
        if (empty($message)) $message = "[null]";
        if (strlen($message)>1024){
            $message = substr($message, 0,1024);
        }
        $chatMessage = new ChatMessage($message);
        // Add the custom options to the chat message and send the message
        if (isset($this->options)) {
            $chatMessage->options($this->options);
        }
        $this->chatter->send($chatMessage);
    }

}