<?php

namespace App\Http\Controllers;

use App\Models\Draw;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $date = $request->query('date');
        $today = Carbon::today()->toDateString();

        if ($date) {
            $date = Carbon::parse($date)->toDateString();
            if ($date > $today) {
                // If the date is in the future, set it to today
                $date = $today;
            }
            $draws = Draw::whereDate('date', $date)->orderBy('id')->get();
        } else {
            $draws = Draw::whereDate('date', $today)->orderBy('id')->get();
        }

        return view('admin.draws.index', compact('draws', 'date'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.draws.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'draw_time' => 'required',
    //         'date' => 'required|date',
    //         // 'a' =>  6000 + $request->a,
    //         // 'b' =>  6100 + $request->b,
    //         // 'c' =>  6200 + $request->c,
    //         // 'd' =>  6300 + $request->d,
    //         // 'e' =>  6400 + $request->e,
    //         // 'f' =>  6500 + $request->f,
    //         // 'g' =>  6600 + $request->g,
    //         // 'h' =>  6700 + $request->h,
    //         // 'i' =>  6800 + $request->i,
    //         // 'j' =>  6900 + $request->j,
    //     ]);

    //     // Convert draw_time to AM/PM format
    //     $draw_time = date('h:i A', strtotime($request->draw_time));

    //     // Check if a draw already exists for the given draw_time and date
    //     $existingDraw = Draw::where('draw_time', $draw_time)
    //         ->where('date', $request->date)
    //         ->first();

    //     if ($existingDraw) {
    //         // Update the existing draw
    //         $existingDraw->update([
    //             'a' =>  6000 + $request->a,
    //             'b' => 6100 + $request->b,
    //             'c' =>  6200 + $request->c,
    //             'd' =>  6300 + $request->d,
    //             'e' =>  6400 + $request->e,
    //             'f' =>  6500 + $request->f,
    //             'g' =>  6600 + $request->g,
    //             'h' =>  6700 + $request->h,
    //             'i' =>  6800 + $request->i,
    //             'j' =>  6900 + $request->j,
    //         ]);

    //         $message = 'Draw updated successfully.';
    //     } else {
    //         // Create a new draw
    //         Draw::create([
    //             'draw_time' => $draw_time,
    //             'date' => $request->date,
    //             'a' =>  6000 + $request->a,
    //             'b' =>  6100 + $request->b,
    //             'c' =>  6200 + $request->c,
    //             'd' =>  6300 + $request->d,
    //             'e' =>  6400 + $request->e,
    //             'f' =>  6500 + $request->f,
    //             'g' =>  6600 + $request->g,
    //             'h' =>  6700 + $request->h,
    //             'i' =>  6800 + $request->i,
    //             'j' =>  6900 + $request->j,
    //         ]);

    //         $message = 'Draw created successfully.';
    //     }

    //     return redirect()->route('draws.index')
    //         ->with('success', $message);
    // }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Draw  $draw
     * @return \Illuminate\Http\Response
     */
    public function show(Draw $draw)
    {
        return view('draws.show', compact('draw'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Draw  $draw
     * @return \Illuminate\Http\Response
     */
    public function edit(Draw $draw)
    {
        return view('admin.draws.edit', compact('draw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Draw  $draw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Draw $draw)
    {

        $draw_time = date('h:i A', strtotime($request->draw_time));
        $draw->update([
            'draw_time' => $draw_time,
            'date' => $request->date,
            'a' =>   $request->a,
            'b' =>   $request->b,
            'c' =>   $request->c,
            'd' =>   $request->d,
            // 'e' =>  6400 + $request->e,
            // 'f' =>  6500 + $request->f,
            // 'g' =>  6600 + $request->g,
            // 'h' =>  6700 + $request->h,
            // 'i' =>  6800 + $request->i,
            // 'j' =>  6900 + $request->j,
        ]);

        return redirect()->route('draws.index')
            ->with('success', 'Draw updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Draw  $draw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Draw $draw)
    {
        $draw->delete();

        return redirect()->route('draws.index')
            ->with('success', 'Draw deleted successfully.');
    }


    public function generateDraw(Request $request)
    {
        $startDate = '2024-01-01';
        $endDate = '2026-01-01';
        $startTime = strtotime('09:00 AM');
        $endTime = strtotime('09:00 PM');
        $interval = 15 * 60; // 30 minutes in seconds
        $currentDate = $startDate;
        while (strtotime($currentDate) <= strtotime($endDate)) {
            $existingDrawsCount = Draw::where('date', $currentDate)->count();
            if ($existingDrawsCount == 0) {
                for ($time = $startTime; $time <= $endTime; $time += $interval) {
                    $draw_time = date('h:i A', $time);
                    // Generate random values and add prefixes
                    $a =  rand(0, 9);
                    $b =  rand(0, 9);
                    $c =  rand(0, 9);
                    $d =  rand(0, 9);
                    // $e = 6400 + rand(0, 99);
                    // $f = 6500 + rand(0, 99);
                    // $g = 6600 + rand(0, 99);
                    // $h = 6700 + rand(0, 99);
                    // $i = 6800 + rand(0, 99);
                    // $j = 6900 + rand(0, 99);

                    Draw::create([
                        'draw_time' => $draw_time,
                        'date' => $currentDate,
                        'a' => $a,
                        'b' => $b,
                        'c' => $c,
                        'd' => $d,
                        // 'e' => $e,
                        // 'f' => $f,
                        // 'g' => $g,
                        // 'h' => $h,
                        // 'i' => $i,
                        // 'j' => $j,

                    ]);
                }
            }
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }
    }
}
