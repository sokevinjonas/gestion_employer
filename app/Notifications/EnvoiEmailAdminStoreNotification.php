<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvoiEmailAdminStoreNotification extends Notification
{
    use Queueable;

    public $code;
    public $email; // Correction ici

    public function __construct($code, $email) // Correction ici
    {
        $this->code = $code;
        $this->email = $email;
    }
    /**
 * Obtient les canaux de livraison de la notification.
 *
 * @return array<int, string>
 */


    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Creation de compte Administrateur')
            ->line('Salut')
            ->line("Votre compte a été créé avec succès sur la plateforme de gestion de E Salaire de l'employeur")
            ->line("Cliquez sur le bouton ci-dessous pour valider votre compte!")
            ->line("Saisissez le code $this->code et renseignez-le dans le formulaire !")
            ->action('Cliquez ici', url('/validate-account' . '/' . $this->email))
            ->line('Merci!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
