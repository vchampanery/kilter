<?php

namespace App\Http\Controllers;

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
        
        $userId = stravaactivity::where('user_id',$id)->get();
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
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function board()
    {
        $id = Auth::user()->id;
        
        $users = User::all();
        foreach($users as $uk=>$uv){
           $tempData = [];
           $tempData['id'] = 0;
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
                    ->where('user_id',$uv['id'])->get();
            $total_100=0; 
            $total_50=0; 
            $total_30=0; 
            // $total_10=0; 
           foreach($userActi as $k=>$v){
                if($v['distance'] > 100000){
                    $total_100+=1;
                }elseif($v['distance'] > 50000){
                    $total_50+=1;
                }elseif($v['distance'] > 30000){
                    $total_30+=1;
                }
                // elseif($v['distance'] > 10000){
                //     $total_10+=1;
                // }     
            $tempData['distance'] += $v['distance'];
            $tempData['total_ride'] = $tempData['total_ride'] + 1;
           }
        //    $tempData['total_10'] = $total_10;
           $tempData['total_30'] = $total_30;
           $tempData['total_50'] = $total_50;
           $tempData['total_100'] = $total_100;
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
                        ->groupBy('user_id')->get();
        $data = [];
        foreach($userActi as $k=>$v){
            $tempData = [];
            
           
            // $tempData['average_speed'] = $v->average_speed;
            // $tempData['max_speed'] = $v->max_speed;
            $tempData['total_ride'] = $v->total_ride;
            $username = User::where('id',$v->id)->first('name');
            $goal = usergoal::where('user_id',$v->id)->where('month',date('m'))->where('year',date('Y'))->first('goal');
            $todayData = stravaactivity::where('user_id',$v->id)->whereDate('start_date_local', '=', date('Y-m-d'))->first('distance');
            
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
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function personal_board()
    {
        $id = Auth::user()->id;
        //get strava data
        $stravaUserData = stravauser::where('user_id',$id)->first();
        $json = json_decode($stravaUserData->raw_data);
        
        Session::put('userName', $json->firstname.''.$json->lastname );
        Session::put('profile_pic', $json->profile);
        

        // var_dump(Session::has('expiresAt'));exit;
        // if(!Session::has('expiresAt')){
        //     $this->saveSessionData();
        // }
        //check activity exists or not 
          //check activity exists or not 
          $isexisting = stravaactivity::where('user_id', $id)->count();
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
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfMonth());
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfMonth());
        $data['total_rides'] = stravaactivity::where('user_id', $id)
        ->whereBetween('start_date_local', [$to, $from])->count();
         
        $userActi = stravaactivity::where('user_id', $id)->select(
            DB::raw("stravaactivity.user_id as id,sum(stravaactivity.distance) as distance,
                    avg(stravaactivity.average_speed) as average_speed,
                    max(stravaactivity.average_speed) as max_speed"))
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->groupBy('user_id')->first();

                    $longest = stravaactivity::where('user_id', $id)
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->select( DB::raw('max(distance) as maxdist'))->first();
                    $max_speed = stravaactivity::where('user_id', $id)
                    ->whereBetween('stravaactivity.start_date_local', [$to, $from])
                    ->max('max_speed');

        $data['total_km'] = isset($userActi['distance'])?$userActi['distance']:0;
        $data['total_avg_speed'] = isset($userActi['average_speed'])?$userActi['average_speed']:0;
        $data['total_longest_ride'] = isset($longest['maxdist'])?$longest['maxdist']:0;// $longest->maxdist;
        $data['max_speed_ride'] = isset($userActi['max_speed'])?$userActi['max_speed']:0;

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
        $data['total_rides'] = 
        $data['total_km'] = 2341;
        $data['total_avg_speed'] = 10;
        $data['total_longest_ride'] = 111;
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
