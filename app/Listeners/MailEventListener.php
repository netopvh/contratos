<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 23/06/2016
 * Time: 16:47
 */

namespace CodeBase\Listeners;

use Illuminate\Contracts\Mail\Mailer;

class MailEventListener
{

    /*
     * @var Instancia da classe mailer
     */
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onDataLimite($event)
    {
        $data = $event->getData();

        $this->mailer->send('email.notificacao', $data, function($message) use ($data){
            $message->to($data['email'], $data['name'])->subject('Aviso de Vencimento de Contrato!');
        });
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\MailSendNotification',
            'App\Listeners\MailEventtListener@onDataLimite'
        );
    }
    
}