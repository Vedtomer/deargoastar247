@extends('website.layouts.app')

@section('styles')
    <style>
        .refresh-btn {
            margin-left: 10px;
        }

        .date-display {
            text-align: center;
            margin: 20px 0;
        }


        .date-selector {
            display: flex;
            align-items: center;
        }

        .date-input {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #0056b3;
            border-radius: 4px;
            /* margin-right: 10px; */
        }

        .refresh-btn {
            cursor: pointer;
            margin-left: 10px;
        }
    </style>

    <style>
        .table-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            overflow-x: auto;
        }

        #dataTable {
            width: 100%;
            border-collapse: separate;
            border-spacing: 3px;
            font-size: 18px;
        }

        #dataTable th,
        #dataTable td {
            border: 2px solid #FFD700;
            padding: 10px;
            text-align: center;
        }

        #dataTable thead th {
            background-color: #808080;
            color: white;
            font-size: 20px;
            border-bottom: 4px solid #FFD700;
        }

        td {
            font-size: 20px;
            font-weight: bolder;
        }

        .time-column {
            color: white;
        }

        @media (max-width: 600px) {
            #dataTable {
                font-size: 14px;
            }

            #dataTable th {
                font-size: 16px;
            }
        }

        .btn-g20 {
            background: #a41c1c;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            font-family: Arial;
        }
    </style>
@endsection

@section('content')
    <div id="title_grad" style="background-image: linear-gradient(#7256ff, #923afa);">

        <marquee id="a" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"
            style=" font-family:Verdana; font-weight: bold;    background-color: seashell; color: #E13300; margin-top: 5px; padding-bottom:2px; ">

            WELCOME TO DEAR GOA STAR

        </marquee>



        <header class="navigations fixed-tops center">

            <nav class="navbar navbar-expand-lg navbar-darks center">

                {{-- <input type="hidden" id="nxtDrTime" name="nxtDrTime" value="Sep 17, 2024 10:00:00"> --}}

                <div style="text-align: center;  width: 100%">

                    <a class="navbar-brand font-tertiaryS h4 " href="/rashi">
                        <img src="{{ asset('images/logo.webp') }}" style="width: 30%;" alt="Dear Rajashree Goa Star">
                        <span style="color: white"><img src="{{ asset('images/logo2.png') }}" style="width: 35%;"
                                alt=""></span>
                        <span style="color: white"><img src="{{ asset('images/logo.webp') }}" style="width: 30%;"
                                alt=""></span>
                    </a>

                </div>

                <div class="rounded"
                    style="text-align: center;  width: 100%; color: blue; font-weight: bold; text-align: center; display: inline-block;padding:5px">

                    <div class="rounded" style="border-style: thick; border-color: red; width: 100%">

                        <table width="100%">

                            <tbody>
                                <tr
                                    style="border-top-width: 2px; border-top-color: #804000; border-top-style: ridge; border-bottom-width: 2px; border-bottom-color: #804000; border-bottom-style: ridge;">

                                    <td align="left">
                                        <span style="font-size: medium; color: #fed22f">Time:
                                            <strong><span style="color: #FFFFFF" id="currentTime"></span></strong>
                                        </span>
                                    </td>

                                    <td align="right" style="color: #FFFFFF">
                                        <span style="color: #fed22f; font-size: medium">Date: </span>
                                        <span id="todays_date">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                                    </td>

                                </tr>

                            </tbody>
                        </table>

                    </div>


                </div>
            </nav>

        </header>

    </div>



    <div align="center">

        <article class="card shadow col-lg-4 " style="text-align: center; padding-top: 5px; text-align: center;">

            <div class="rounded "
                style="padding-top: auto; font-family: sans-serif; background-color: #2905ff; width: 100%">

                <table style="width: 100%; text-align: center">

                    <tbody>
                        <tr
                            style="border-bottom-width: 2px; border-bottom-color: #99CCFF; border-bottom-style: ridge; color: yellow">

                            <td>
                                <div class=""
                                    style="font-size: x-large;   font-family: sans-serif;font-weight:bolder">Result Slot
                                </div>
                            </td>

                            <td
                                style=" font-family: sans-serif;  font-size: 12px; font-weight: bold; background-color: #ef8010;">
                                गोल्डन<br>लक्ष्मी</td>

                            <td
                                style=" font-family: sans-serif;  font-size: 12px; font-weight: bold; background-color:  #2905ff;">
                                शुभ<br>लक्ष्मी</td>
                        </tr>

                        <tr>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #2905ff;">
                                <span id="result_time" style="" class="text-uppercase"></span>
                            </td>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #ef8010;">
                                <span id="latest_result1">-</span>
                            </td>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #2905ff;">
                                <span id="latest_result2">-</span>
                            </td>





                        </tr>

                    </tbody>
                </table>

            </div>

        </article>

    </div>


    <div style="width: 100%; text-align: center; padding-top: 10px; z-index: -5 " class="center">



        <a class="btn btn-xs btn-g20" style="z-index: 0" href="/">Home</a>
        <a class="btn btn-xs btn-g20" style="z-index: 0" href="#">Login</a>


        <a class="btn btn-xs btn-g20" href="/" style="z-index: 0">Day Results</a>

        <a class="btn btn-g20" href="/month-result" style="z-index: 0">Month Results</a>

        <br><br>



        <span style="font-family: Arial; color: #990073; font-size: x-large  ">Live Draw Time : <b><span
                    id="NextDrawTime"></span></b> </span>

        <span style="font-family: Arial; color: #990073 "> <br> Time Remaing :<b> <span
                    id="RemainingTime"></span></b></span>



    </div>




    <div class="tabcontentss" style="width: 100%; text-align: center;margin-top:20px">
        <section class="sections" data-background="/images/backgrounds/bg-dots.png">
            <div class="containers" style="text-align: center; width: 100%">
                <div id="grad1" class="rounded text-center p-4 shadow-down"
                    style="text-align: center;  vertical-align: middle;  display: inline-block; background-color: #912000">
                    <div style=" font-family: inherit;">
                        <table align="center" style="font-size:20px; font-weight: bold;color:white; ">
                            <tbody>
                                <tr>
                                    <td colspan="2" style="font-size:30px">LOGIN
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Username :</td>
                                    <td><input type="text" id="" name="username" class="" required=""
                                            style="text-align:center; width: 100%; border-radius: 15px; font-size: 22px">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-top:25px;">Password :</td>
                                    <td style="padding-top:25px;"><input type="password" id="" name="password"
                                            class="" required=""
                                            style="text-align:center; width: 100%; border-radius: 15px; font-size: 22px">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:25px;"><input type="submit"
                                            class="btn btn-success btn-g20" id="" value="LOGIN"
                                            style="background:#519d23;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
