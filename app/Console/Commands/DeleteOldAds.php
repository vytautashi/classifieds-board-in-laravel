<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Advertisement;

class DeleteOldAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-old-ads {days=30}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes advertisements that are older than specified age in days';

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
        if (!is_numeric($this->argument('days'))) {
            $this->error('parameter that specifies `days` must be number');
            return 1;
        }
        $adAgeInDays = (int) $this->argument('days');

        if ($adAgeInDays < 0) {
            $this->error('parameter `days` must be equal or greater than 0');
            return 1;
        }

        if ($adAgeInDays === 0) {
            $this->info('`days` parameter set to `0` it will delete all advertisements.');
            if (!$this->confirm('Do you wish to continue?')) {
                return 0;
            }
        }

        $deleteUpToDate = date("Y-m-d", mktime(0, 0, 0, date("m"),   date("d") - $adAgeInDays,   date("Y")));
        $ads = Advertisement::whereDate('created_at', '<=', $deleteUpToDate)->get();
        $adsRemovedCount = 0;

        foreach ($ads as $ad) {
            if ($ad->delete())
                $adsRemovedCount++;
        }

        $this->info("--------------------------");
        $this->info("        --REPORT--        ");
        $this->info("--------------------------");
        $this->info("Ads deleted up to date: \n" . $deleteUpToDate);
        $this->info("--------------------------");
        $this->info("Total ads removed: \n" . $adsRemovedCount);
        $this->info("--------------------------");

        return 0;
    }
}
