<?php 

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactNotification {

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    } 

    public function notify(Contact $contact) {
       $message = (new Email())
            ->subject('Agence : '. $contact->getProperty()->getTitle())
            ->from('noreply@agence.fr')
            ->to('contact@agence.fr')
            ->replyTo($contact->getEmail())
            ->html($this->renderer->render('pages/emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');

            $this->mailer->send($message);
    }
}