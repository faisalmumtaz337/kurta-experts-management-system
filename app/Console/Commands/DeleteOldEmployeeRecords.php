<?php

namespace App\Console\Commands;

use App\Models\EmployeePayment;
use App\Models\EmployeeWork;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldEmployeeRecords extends Command
{
    protected $signature = 'app:delete-old-employee-records';

    protected $description = 'Delete employee payments and works older than 6 months';

    public function handle()
    {
        $dateLimit = Carbon::now()->subMonth(6);

        EmployeePayment::where('created_at', '<=', $dateLimit)->delete();

        EmployeeWork::where('created_at', '<=', $dateLimit)->delete();

        $this->info('Old employee records deleted successfully.');
    }
}
