<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RetrieveGigatronDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'retrieve-gigatron-data:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieving data (JSON resource) from Gigatron website...';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $retrieveGigatronDataAction = new \App\Actions\RetrieveGigatronDataAction();
        \DB::beginTransaction();
        try {
            $retrieveGigatronDataAction->prepareRequestForInitialDataResponse();
            $retrieveGigatronDataAction->getData();
            $retrieveGigatronDataAction->parseResultIntoJson();
            $retrieveGigatronDataAction->parsePaginationInfo();            
            for($page = 1; $page <= $retrieveGigatronDataAction->getTotalPages(); $page++){                
                $retrieveGigatronDataAction->prepareRequestForDataByPage($page);                
                $retrieveGigatronDataAction->getData();  
                $retrieveGigatronDataAction->parseResultIntoJson();
                $paginatedGigatronData = $retrieveGigatronDataAction->getGigatronCatalogItems();                
                $insertGigatronDataIntoDbAction = new \App\Actions\InsertGigatronDataIntoDbAction($paginatedGigatronData);
                $insertGigatronDataIntoDbAction->prepareAndInsertData();                
            }

            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
            echo $e->getMessage();
        }
    }
}
