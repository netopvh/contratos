<?php

namespace CodeBase\Console\Commands;

use CodeBase\Events\MailSendNotification;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use Illuminate\Console\Command;

class Email extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia email para os usuários conforme especificações';

    /**
     * Cria uma nova instancia do ContratoRepositoryEloquent
     *
     * @var object
     */
    protected $contrato;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ContratoRepositoryEloquent $contrato)
    {
        parent::__construct();
        $this->contrato = $contrato;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $contratos = $this->contrato->getByVencimento();

        event(new MailSendNotification($contratos));
    }
}
