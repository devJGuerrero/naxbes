<?php

namespace App\Jobs;

use Throwable;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CleanAddressTableFailed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Clean address table.
 * Queues a process to be executed.
 * 
 * @class CleanAddressTable
 * @package App\Jobs
 */
class CleanAddressTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $start   = Carbon::now();
        $channel = Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/jobs/clean_address_table/record.log'),
        ]);
        $log = Log::stack(['daily', $channel]);
        $log->info('Starts scheduled work');
        $addresses = DB::table('addressables')
            ->select('addressables.address_id as id')
            ->leftJoin('customers', 'addressables.addressable_id', '=', 'customers.id')
            ->where('addressables.addressable_type', Customer::class)
            ->whereNull('customers.id')
            ->union(
                DB::table('addresses')
                    ->select('addresses.id')
                    ->leftJoin('addressables', 'addresses.id', '=', 'addressables.address_id')
                    ->whereNull('addressables.address_id')
            );
        foreach ($addresses->get() as $address) {
            DB::table('addresses')->delete(
                $address->id
            );
        }
        $end = Carbon::now();
        $log->info('Programmed work ends');
        $log->info('Duration of the process: ' . $start->floatDiffInSeconds($end) . ' seg');
    }

    /**
     * Handle a job failure.
     */
    public function failed(?Throwable $exception): void
    {
        Mail::to(env('MAIL_JOB_RECIPIENT', ''))->send(new CleanAddressTableFailed(
            $exception->getMessage()
        ));
    }
}
