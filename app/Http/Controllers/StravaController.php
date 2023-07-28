<?php

namespace App\Http\Controllers;

use App\Models\stravaactivity;
use App\Models\stravauser;
use App\Models\stravauserauth;
use App\Models\User;
use App\Models\userfetchlog;
use DateTime;
use Iamstuartwilson\StravaApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Expectation;
use PHPUnit\Framework\Exception;

class StravaController extends Controller
{
    protected $api;

    public function getAuth(Request $request){
        
        $allParam = $request->all();
        if(!isset($allParam['code'])){
            return view('first_page');
        }
        $code = $allParam['code'];
        $scope = $allParam['scope'];
        // dd($code);
        $STRAVA_CODE = env("STRAVA_CODE", 75321);
        $api = new StravaApi(
            $STRAVA_CODE,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75'
        );
        $result = $api->tokenExchange($code);
        // dd($result);
        $accessToken = $result->access_token;
	    $refreshToken = $result->refresh_token;
        $expiresAt = $result->expires_at;
        // dump($result);

        Session::put('code', $code);
        Session::put('accessToken', $accessToken);
        Session::put('refreshToken', $refreshToken);
        Session::put('expiresAt', $expiresAt);
        
        //fetch data for current month and redirect to personal dashboard
        //1. fetch personal data
            $this->pullUserData($request);
        //2. fetch activity data
            $this->pullActivityData($request);
        //
        return redirect()->route('home.personal_board')
        ->with('success','Data pulled successfully');
        return view('auth_page');
    }
    public function refreshToken($id){
        $api = new StravaApi(
            75321,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75',
        );
        $sucreate = stravauserauth::where('user_id',$id)->first()->toArray();
        $accessToken = $sucreate['accessToken'];// Session::get('accessToken');
        $refreshToken = $sucreate['refreshToken'];//Session::get('refreshToken');
        $expiresAt = $sucreate['expiresAt'];//Session::get('expiresAt');

        // $accessToken =  Session::get('accessToken');
        // $refreshToken = Session::get('refreshToken');
        // $expiresAt = Session::get('expiresAt');
        $api->setAccessToken($accessToken, $refreshToken);
        $result = $api->tokenExchangeRefresh();
        if(!isset($result->access_token)){
            dump($result);
            $sua = [];
            $sua['error']='faild';
            return $sua;    
        }else{
            // dump($result);
        }
        $accessToken = $result->access_token;
	    $refreshToken = $result->refresh_token;
        $expiresAt = $result->expires_at;
        // Session::put('accessToken', $accessToken);
        // Session::put('refreshToken', $refreshToken);
        // Session::put('expiresAt', $expiresAt);
        //update auth
        $sua = [];
        // $id = Auth::user()->id;
        $sua['accessToken']=$accessToken;
        $sua['refreshToken']=$refreshToken;
        $sua['expiresAt']=$expiresAt;
        $sucreate = stravauserauth::where('user_id',$id)->update($sua);
        // dd($result);
        return $sua;
    }
    /**
     * 
     */
    public function getdatabycron($start,$end){
        // dump($start);
        // dump($end);
        // dd();
        $userObj = stravauserauth::whereBetween('user_id',[$start,$end])->orderBy('user_id', 'asc')->get(['user_id']);
        // $userObj = stravauserauth::orderBy('user_id', 'asc')->get(['user_id']);
        // $userObj = stravauserauth::orderBy('user_id','>','130')->get(['user_id']);
        foreach($userObj as $key=>$val){
            dump($val->user_id);
            // echo $val->user_id." , ";    

            $ugobj = new userfetchlog();
            $ugobj->user_id = $val->user_id;
            $ugobj->update_date = new DateTime();
            $ugobj->save();

            try{
                $this->fetch_data($val->user_id,'cron');
            }catch(Exception $ex){
                dump( $ex);
            }
        }
    }
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fetch_data($id,$cron=null)
    {
        try{
           
        
        // dump($id);
        //daily
        $api = new StravaApi(
            75321,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75'
        );

        // $authData = stravauserauth::where('user_id',1)->first();
        $sucreate = stravauserauth::where('user_id',$id)->first();
    //    dd($sucreate);
        if(!$sucreate){
            return redirect()->route('home.board')
            ->with('success','Please contact admin');
        }
        $sucreate = $sucreate->toArray();
        $accessToken = $sucreate['accessToken'];// Session::get('accessToken');
        $refreshToken = $sucreate['refreshToken'];//Session::get('refreshToken');
        $expiresAt = $sucreate['expiresAt'];//Session::get('expiresAt');
        // dd($expiresAt);
        // test
        // $t=time();
        // dump($t);
        // dump($expiresAt);
        // if($expiresAt<=$t){
        //     // echo "expires <br>";
        //     // echo date('m/d/Y', $expiresAt);
        //     // dump($expiresAt);
        //     // exit;
        //     $id = $id?$id:Auth::user()->id;
            

        //     $sua = $this->refreshToken($id);
        //     if(isset($sua['error'])){
        //         return true;
        //     }
        //     $accessToken = $sua['accessToken'];// Session::get('accessToken');
        //     $refreshToken = $sua['refreshToken'];//Session::get('refreshToken');
        //     $expiresAt = $sua['expiresAt'];//Session::get('expiresAt');
            
        //     // update stravauserauth
        //     // stravauserauth::where('user_id',$id)  // find your user by their email
        //       // optional - to ensure only one record is updated.
        //     // ->update(['accessToken' => $accessToken,'refreshToken' => $refreshToken,'expiresAt' => $expiresAt]);


        // } else{
        //     // echo "current <br>";
        //     // echo date('d/m/Y h:i:s', $t);
        //     // dump($t);
        // }
        // exit;
        //test
        // $accessToken =  Session::get('accessToken');
        // $refreshToken = Session::get('refreshToken');
        // $expiresAt = Session::get('expiresAt');
        try{
            $id = $id?$id:Auth::user()->id;
            $sua = $this->refreshToken($id);
            if(isset($sua['error'])){
                return true;
            }
            $accessToken = $sua['accessToken'];// Session::get('accessToken');
            $refreshToken = $sua['refreshToken'];//Session::get('refreshToken');
            $expiresAt = $sua['expiresAt'];//Session::get('expiresAt');
            $api->setAccessToken($accessToken, $refreshToken, $expiresAt);
        }catch(Exception $ex){
            $sua = $this->refreshToken($id);
            $accessToken = $sua['accessToken'];// Session::get('accessToken');
            $refreshToken = $sua['refreshToken'];//Session::get('refreshToken');
            $expiresAt = $sua['expiresAt'];//Session::get('expiresAt');
            $api->setAccessToken($accessToken, $refreshToken, $expiresAt); 
        }
        
        // dd("test");
        //get athleteData
        // $this->getAthleteData($api);
        
        //get athleteActivity
        $current = 'today';
        
        $this->getAthleteActivityData($api,$current,$id);


        if($cron=="cron"){
            return true;
        }else{
            return redirect()->route('home.board')
        ->with('success','Data pulled successfully');
        }
        }catch(Exception $ex){
        dump( $ex);
        }
    }
    public function auth_page(){

        $refreshToken = Session::get('refreshToken');
        $api = new StravaApi(
            75321,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75',
        );
        $accessToken =  Session::get('accessToken');
        $refreshToken = Session::get('refreshToken');
        $expiresAt = Session::get('expiresAt');
        dump($accessToken, $refreshToken, $expiresAt);
        // dd();
        try{
            
        $api->setAccessToken($accessToken, $refreshToken, $expiresAt);   
        }catch(Expectation $ex){
            dd($ex);

        }
        // dump($api->isTokenRefreshNeeded());
        
        $result = $api->tokenExchangeRefresh();
        $accessToken = $result->access_token;
	    $refreshToken = $result->refresh_token;
        $expiresAt = $result->expires_at;
        Session::put('accessToken', $accessToken);
        Session::put('refreshToken', $refreshToken);
        Session::put('expiresAt', $expiresAt);
        return true;
       
        return view('auth_page');
    }
    public function pullUserData(Request $request){

        $id = Auth::user()->id;
        $udata = stravauser::where('user_id',$id)->first();
        if($udata){
         $data = json_decode($udata['raw_data']);
         $username = $udata['username'];
         return view('user_page')->with('username',$username);
        }
        
        
        $api = new StravaApi(
            75321,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75'
        );
       
        $accessToken =  Session::get('accessToken');
        $refreshToken = Session::get('refreshToken');
        $expiresAt = Session::get('expiresAt');
        try{
            $result = $api->setAccessToken($accessToken, $refreshToken, $expiresAt);
        }catch(\Exception $ex){
            $this->auth_page();
        }
        
        $accessToken =  Session::get('accessToken');
        $refreshToken = Session::get('refreshToken');
        $expiresAt = Session::get('expiresAt');
        
        $result = $api->setAccessToken($accessToken, $refreshToken, $expiresAt);
        if(!$result){
            return view('user_page')->with('message','Please hit strava connect');
        }
        $data = $api->get(
            'athlete'
        );
        
    //  dd($data);
        $id = Auth::user()->id;
        $d= [];
        $d['strava_id'] =$data->id;
        $d['user_id'] =$id;
        $d['username'] =(isset($data->username) && $data->username)?$data->username:$data->firstname;
        $d['raw_data'] =json_encode($data);
        
        //insert user
        try{
            $sucreate = stravauser::insert($d);

            //update auth
            $sua = [];
            $sua['stravaactivity_id']= $data->id;
            $sua['user_id']= $id;
            $sua['accessToken']=$accessToken;
            $sua['refreshToken']=$refreshToken;
            $sua['expiresAt']=$expiresAt;
            $sua['isActive']=1;
            $sucreate = stravauserauth::insert($sua);
 
        }catch(Exception $ex ){
            dd($ex);
        }
        $udata = stravauser::where('user_id',$id)->first();
        if($udata){
         $data = json_decode($udata['raw_data']);
         $username = $udata['username'];
        //  return view('user_page')->with('username',$username);
         return true;
        }
        return true;
        // return redirect()->route('home.first_page'); 
        
    }
    public function pullActivityData(Request $request){

        $api = new StravaApi(
            75321,
            'c3449a4896e4de279405aa2e86c4e5040fed5a75'
        );
       
        $accessToken =  Session::get('accessToken');
        $refreshToken = Session::get('refreshToken');
        $expiresAt = Session::get('expiresAt');

        // test
        $t=time();
        
        if($expiresAt<$t){
            echo "expires <br>";
            echo date('m/d/Y', $expiresAt);
            // dump($expiresAt);
            // exit;
            $id = Auth::user()->id;
            $sua= $this->refreshToken($id);
            $accessToken = $sua['accessToken'];// Session::get('accessToken');
            $refreshToken = $sua['refreshToken'];//Session::get('refreshToken');
            $expiresAt = $sua['expiresAt'];//Session::get('expiresAt');
            
            Session::put('accessToken', $accessToken);
            Session::put('refreshToken', $refreshToken);
            Session::put('expiresAt', $expiresAt);
        } else{
            echo "current <br>";
            echo date('d/m/Y h:i:s', $t);
            dump($t);
        }
        // exit;
        //test
        
        // dd($expiresAt);
        $api->setAccessToken($accessToken, $refreshToken, $expiresAt);
        //get athleteData
        // $this->getAthleteData($api);
        
        //get athleteActivity
        $this->getAthleteActivityData($api);
        return true;
        // return redirect()->route('home.first_page'); 
        // return "pullActivityData";
    }

