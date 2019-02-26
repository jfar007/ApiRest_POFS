<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ordermanagement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:ordermanagement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command is responsible for managing
    the orders.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    
    // Evaluar todas las sucursales de cada uno de los clientes c/u de los siguientes criterios: 
        //1. Al crear el pedido
        // 1. Determinar perfil del cliente
        // 2. Determinar fecha corte (Tener en cuenta la fecha apartir de)
        // 3. Determinar si ya existe un pedido con la fecha de corte establecida (Pendiente ver si es en memoria o peticiones a la DB)
        // 3.1 Si, si no crea pedido 
        // 3.2 No, Crea pedido
        // 4. Evalua si se debe cambiar estado o sirve el actual
        // 
        // 2. Al enviar email
        // 1. Evaluar apartir de 
        // 2. Enviar mail 


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
    }

    
}
