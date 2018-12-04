<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Admin:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new administrator';

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
     * @return mixed
     */
    public function handle()
    {
        $login = $this->ask('Whats your login?');
        $password = $this->secret('Whats your password?');
        $email = $this->secret('Whats your email?');
        $name = $this->secret('Whats your name?');

        User::create([
            'login' => $login,
            'password' => bcrypt($password),
            'name' => $name,
            'email' => $email,
        ]);
        $this->info('Is added');
    }
}
