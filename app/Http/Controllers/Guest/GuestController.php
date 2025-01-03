<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function history (){
    
    return view('guest.about-aparri.history.index');
    
    }
    
    public function culture (){
    
        return view('guest.about-aparri.culture.index');
        
        }
        
        
    public function events (){
    
        return view('guest.about-aparri.events.index');
        
        }
    
    public function contact (){
    
        return view('guest.contact');
        
        }
        
        
        public function user_history (){
    
            return view('user.about-aparri.history.index');
            
            }
            
            public function user_culture (){
            
                return view('user.about-aparri.culture.index');
                
                }
                
                
            public function user_events (){
            
                return view('user.about-aparri.events.index');
                
                }
            
            public function user_contact (){
            
                return view('user.contact');
                
                }
}