    public function getAthleteData($api){
        $data = $api->get(
            'athlete'
        );
        dd($data);  
        $id = Auth::user()->id;
        $d= [];
        $d['strava_id'] =$data->id;
        $d['user_id'] =$id;
        $d['username'] =$data->username;
        $d['raw_data'] =json_encode($data);
        dd($d);
        //insert user
        try{
            $sucreate = stravauser::insert($d);
        }catch(Exception $ex ){
            dd($ex);
        }
        return "get rate";
    }

    public function getActivitAth($api,$pagenumber,$numberofrecord = 10,$before = null,$after = null){
        if(!$before){
            $before = strtotime(date('Y-m-01 00:00:00')); // == 1338534000
        }
        if(!$after){
            $after = strtotime(date('Y-m-31 00:00:00')); // == 1338534000
        }
        // dump($before);
        // dump($after);
        // dd();
        try{

        
        $data = $api->get(
            'athlete/activities',
            [
                'page' => $pagenumber,
                'per_page' => $numberofrecord,
                'before'=>$after,//'1648023976',
                'after'=>$before//'1644973199'
                // 'before'=>'1648023976',
                // 'after'=>'1644973199'
            ]
        );
        }catch(Exception $ex){
            dd($ex);
        }
        // dump($data);
        return $data;
    }
    public function getsavedata($data,$id=null){
        // dd($data);
        $i=0;
        foreach($data as $kd=>$vd){
            if(isset($vd->id)){
            ++$i;
            $data = [];
            $user_id = $id?$id:Auth::user()->id; 
            $sucreate = stravaactivity::where('stravaactivity_id',$vd->id)->where('user_id',$user_id)->count();
            if($sucreate == 0){
                $data['stravaactivity_id'] = isset($vd->id)?$vd->id:null;
                $data['athlete_id'] = isset($vd->athlete->id)?$vd->athlete->id:null;
                $data['distance'] = isset($vd->distance)?$vd->distance:null;
                $data['type'] = isset($vd->type)?$vd->type:null;
                $data['workout_type'] = isset($vd->workout_type)?$vd->workout_type:null;
                $data['start_date_local'] =isset($vd->start_date_local)? new \DateTime($vd->start_date_local):null;
                $data['average_speed'] = isset($vd->average_speed)?$vd->average_speed:null;
                $data['max_speed'] = isset($vd->max_speed)?$vd->max_speed:null;
                // $data['name'] = isset($vd->name)?$vd->name:null;
                $data['raw_data'] = json_encode($vd);
                $data['user_id'] =$user_id; 
                $sucreate = stravaactivity::insert($data);
            }
            }
        }
        return $i;
    }

