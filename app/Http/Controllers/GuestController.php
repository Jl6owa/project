<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class GuestController extends Controller
{
public function searchres($id)
    {
        $appartments=\App\Home::where('city',$id)->get();
       	$rowcount =round(\App\Home::where('city',$id)->count()/4);
       	$adcount=\App\Home::where('city',$id)->count();
       	$cityname=$id;
       	$k[]=$cityname;
        return view('searchres',compact('appartments','cityname','adcount','rowcount','k'));
    }



public function searchresall(Request $request)
    {
        $k=[];
        if ($request->selectedCity=='All')
        {
            $cities=\App\Home::select('city')->distinct()->get();
                foreach ($cities as $city) 
                    array_push($k, $city->city);
        }
        else
        {
            array_push($k, $request->selectedCity);  
        }

        $x=[];
        if ($request->selectedRooms=='All')
        {
            $cities=\App\Home::select('room_count')->distinct()->get();
            foreach ($cities as $city) 
                array_push($x, $city->room_count);
        }
        else
        {
            array_push($x, $request->selectedRooms);  
        }

        $b=[];
        if ($request->selectedSleepPlaces=='All')
        {
            $cities=\App\Home::select('sleep_places')->distinct()->get();
            foreach ($cities as $city) 
                array_push($b, $city->sleep_places);
        }
        else
        {
            array_push($b, $request->selectedSleepPlaces);  
        }
        $bookingIspossible=[];   
        $wanttoSearchRange=CarbonPeriod::create(Carbon::parse($request->trip_start),Carbon::parse($request->trip_end));
        $acceptbookings=\App\booking::select('ad_id','booked_from','booked_till')->where('is_booking_accepted',True)->get();
        foreach ($acceptbookings as $dates) 
        {
            $bookedRange =CarbonPeriod::create($dates->booked_from, $dates->booked_till);
            foreach ($bookedRange as $range) 
                foreach ($wanttoSearchRange as $wanttobook)                     
                    if ($wanttobook == $range)     
                        if (! in_array($dates->ad_id, $bookingIspossible)) array_push($bookingIspossible, $dates->ad_id); 
        }
        $appartments=\App\Home::whereNotIn('id',$bookingIspossible)->whereIn('city',$k)->whereIn('room_count',$x)->whereIn('sleep_places',$b)->get();
        $cityname=$request->SelectedCity;       
        return view('searchres',compact('appartments','cityname','k'));

    }



public function getcities()
    {
    	$towns=[];
		$classifiedscount=[];
    	$cities=\App\Home::select('city')->distinct()->get();
    	foreach ($cities as $city) 
        {
    	   $towns[].='/src/'.$city->city.'.png';
    	}
    	foreach ($cities as $city) 
        {
    	   $classifiedscount[]=\App\Home::select('city')->where('city',$city->city)->count();	
    	}
    	return view('welcome',compact('cities','towns','classifiedscount'));
    }


public function searchresAd($id)
    {
        $appartments=\App\Home::where('id',$id)->get();
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
        return view('adview',compact('appartments','cityname','adcount','rowcount','bookings','bookedstring','phone'));

    }

}
