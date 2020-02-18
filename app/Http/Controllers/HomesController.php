<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class HomesController extends Controller
{


/*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */



public function success()
    {
   	return view('success');
    }

public function create()
    {
    return view('edit');
    }


public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Title' => 'required|between:8,255',
            'street' => 'required|between:8,255',
            'Price' => 'required|between:1,10',
            'Price' => 'required|between:1,10',
        ]);
        $c= new \App\Home;
        $c->city=$request->SelectedCity;
        $c->title=$request->Title;
        $c->desription=$request->Description;
        $c->price=$request->Price;
        $c->imagePath = $request->file('imageHere')->store('public/images');
        $c->room_count=$request->SelectedRoomCount;
        $c->sleep_places=$request->SelectedSleepPlaces;
        $c->street=$request->street;
        $c->owner=Auth::user()->name;

        $c->wifi= $request->has('wifi') ? 'checked' : '';
        $c->boiler= $request->has('boiler') ? 'checked' : '';
        $c->ac= $request->has('ac') ? 'checked' : '';  
        $c->parking= $request->has('parking') ? 'checked' : '';          
        $c->safe= $request->has('safe') ? 'checked' : '';
        $c->washing_machine= $request->has('washing_machine') ? 'checked' : '';
        $c->tv= $request->has('tv') ? 'checked' : '';
        $c->iron= $request->has('iron') ? 'checked' : '';
    	$c->save();
        $createdID=$c->id;
        return view('success',compact('createdID'));
    }

 
public function loadmyads()
    {

        $owner_ids=[];
    	$appartments=\App\Home::where('owner',Auth::user()->name)->get();    
        $owner_ids=\App\Home::select('id')->where('owner',Auth::user()->name)->get();
        $bookings=\App\booking::whereIn('ad_id',$owner_ids) ->where('booked_by_user','<>', '')->get();
        $myacceptedbookings=\App\booking::where('booked_by_user', Auth::user()->name)->get();
        $bookedIds=[];
            foreach ($myacceptedbookings as $booking) 
            {
                array_push($bookedIds, $booking->ad_id);
            }
        $booked_by_me =\App\Home::select('title','city','street','id')->whereIn('id',$bookedIds)->get();
        $choosenTab='AdsButton';
    	return view('home',compact('appartments','bookings','myacceptedbookings','booked_by_me','choosenTab')); 
        ;
    }



   



public function bookdate(Request $request, $id)
    {
        $isbookingpossible=True;
        $booked_dates=\App\booking::where('ad_id',$id)->where('is_booking_accepted', True)->get();       
        $wanttobookRange=CarbonPeriod::create(Carbon::parse($request->bookstart),Carbon::parse($request->bookend));
        foreach ($booked_dates as $dates) 
            {
            $bookedRange =CarbonPeriod::create($dates->booked_from, $dates->booked_till);
                foreach ($bookedRange as $range)            
                      foreach ($wanttobookRange as $wanttobook)                    
                        if ($wanttobook == $range)
                        {  
                         $isbookingpossible=False;
                        return back()->with('fail' , 'Choosen dates are unavailable');
                        break;                 
                        }
              }        
        if ($isbookingpossible==True)
            {
            $c= new \App\booking;
            $c->ad_id=$id;
            $c->booked_from=$request->bookstart;
            $c->booked_till=$request->bookend;
            $c->booked_by_user=Auth::user()->name;
            $c->is_booking_accepted=False;
            $c->save();
            return back()->with('success' , 'Your request was sent');
            }
    }





public function acceptbooking(Request $request)
    {
        if ($request->SubmitAction=='Accept')
        {
            $book= \App\booking::where('booked_from',$request->booked_from)->where('booked_till',$request->booked_till)->where('ad_id',$request->ad_id)->first();
         $book->is_booking_accepted= True;
         $book->save();
        }
        elseif ($request->SubmitAction=='Cancel')
        {
            $book= \App\booking::where('booked_from',$request->booked_from)->where('booked_till',$request->booked_till)->where('ad_id',$request->ad_id)->first();
            $book->delete();  
        }
        return back()->with('choosenTab','BookingButton'); 
    }


public function updateuser(Request $request, $action)
    {
        if ($action=='change_info')
        {
            $updateuser= Auth::user();
            $updateuser ->phone_number= $request->phone_number;
            $updateuser ->skype= $request->skype;
            $updateuser ->city= $request->city;
            if (!Auth::user()->avatar <>0)
            $updateuser->avatar = $request->file('avatarHere')->store('/public/images/avatars');
        }

        elseif ($action=='change_password') 
        {
            $validatedData = $request->validate(['password' => 'required|between:8,255|confirmed']);           
            $updateuser= Auth::user();
            $updateuser->password = Hash::make($request->password);
        }

        $updateuser->save();
      //  $choosenTab="ProfileButton";
        return back()->with('choosenTab','ProfileButton'); 
    }


public function editad($id)
  {
    $appartments=\App\Home::where('id',$id)->get();
    if (Auth::user()->name == $appartments[0]->owner)  
    {
        $bookedstring=[];
        $rowcount =round(\App\Home::where('city',$id)->count()/4);
        $adcount=\App\Home::where('city',$id)->count();
        $cityname=$id;
        $bookings=\App\booking::where('ad_id',$id)->where('is_booking_accepted',True)->get();
        $phone=\App\User::select('phone_number')->where('name', $appartments[0]->owner)->first();           
        foreach ($bookings as $booking) 
        {
            $bookedRange=CarbonPeriod::create($booking->booked_from, $booking->booked_till);
            foreach ($bookedRange as $key=> $range) 
            {              
                array_push($bookedstring, $range->format('Y-m-d'));
            }
        }
       $bookings=\App\booking::where('ad_id',$id)->get();
        return view('editad',compact('appartments','cityname','adcount','rowcount','bookings','bookedstring','phone'));
        }
 

        
  }





public function savechanges(Request $request, $id)
    {
            $c= \App\Home::find($id);
            $c->title=$request->Title;
            $c->desription=$request->Description;
            $c->price=$request->Price;
            if ($request->file('imageHere') >0) 
                {  
                     $c->imagePath = $request->file('imageHere')->store('public/images');
                }
            $c->room_count=$request->SelectedRoomCount;
            $c->sleep_places=$request->SelectedSleepPlaces;
            $c->street=$request->street;
            $c->wifi= $request->has('wifi') ? 'checked' : '';
            $c->boiler= $request->has('boiler') ? 'checked' : '';
            $c->ac= $request->has('ac') ? 'checked' : '';
            $c->parking= $request->has('parking') ? 'checked' : '';           
            $c->safe= $request->has('safe') ? 'checked' : '';           
            $c->washing_machine= $request->has('washing_machine') ? 'checked' : '';        
            $c->tv= $request->has('tv') ? 'checked' : '';          
            $c->iron= $request->has('iron') ? 'checked' : '';
            $c->save();
            return redirect()->to('/adview/'.$id); 
    }


public function homeEdit(Request $request, $id)
    {
    if ($request->adaction=='Delete')
        {
            $ad= \App\Home::where('id',$id)->first();
            $bookings_count=\App\booking::where('ad_id',$id)->count();
            $ad_bookings= \App\booking::where('ad_id',$id)->first(); 
            Storage::delete($ad->imagePath);
            $ad->delete();
            if (!$bookings_count == 0)
            {
            $ad_bookings->delete();
            }
            return redirect()->to('/home'); 
        }
        elseif ($request->adaction=='Edit') 
        {
            return redirect()->to('/adview/'.$id.'/edit');       
        }
    }


}






