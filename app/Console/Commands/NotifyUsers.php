<?php

namespace App\Console\Commands;

use App\Mail\AppointmentCreated;
use App\Models\Appointment;
use App\Models\User;
use App\Notifications\Patient;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to patient and specialist in the appointments';

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
        $appointments = Appointment::all();
        $this->info('Starting Sending Scheduled Notifications');

        $bar = $this->output->createProgressBar(count($appointments));

        $bar->start();
        $i = 1;
        $client = new \GuzzleHttp\Client();
        foreach ($appointments as $appointment) {
            $bar->advance();
            try {
                $timezone = $appointment->user->timezone ?? config('app.timezone');
                $targetDate = Carbon::parse($appointment->init, $timezone);
                $now = Carbon::now($timezone);
                if ($now->diffInMinutes($targetDate) == config('app.elapsedTimer', 30)) {
                    // Send an asynchronous request.                       
                    $request = new \GuzzleHttp\Psr7\Request('GET', route('sent_email', ['id' => $appointment->id]));
                    $promise = $client->sendAsync($request)->then(function ($response) use ($i) {
                        $this->info(sprintf('Sending %d scheduled notifications...', $i++));
                    });

                    $promise->wait();
                }
            } catch (\Exception $e) {
                report($e);
                $this->error($e->getMessage());
            }
        }

        $bar->finish();

        $this->info('Finished Sending Scheduled Notifications');
    }
}
