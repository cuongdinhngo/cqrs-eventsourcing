<?php

namespace App\Listeners;

use App\Events\BatchUsersRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Facades\UserRepository;

class CreateUsers implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'users_queue';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        logger(__METHOD__);
    }

    /**
     * Handle the event.
     *
     * @param  BatchUsersRegister  $event
     * @return void
     */
    public function handle(BatchUsersRegister $event)
    {
        logger("===> Start ___ {$this->queue}");
        logger(serialize($event));
        UserRepository::insert($event->data);
        logger('===> Finished ...');
    }
}
