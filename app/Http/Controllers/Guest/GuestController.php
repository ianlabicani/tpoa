<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    //FOR GUEST
    public function history()
    {

        return view('guest.about-aparri.history.index');
    }

    public function culture()
    {

        return view('guest.about-aparri.culture.index');
    }

    public function events()
    {
        $events = Event::all();
        return view('guest.about-aparri.events.index', compact('events'));
    }

    public function show_event($id)
    {
        $event = Event::findOrFail($id);
        return view('guest.about-aparri.events.show', compact('event'));
    }


    public function contact()
    {

        return view('guest.contact');
    }


    //CULTURE
    public function farming()
    {
        return view('guest.about-aparri.culture.farming');
    }

    public function fishing()
    {
        return view('guest.about-aparri.culture.fishing');
    }

    public function gakka()
    {
        return view('guest.about-aparri.culture.gakka-gathering');
    }

    public function dried_fish()
    {
        return view('guest.about-aparri.culture.dried-fish');
    }

    public function miki_niladdit()
    {
        return view('guest.about-aparri.culture.miki');
    }

    public function aramang_ukoy()
    {
        return view('guest.about-aparri.culture.aramang-ukoy');
    }

    public function nipa_thatch()
    {
        return view('guest.about-aparri.culture.nipa-thatch');
    }


    //PRODUCTS
    public function products()
    {
        return view('guest.about-aparri.products.index');
    }

    public function alamang()
    {
        return view('guest.about-aparri.products.alamang');
    }

    public function daing()
    {
        return view('guest.about-aparri.products.daing');
    }

    public function nipa_wine()
    {
        return view('guest.about-aparri.products.nipa_wine');
    }




    //USER

    public function user_history()
    {

        return view('user.about-aparri.history.index');
    }

    public function user_culture()
    {

        return view('user.about-aparri.culture.index');
    }


    public function user_contact()
    {

        return view('user.contact');
    }
}
