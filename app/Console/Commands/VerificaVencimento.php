<?php

namespace CodeBase\Console\Commands;

use Illuminate\Console\Command;
use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use CodeBase\Events\MailSendNotification;
use Illuminate\Support\Facades\Event;

class VerificaVencimento extends Command
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
    protected $description = 'Envia emails de acordo com o vencimento';

    /*
     * Instancia da close ContratoRepositoryEloquent
     *
     * @var ContratoRepositoryEloquent
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

        Event::fire(new MailSendNotification($contratos));

    }
}
