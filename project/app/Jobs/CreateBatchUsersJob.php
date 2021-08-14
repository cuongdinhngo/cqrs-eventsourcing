<?php

namespace App\Jobs;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class CreateBatchUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepositoryInterface $userRepository)
    {
        logger('===> STARTING JOBS .....');
        $this->users = array_map(function($item){
            $item['password'] = Hash::make($item['password']);
            $item['api_token'] = generateApiToken();
            return $item;
        }, $this->users);
        $userRepository->insert($this->users);
        logger('===> FINISHED JOBS <===');
    }
}
