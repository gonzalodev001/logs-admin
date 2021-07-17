<?php


namespace LaSalle\GroupSeven\User\Infrastructure\Framework\Mailer;


use LaSalle\GroupSeven\Core\Domain\Framework\Repository\MailRepository;
use LaSalle\GroupSeven\User\Domain\User;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerRepository implements MailRepository
{

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendMail(User $user): void
    {
        /**/
      $email = (new Email())
           ->from('hello@example.com')
           ->to($user->mail())
           //->cc('cc@example.com')
           //->bcc('bcc@example.com')
           //->replyTo('fabien@example.com')
           //->priority(Email::PRIORITY_HIGH)
           ->subject('! Bienvenido !')
           ->text('Sending emails is fun again!')
           ->html(
               '
                      <body>
                        <div style="text-align: center; padding-top: 80px;">
                            <h1>! Bienvenido !</h1>
                            <p>Estamos emocionados de tenerte en nuestra plataforma, no dude en comunicarse con nosotros para culaquier duda.!</p>
                            <br><a href="http://localhost:8080/login">Conectarse</a>
                            <p>Desarrollado por Gonzalo.</p>
                        </div>
                      </body>'
           );
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo $e->getMessage();
        }


    }

}