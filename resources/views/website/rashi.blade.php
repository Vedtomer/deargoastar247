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
        <a class="btn btn-xs btn-g20" style="z-index: 0" href="/login">Login</a>


        <a class="btn btn-xs btn-g20" href="/" style="z-index: 0">Day Results</a>

        <a class="btn btn-g20" href="/month-result" style="z-index: 0">Month Results</a>

        <br><br>



        <span style="font-family: Arial; color: #990073; font-size: x-large  ">Live Draw Time : <b><span
                    id="NextDrawTime"></span></b> </span>

        <span style="font-family: Arial; color: #990073 "> <br> Time Remaing :<b> <span
                    id="RemainingTime"></span></b></span>



    </div>


    <section class="section2">

        <br>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 center" style="text-align: center; padding-top: 15px;">
                    <img src="images/logo.webp" style="width:80%;">
                </div>
            </div>
            <div class="row">


                <div class="col-lg-12 center" style="text-align: right; padding-top: 15px;">

                    <article class="card shadow">

                        <div class="rounded " style="padding-top: auto; font-family: sans-serif;">

                            <table style="width: 100%; text-align: center;border-collapse:collapse;" border="1">

                                <thead>

                                    <tr style="background-color:  #004C99;">

                                        <th style="color:white;padding:10px;width:20%;">अं.क्र</th>

                                        <th style="color:white;padding:10px;width:20%;">राशी</th>

                                        <th style="color:white;padding:10px;width:20%;">चिन्ह</th>

                                        <th style="color:white;padding:10px;width:20%;">नाव</th>

                                        <th style="color:white;padding:10px;width:20%;">शुभ अंक</th>

                                    </tr>

                                </thead>

                                <tbody>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">1.</th>
                                        <th style="padding:5px;">मेष</th>
                                        <th><img src="{{ asset('images/mesh.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">चू, चे, चो, ला, ली, लू, ले, लो, आ</th>
                                        <th style="padding:5px;">6, 9</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">2</th>
                                        <th style="padding:5px;">वृषभ</th>
                                        <th><img src="{{ asset('images/rushabh.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">ई, ऊ, ए, ओ, वा, वी, वू , वे, वो</th>
                                        <th style="padding:5px;">5, 6</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">3</th>
                                        <th style="padding:5px;">मिथुन</th>
                                        <th><img src="{{ asset('images/mithun.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">का, की, कू, घ, छ, के, को, ह</th>
                                        <th style="padding:5px;">5, 6</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">4</th>
                                        <th style="padding:5px;">कर्क</th>
                                        <th><img src="{{ asset('images/kark.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">ही, हू, हे, हो, डा, डी, डू, डे, डो</th>
                                        <th style="padding:5px;">2, 9</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">5</th>
                                        <th style="padding:5px;">सिंह</th>
                                        <th><img src="{{ asset('images/sinh.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">मा, मी, मू, मे, मो, टा, टी, टू, टे</th>
                                        <th style="padding:5px;">1, 5, 9</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">6</th>
                                        <th style="padding:5px;">कन्या</th>
                                        <th><img src="{{ asset('images/kanya.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">ढो, पा, पी, पू, ष, ण, ठ, पे, पो </th>
                                        <th style="padding:5px;">5, 6</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">7</th>
                                        <th style="padding:5px;">तूळ</th>
                                        <th><img src="{{ asset('images/tul.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">रा, री, रू, रे, रो, ता, ती, तू, ते</th>
                                        <th style="padding:5px;">5, 6, 9</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">8</th>
                                        <th style="padding:5px;">वृश्चिक</th>
                                        <th><img src="{{ asset('images/ruchik.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">तो, ना, नी, नू, ने, नो, या, यी, यू</th>
                                        <th style="padding:5px;">1, 2, 4, 7</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">9</th>
                                        <th style="padding:5px;">धनु</th>
                                        <th><img src="{{ asset('images/dhanu.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">ये, यो, भा, भी, भू, धा, फा, ढा, भे</th>
                                        <th style="padding:5px;">3, 5, 6, 8</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">10</th>
                                        <th style="padding:5px;">मकर</th>
                                        <th><img src="{{ asset('images/makar.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">भो, जा, जी, खी, खू, खे, खो, गा, गी</th>
                                        <th style="padding:5px;">5, 6, 8</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">11</th>
                                        <th style="padding:5px;">कुंभ</th>
                                        <th><img src="{{ asset('images/kumbh.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">गू, गे, गो, सा, सी, सू, से, सो, दा</th>
                                        <th style="padding:5px;">3, 7, 9</th>
                                    </tr>
                                    <tr style="background-color:#d5e0eb;">
                                        <th style="padding:5px;">12</th>
                                        <th style="padding:5px;">मीन</th>
                                        <th><img src="{{ asset('images/meen.png') }}" style="width:40%;"></th>
                                        <th style="padding:5px;">दी, दू, थ, झ, त्र, दे, दो, चा, ची</th>
                                        <th style="padding:5px;">3, 7</th>
                                    </tr>
                                </tbody>

                            </table>

                        </div>

                    </article>

                </div>

            </div>

        </div>

        <br>

    </section>
@endsection
