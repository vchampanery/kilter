<?php

namespace App\Http\Controllers;

use App\Models\manualactivity;
use App\Models\Product;
use App\Models\stravaactivity;
use App\Models\stravauser;
use App\Models\stravauserauth;
use App\Models\User;
use App\Models\usergoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateTimeZone;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('personal_board');
    }
    public function hometest()
    {
        return view('hometestpage');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function first_page()
    {
        $id = Auth::user()->id;
        
        $userId = stravaactivity::where('user_id',$id)->where('type','Ride')->get();
        
        return view('first_page')->with('useractivity',$userId);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fpage()
    {
        $id = Auth::user()->id;
        
        $userId = Product::insert(['name'=>'123','detail'=>'asdfasf']);

        return true;
        
        // return view('fpage')->with('useractivity',$userId);
    }
    
    public function resetpassword(){

        return view('auth/reset_password');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function board()
    {
        $id = Auth::user()->id;
        // dd(Auth::user()->email);
        $users = User::all();
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth();
        foreach($users as $uk=>$uv){
           $tempData = [];
           $tempData['id'] = $uv['id']  ;
           $tempData['email'] = $uv['email'];
           $tempData['distance'] = 0;
           $tempData['average_speed'] = 0;
           $tempData['max_speed'] = 0;
           $tempData['total_ride'] = 0;
           // $username = User::where('id',$v->id)->first('name');
           // dd($username);
           $tempData['name'] = $uv['name'];
           
           $userActi = stravaactivity::select(
            DB::raw("stravaactivity.user_id as id,
                    stravaactivity.distance,
                    stravaactivity.average_speed,
                    stravaactivity.max_speed"))  
                    ->where('user_id',$uv['id'])
                    ->whereBetween('start_date_local',[$dateS,$dateE]) 
                    ->where('type','Ride')->get();
            $total_300=0; 
            $total_200=0; 
            $total_100=0; 
            $total_75=0; 
            $total_50=0; 
            $longest=0; 
            // $total_10=0; 
           foreach($userActi as $k=>$v){
            $longest = $v['distance']>$longest?$v['distance']:$longest;
            if($v['distance'] > 300000){
                $total_300+=1;
            }elseif($v['distance'] > 200000){
                $total_200+=1;
            }elseif($v['distance'] > 100000){
                    $total_100+=1;
                }elseif($v['distance'] > 75000){
                    $total_75+=1;
                }elseif($v['distance'] > 50000){
                    $total_50+=1;
                }
                // elseif($v['distance'] > 10000){
                //     $total_10+=1;
                // }     
            $tempData['distance'] += $v['distance'];
            $tempData['total_ride'] = $tempData['total_ride'] + 1;
           }
        //    $tempData['total_10'] = $total_10;
           $tempData['total_75'] = $total_75;
           $tempData['total_50'] = $total_50;
           $tempData['total_100'] = $total_100;
           $tempData['total_200'] = $total_200;
           $tempData['total_300'] = $total_300;
           $tempData['longest'] = $longest;
           $data[]=$tempData;
       }

        // $userActi = stravaactivity::select(
        //         DB::raw("stravaactivity.user_id as id,
        //                 sum(stravaactivity.distance) as distance,
        //                 avg(stravaactivity.average_speed) as average_speed,
        //                 avg(stravaactivity.max_speed) as max_speed,
        //                 count(stravaactivity.id) as total_ride"))  
        //                 ->groupBy('user_id')->get();
        // $data = [];
        // foreach($userActi as $k=>$v){
        //     $tempData = [];
        //     $tempData['id'] = $v->id;
        //     $tempData['distance'] = $v->distance;
        //     $tempData['average_speed'] = $v->average_speed;
        //     $tempData['max_speed'] = $v->max_speed;
        //     $tempData['total_ride'] = $v->total_ride;
        //     $username = User::where('id',$v->id)->first('name');
        //     // dd($username);
        //     $tempData['name'] = $username['name'];
        //     $data[]=$tempData;
        // }
        // dd($data);
        return view('board')->with('useractivity',$data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function goalboard()
    {
        $id = Auth::user()->id;
        
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now()->endOfMonth();
        // dump($dateS,$dateE);exit; 
        $userActi = stravaactivity::select(
                DB::raw("stravaactivity.user_id as id,sum(stravaactivity.distance) as distance,
                    avg(stravaactivity.average_speed) as average_speed,
                        avg(stravaactivity.max_speed) as max_speed,
                        count(stravaactivity.id) as total_ride"))
                        ->whereBetween('start_date_local',[$dateS,$dateE]) 
                        ->where('type','Ride') 
                        ->groupBy('user_id')->get();
        $data = [];
        foreach($userActi as $k=>$v){
            $tempData = [];
            
           
            // $tempData['average_speed'] = $v->average_speed;
            // $tempData['max_speed'] = $v->max_speed;
            $tempData['total_ride'] = $v->total_ride;
            $username = User::where('id',$v->id)->first('name');
            $goal = usergoal::where('user_id',$v->id)->where('month',date('m'))->where('year',date('Y'))->first('goal');
            $todayData = stravaactivity::where('user_id',$v->id)
            ->whereDate('start_date_local', '=', date('Y-m-d'))->where('type','Ride')->first('distance');
            
            $tempData['id'] = $v->id;
            $tempData['name'] = $username['name'];
            $tempData['goal'] = isset($goal['goal'])?$goal['goal']:0;
            $tempData['todayData'] = isset($todayData['distance'])?$todayData['distance']:0;
            $tempData['distance'] = $v->distance;

            $data[]=$tempData;
        }
        // dd($data);
        return view('goal_board')->with('useractivity',$data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addgoal(Request $request)
    {
        $id = Auth::user()->id;
         $month = date('m');
        $year = date('Y');
        $allParm = $request->all();
        
        if($allParm){

            $userGoal = usergoal::where('user_id',$id)->where('month',$month)->where('year',$year)->first();
            if($userGoal){
                usergoal::where('user_id',$id)->where('month',$month)->where('year',$year)->update(['goal'=>$allParm['goal']]   );
            }else{
            $ugobj = new usergoal();
            $ugobj->goal = $allParm['goal'];
            $ugobj->month = $month;
            $ugobj->year = $year;
            $ugobj->user_id = $id;
            $ugobj->save();
            }
            return redirect()->route('home.goal_board')
            ->with('success','Goal updated successfully');;
        }else{
            $userGoal = usergoal::where('user_id',$id)->where('month',$month)->where('year',$year)->first('goal');
            $tw = isset($userGoal['goal'])?$userGoal['goal']:0;
            return view('addgoal')->with('goal',$tw);
        }
    }

    public function addstravaactivity(Request $request)
    {
        $id = Auth::user()->id;
        $month = date('m');
        $year = date('Y');
        $allParm = $request->all();
        
        if($allParm){
            $datetimeTest = new DateTime();
            $curdate= $datetimeTest->format('Y-m-d');
            $manualactivity = manualactivity::where('user_id',$id)
            ->where('update_date',$curdate)->first();
            if($manualactivity){
                manualactivity::where('user_id',$id)
                    ->where('update_date',$curdate)
                    ->update(['distance'=>$allParm['distance'],'link'=>$allParm['link']]);
            }else{

                $ugobj = new manualactivity();
                $ugobj->user_id = $id;
                $ugobj->distance = $allParm['distance'];
                $ugobj->link = $allParm['link'];
                $ugobj->update_date = new DateTime();
                $ugobj->save();
            }
            return redirect()->route('home.personal_board')
            ->with('success','Your activity updated successfully');;
        }else{
           return view('addstravaactivity');
        }
    }

    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function personal_board(Request $request)
    {
        $id = Auth::user()->id;
        $range['current_month'] = "Current Month";
        $range['today'] = "Today";
        $range['last_day'] = "Last Day";
     $request = $request->post();

        // var_dump(Session::has('expiresAt'));exit;
        // if(!Session::has('expiresAt')){
        //     $this->saveSessionData();
        // }
        //check activity exists or not 
          //check activity exists or not 

          $isexisting = stravauser::where('user_id', $id)->count();
          if($isexisting ==0){
            return view('strava_connect');
          } 
         //get strava data
        $stravaUserData = stravauser::where('user_id',$id)->first();
        $json = json_decode($stravaUserData->raw_data);
        
        Session::put('userName', $json->firstname.''.$json->lastname );
        Session::put('profile_pic', $json->profile);


          $isexisting = stravaactivity::where('user_id', $id)->where('type','Ride')->count();
          if($isexisting == 0){
            $data['total_rides'] = 0;
            $data['total_km'] = 0;
            $data['total_avg_speed'] = 0;
            $data['total_longest_ride'] = 0;// $longest->maxdist;
            $data['max_speed_ride'] = 0;
    
            return view('personal_board')->with('data',$data);
            //   return view('strava_connect');
          }
        $today = Carbon::today();
        // $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfMonth());
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfMonth());
        $date1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $to = $date1->format('Y-m-1 00:00:00');
        $from = $date1->format('Y-m-31 23:59:59');


        $data['total_rides'] = stravaactivity::where('user_id', $id)
        ->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->count();
         
        $userActi = stravaactivity::where('user_id', $id)->select(
            DB::raw("stravaactivity.user_id as id,sum(stravaactivity.distance) as distance,
                    avg(stravaactivity.average_speed) as average_speed,
                    max(stravaactivity.average_speed) as max_speed"))
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->where('type','Ride')->groupBy('user_id')->first();

                    $longest = stravaactivity::where('user_id', $id)
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->select( DB::raw('max(distance) as maxdist'))->first();
                    $max_speed = stravaactivity::where('user_id', $id)
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->where('type','Ride')->max('max_speed');

        $data['total_km'] = isset($userActi['distance'])?$userActi['distance']:0;
        $data['total_avg_speed'] = isset($userActi['average_speed'])?$userActi['average_speed']:0;
        $data['total_longest_ride'] = isset($longest['maxdist'])?$longest['maxdist']:0;// $longest->maxdist;
        $data['max_speed_ride'] = isset($userActi['max_speed'])?$userActi['max_speed']:0;
        $data['range'] = $range;
        $data['selectrange'] = 'currrent_month';

        return view('personal_board')->with('data',$data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function team_board()
    {
        if(!Session::has('expiresAt')){
            $this->saveSessionData();
        }
        $data['total_rides'] = 0;
        $data['total_km'] =0;
        $data['avg_km_covered'] = 0;
        $data['highest_score'] = 0;
        $data['highest_scorer_name'] = '';
        $data['today_highest'] = 0;
        $data['today_highester_name'] = '';
        $data['longest_ride'] = 0;
        $data['longest_rider_name'] = '';
        $data['fastest_ride'] = 0;
        $data['fastest_rider_name']= '';
        $data['total_50_ride'] = 0;
        $data['total_100_ride']= 0;
        
        //total rides
        $today = Carbon::today();
        // $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfMonth());
        // $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfMonth());
        $date1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $to = $date1->format('Y-m-1 00:00:00');
        $from = $date1->format('Y-m-31 23:59:59');

        $data['tostart'] =$from;
        $data['toend']=  $to;
        $data['total_rides'] = stravaactivity::whereBetween('start_date_local', [$to, $from])->where('type','Ride')->count();
        //total km
        $data['total_km'] = stravaactivity::select( DB::raw("sum(stravaactivity.distance) as distance"))->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->first(['distance']);
        $data['total_km']=$data['total_km']->distance;
        $total = User::count();
        $data['avg_km_covered'] = (int)$data['total_km']/(int)$total; 
        //highest_score
        $maxRide = stravaactivity::select( DB::raw("sum(stravaactivity.distance) as distance,user_id"))->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->groupBy('user_id')->orderBy('distance','desc')->first();
        if($maxRide){
            $userObj = User::where('id',$maxRide->user_id)->first(['name']);
            $data['highest_score'] =$maxRide->distance;
            $data['highest_scorer_name'] = $userObj['name'];
        }
         
        //today_highest
        // $toToday = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfDay());
        // $fromToday = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfDay());
        $date1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $toToday = $date1->format('Y-m-d 00:00:00');
        $fromToday = $date1->format('Y-m-d 23:59:59');


        $date = Carbon::now();
        $date->addDays(1);
        $date->format("Y-m-d 00:00:00");
        $data['new_to_start'] =$date;
        $data['toToday'] = $fromToday;
        $data['fromToday']= $toToday;
        $date->format("Y-m-d 23:59:59");
        $data['new_to_end'] =$date;
        
        $date1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
        $data['curstart'] = $date1->format('Y-m-d 00:00:00');
        $data['curend'] = $date1->format('Y-m-d 23:59:59');

        $maxRide = stravaactivity::select('user_id','distance')->whereBetween('start_date_local', [$toToday, $fromToday])->where('type','Ride')->orderBy('distance','desc')->first();
        if($maxRide){
            $userObj = User::where('id',$maxRide->user_id)->first(['name']);
            $data['today_highest'] =$maxRide->distance;
            $data['today_highester_name'] = $userObj['name']; 
        }
        //longest_ride
        $longest_ride = stravaactivity::select('user_id','distance')->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->orderBy('distance','desc')->first();
        if($longest_ride){
            $userObj = User::where('id',$longest_ride->user_id)->first(['name']);
            $data['longest_ride'] =$longest_ride->distance;
            $data['longest_rider_name'] = $userObj['name']; 
        }
        //fastest_ride
        $longest_ride = stravaactivity::select('user_id','average_speed')->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->orderBy('average_speed','desc')->first();
        if($longest_ride){
            $userObj = User::where('id',$longest_ride->user_id)->first(['name']);
            $data['fastest_ride'] =$longest_ride->average_speed;
            $data['fastest_rider_name'] = $userObj['name']; 
        }
        $maxRide = stravaactivity::select('user_id','distance')->whereBetween('start_date_local', [$to, $from])->where('type','Ride')->orderBy('distance','desc')->get();
        
        foreach($maxRide as $ride){
            if($ride->distance >=100000){
                $data['total_100_ride'] =$data['total_100_ride']+1;
            }elseif($ride->distance >=50000){
                $data['total_50_ride'] =$data['total_50_ride']+1;
            }
        }
        return view('team_board')->with('data',$data);


    }
  
    public function saveSessionData(){
        $userObj = Auth::user();
        
        $sua = stravauserauth::where('user_id',$userObj->id)->first();
        
        Session::put('accessToken', $sua->accessToken);
        Session::put('refreshToken', $sua->refreshToken);
        Session::put('expiresAt', $sua->expiresAt);
    }

}
