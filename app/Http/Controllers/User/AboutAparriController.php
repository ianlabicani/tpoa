<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutAparriController extends Controller
{
    //
    
    public function history (){
    
        return view('user.about-aparri.history.index');
        
        }
        
        public function culture (){
        
            return view('user.about-aparri.culture.index');
            
            }
            
            
        public function events (){
        
            return view('user.about-aparri.events.index');
            
            }
        
        public function contact (){
        
            return view('user.contact');
            
            }
        }