    public function getAthleteActivityData($api,$today=null,$id=null){

        if($today){
            $page = 1;
            
            $before   = strtotime("-1 day 00:00:00");
            $after   = strtotime("today 23:59:59");
            $data = $this->getActivitAth($api,$page,10,$before,$after);
            
            $return  = $this->getsavedata($data,$id);
            // dd($return);
        }else{
            $page = 1;
            $data = $this->getActivitAth($api,$page,10);

            $return  = $this->getsavedata($data,$id);
            
            while($return == 10){
                ++$page;
                $data = $this->getActivitAth($api,$page,10);
                $return  = $this->getsavedata($data,$id);
            }
        }

        // $i = 1;
        // $n = 0;
        // foreach($data as $kd=>$vd){
        //     ++$i;
        //     ++$n;
        //     $data = [];
        //     $data['stravaactivity_id'] = $vd->id;
        //     $data['athlete_id'] = $vd->athlete->id;
        //     $data['distance'] = $vd->distance;
        //     $data['type'] = $vd->type;
        //     $data['workout_type'] = $vd->workout_type;
        //     $data['start_date_local'] = new \DateTime($vd->start_date_local);
        //     $data['average_speed'] = $vd->average_speed;
        //     $data['max_speed'] = $vd->max_speed;
        //     $data['raw_data'] = json_encode($vd);
        //     $data['user_id'] = Auth::user()->id; 
        //     $sucreate = stravaactivity::insert($data);
        //     //api
        //     $data = $this->getActivitAth($api,$i,10);
        //     //update
        //     if($n > 10){
        //         $n = 0;
        //         ++$i;
        //         $data = $this->getActivitAth($api,$i,10);
        //     }
        // }
        return "get rate";
    }


}
