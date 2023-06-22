<?php

namespace App\Notification;

use App\helper\HelperService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class NotificationService
{
    private $mailer;

    private $helperService;

    public function __construct(MailerInterface $mailer, HelperService $helperService) {
        $this->mailer = $mailer;
        $this->helperService = $helperService;
    }

    public function sendPokemonEmail($senderMail,$receiverMail)
    {
        $email = (new Email())
            ->from($senderMail)
            ->to($receiverMail)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);

    }
}