<?php

namespace CodeBase\Console\Commands;

use CodeBase\Repositories\Contrato\ContratoRepositoryEloquent;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Instancia da Classe ContratoRepositoryEloquent
     *
     * @var object
     */
    protected $contrato;

    /**
     * Inicializa a classe injetando o repository
     *
     * @void
     */
    public function __construct(ContratoRepositoryEloquent $contrato)
    {
        parent::__construct();
        $this->contrato =$contrato;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (auth()->user()->is_super == 1) {
            $contratos = $this->contrato->getByVencimento();
        }

        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
