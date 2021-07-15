<?php


namespace LaSalle\GroupSeven\User\Infrastructure\Framework\Mailer;


use LaSalle\GroupSeven\User\Domain\User;
use LaSalle\GroupSeven\User\Domain\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class MailerRepository implements UserRepository
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendMail(): void
    {
        /*$email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');*/
        $email = (new TemplatedEmail())
            ->from('fabien@example.com')
            ->to(new Address('ryan@example.com'))
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('emails/signup.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ])
        ;
        $this->mailer->send($email);
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    public function findByEmail(string $mail): bool
    {
        // TODO: Implement findByEmail() method.
    }

    public function addRoleToUser(string $id, string $role): void
    {
        // TODO: Implement addRoleToUser() method.
    }
}