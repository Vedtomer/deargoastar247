<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draw;
use Illuminate\Support\Carbon;


use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date') ? Carbon::parse($request->query('date'))->toDateString() : Carbon::today()->toDateString();
        $currentTime = Carbon::now();
        $draws = $this->getFilteredDraws($date, $currentTime);

        // Convert the collection to an array
        $drawsArray = $draws->toArray();

        return view('website.home', compact('drawsArray', 'date'));
    }

    public function Rashi(Request $request)
    {

        $date = $request->query('date') ? Carbon::parse($request->query('date'))->toDateString() : Carbon::today()->toDateString();
        $currentTime = Carbon::now();
        $draws = $this->getFilteredDraws($date, $currentTime);

        // Convert the collection to an array
        $drawsArray = $draws->toArray();

        return view('website.rashi', compact('drawsArray', 'date'));
    }

    public function Login(Request $request)
    {

        $date = $request->query('date') ? Carbon::parse($request->query('date'))->toDateString() : Carbon::today()->toDateString();
        $currentTime = Carbon::now();
        $draws = $this->getFilteredDraws($date, $currentTime);

        // Convert the collection to an array
        $drawsArray = $draws->toArray();

        return view('website.login', compact('drawsArray', 'date'));
    }

    public function MonthResult(Request $request)
    {

        $date = $request->query('date') ? Carbon::parse($request->query('date'))->toDateString() : Carbon::today()->toDateString();
        $currentTime = Carbon::now();
        $draws = $this->getFilteredDraws($date, $currentTime);

        // Convert the collection to an array
        $drawsArray = $draws->toArray();

        return view('website.monthresult', compact('drawsArray', 'date'));
    }




    public function getDrawsByDate(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date'))->toDateString() : Carbon::today()->toDateString();
        $currentTime = Carbon::now();
        $draws = $this->getFilteredDraws($date, $currentTime);

        // Return the collection as JSON, which will automatically convert it to an array
        return response()->json($draws);
    }

    private function getFilteredDraws($date, $currentTime)
    {
        $requestedDate = Carbon::parse($date);

        if ($requestedDate->isFuture()) {
            //  Log::info("Date is in the future: " . $date);
            return collect();
        }

        $query = Draw::select('id', 'draw_time', 'date', 'a', 'b', 'c', 'd', 'created_at', 'updated_at')
            ->whereDate('date', $date)
            ->orderBy('id', 'desc');

        if ($requestedDate->isToday()) {
            // Log::info("Filtering draws for today: " . $date);
            $draws = $query->get()->filter(function ($draw) use ($currentTime) {
                $drawDateTime = Carbon::createFromFormat('Y-m-d h:i A', $draw->date . ' ' . $draw->draw_time);
                //  Log::info("Draw DateTime: " . $drawDateTime->format('Y-m-d h:i A') . " | Current Time: " . $currentTime->format('Y-m-d h:i A'));
                return $drawDateTime->addSeconds(15)->lessThanOrEqualTo($currentTime);
            });
        } else {
            //   Log::info("Returning all draws for past date: " . $date);
            $draws = $query->get();
        }

        //   Log::info("Filtered Draws Count: " . $draws->count());

        // Make sure each draw is converted to an array
        return $draws->map(function ($draw) {
            return $draw->toArray();
        });
    }

    public function getMonthlyDraws(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $game = $request->input('game');

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        $now = Carbon::now();

        // If the requested month and year are in the future, return an empty result
        if ($startDate > $now) {
            return response()->json([]);
        }

        // Adjust end date to be no later than the current date
        $endDate = min($endDate, $now);

        $query = Draw::whereBetween('date', [$startDate, $endDate]);

        if ($game == 1) {
            $query->select('id', 'draw_time', 'date', DB::raw("CONCAT(a, b) as result"));
        } elseif ($game == 2) {
            $query->select('id', 'draw_time', 'date', DB::raw("CONCAT(c, d) as result"));
        } else {
            // Default case: return all columns
            $query->select('id', 'draw_time', 'date', 'a', 'b', 'c', 'd');
        }

        $draws = $query->get();

        // Filter draws based on the current time for the current month
        $filteredDraws = $draws->filter(function ($draw) use ($now) {
            try {
                $drawDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $draw->date . ' ' . $draw->draw_time);
            } catch (\Exception $e) {
                // If the format is invalid, try an alternative format
                try {
                    $drawDateTime = Carbon::createFromFormat('Y-m-d h:i A', $draw->date . ' ' . $draw->draw_time);
                } catch (\Exception $e) {
                    // If both formats fail, log the error and skip this draw
                    \Log::error("Invalid date/time format for draw ID {$draw->id}: {$draw->date} {$draw->draw_time}");
                    return false;
                }
            }
            return $drawDateTime->addSeconds(15)->lessThanOrEqualTo($now);
        });

        // Convert each draw to an array
        $result = $filteredDraws->map(function ($draw) {
            return $draw->toArray();
        });

        return response()->json($result);
    }
}
