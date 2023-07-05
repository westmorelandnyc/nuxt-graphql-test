<?php

namespace App\Console\Commands;

use Exception;
use App\Models\CostCode;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ProcessCostCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-cost-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds an internal ID to all cost_codes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = $this->query();
        $count=  $query->count();
        $bar = $this->output->createProgressBar($count);
        $query->each(function ($costCode, $index) use ($count, $bar) {
            $costCode->update([
                'internal_id' => $this->generateInternalId($costCode),
            ]);
            $bar->advance();
        });
        $bar->finish();
    }

    private function generateInternalId($costCode) {
        $internalIdFormat = '%s%s';
        $truncatedCostCodeNumber = 
            substr(
                str_pad(
                    Str::replaceFirst('.', '',
                        trim(str_replace(' ', '', $costCode->cost_code_number))
                    ),
                9, '0', STR_PAD_RIGHT)
            , 0, 9); 
            // $this->info("{$costCode->cost_code_number} => {$truncatedCostCodeNumber} (length : " . strlen($truncatedCostCodeNumber) . ")");
        $internalIdCollisions = CostCode::where('internal_id', 'like', sprintf($internalIdFormat, $truncatedCostCodeNumber, '%'))->get();
        $newInternalId = '';
        if($internalIdCollisions->count() === 0) {
            $newInternalId = sprintf($internalIdFormat, $truncatedCostCodeNumber, 'A');
        } else {
            $maxInternalId = $internalIdCollisions->sortByDesc('internal_id')->first()->internal_id;
            $nextInternalIdSuffix = $this->getInternalIdSuffix($maxInternalId);
            $newInternalId = sprintf($internalIdFormat, $truncatedCostCodeNumber, $nextInternalIdSuffix);
        }
        return $newInternalId;
    }

    private function getInternalIdSuffix($internalId) {
        $lastInternalIdSuffix = substr($internalId, 9);
        $nextInternalIdSuffix = ++$lastInternalIdSuffix;
        if( $nextInternalIdSuffix > 'Z' ) {
            $nextInternalIdSuffix = 'a';
        } elseif( $nextInternalIdSuffix > 'z' ) {
            throw new Exception("Too many collisions", 1);
        } 
        return $nextInternalIdSuffix;
    }

    private function query() {
        return CostCode::query()
        ->whereNull('internal_id')
        // ->where(DB::raw('LENGTH(internal_id)'), '<>', 10)
        ->get();
    }
}
