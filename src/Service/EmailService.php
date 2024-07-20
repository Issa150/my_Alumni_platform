<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use App\Entity\Emploi;

class EmailService
{
    private $mailer;
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendJobPreview(Emploi $emploi, string $superAdminEmail): void
    {
        $email = (new Email())
            ->from('no-reply@example.com')
            ->to($superAdminEmail)
            ->subject('Offre emploi/formation à valider')
            ->html($this->twig->render('emails/job_preview.html.twig', [
                'emploi' => $emploi,
            ]));

        $this->mailer->send($email);
    }
}
