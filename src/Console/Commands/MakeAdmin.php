<?php

namespace ValLuminarias\MakeAdmin\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{

    private $fullname;
    private $email;
    private $uname;
    private $upass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin 
                            {--name=       : Name of the User}
                            {--email=      : Email address of the User}
                            {--u|username= : Desired username} 
                            {--p|password= : Desired password}
                            ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

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
        $this->fullname();
        $this->email();
        $this->username();
        $this->password();

        $this->createTheUser([
            'name' => $this->fullname,
            'email' => $this->email,
            'username' => $this->uname,
            'password' => Hash::make($this->upass),
            'is_admin' => true, 
        ]);
    }

    public function createTheUser($user)
    {
        $this->info('Creating the user.');

        try {

            User::create($user);

            $this->info('User created.');
        } catch (\Exception $e) {
            $this->error('Error in creating user.');
            $this->info('Error: ' . $e->getMessage());
        }
    }

    private function fullname(): void
    {
        $this->fullname = $this->option('name') ?? $this->ask('Name of the User');
    }

    private function email(): void
    {
        $this->email = $this->option('email') ?? $this->ask('Email');
    }

    private function username(): void
    {
        $this->uname = $this->option('username') ?? $this->ask('Desired Username');
    }

    private function password(): void
    {
        $this->upass = $this->option('password') ?? $this->secret('Desired Password');
        $this->confirmPassword();
    }

    private function confirmPassword()
    {
        $confirm = $this->secret('Confirm Password');
        while (strcmp($this->upass, $confirm) <> 0) {
            $this->error('Passwords do not match.');
            $this->password();
        }
    }
}
