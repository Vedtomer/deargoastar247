<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Draw;
use Illuminate\Support\Facades\Log;

class GenerateDraw extends Command
{
    protected $signature = 'generate:draw';
    protected $description = 'Generate a daily draw';

    public function handle()
    {

        $result = $this->generateDraw();
        Log::info("Today's draw result: " . $result);
    }

    public function generateDraw()
    {
        $startTime = strtotime('08:00 AM');
        $endTime = strtotime('10:00 PM');
        $interval = 15 * 60; // 15 minutes in seconds

        // Default to today's date if not provided
        $date =  date('Y-m-d');

        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $draw_time = date('h:i A', $time);

            // Check if a draw already exists for the given draw_time and date
            $existingDraw = Draw::where('draw_time', $draw_time)
                ->where('date', $date)
                ->first();

            if (!$existingDraw) {
                // Generate random values for a and b between 0 and 99
                $a = rand(0, 99);
                $b = rand(0, 99);

                // Create the draw with the formatted draw_time
                Draw::create([
                    'draw_time' => $draw_time,
                    'date' => $date,
                    'a' => $a,
                    'b' => $b,
                ]);
            }
        }
    }
}
