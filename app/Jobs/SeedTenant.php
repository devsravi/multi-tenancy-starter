<?php

namespace App\Jobs;

use App\Models\{
    Tenant,
    User
};
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SeedTenant implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            // $user = new User();
            // dd($this->tenant, $this->tenant->email, tenancy(), $user);
            $user = User::firstOrCreate(
                [
                    'email' => $this->tenant->email,
                ],
                [
                    'name' => $this->tenant->name,
                    'password' => $this->tenant->password,
                ]
            );
            Log::info('INSIDE TENANT RUN', $user->toArray());
        });
        Log::info('TENANT INFO', $this->tenant->toArray());
        Log::info('TENANT USER INFO', $this->tenant->users->toArray());
    }
}
