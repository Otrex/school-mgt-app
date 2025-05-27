<?php

namespace App\Console\Commands;

use App\Traits\Utilities;
use Illuminate\Console\Command;

class UpdateCommunityReferralCodesCommand extends Command
{
    use Utilities;
    protected $signature = 'community:update-referral-codes';

    protected $description = 'Updates the `referral_code` field of the `community` table with the `generateReferralCode()` function.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $communities = \App\Models\Community::whereNull('referrer_code')->get();

        foreach ($communities as $community) {
            $referrerCode = $this->generateReferralCode();
            while (\App\Models\Community::where('referrer_code', $referrerCode)->exists()) {
                $referrerCode = $this->generateReferralCode();
            }
            $community->referrer_code = $referrerCode;
            $community->save();
        }

        $this->info('All community referral codes have been updated.');
    }
}
