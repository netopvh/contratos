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
        $contratos = $event->getData()->toArray();

        foreach($contratos as $contrato){
            $this->mailer->send('emails.vencimento', $contrato, function ($message) {
                $message->to('angelo.neto@fiero.org.br')->subject('Aviso de Vencimento de Contrato!');
            });
        }
    }

    public function subscribe($events)
    {
        $events->listen(
            'CodeBase\Events\MailSendNotification',
            'CodeBase\Listeners\MailEventListener@onDataLimite'
        );
    }

}