<?php
    
namespace App\Http\Controllers;

use App\Exports\ExportUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ImportUser;
use App\Models\review;
use App\Models\stravaactivity;
use App\Models\stravauser;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function profile($id=null){
        $city['ABOHAR']='ABOHAR';
        $city['AHMEDABAD']='AHMEDABAD';
        $city['AMRAVATI']='AMRAVATI';
        $city['ANAND']='ANAND';
        $city['AURANGABAD']='AURANGABAD';
        $city['BHARUCH']='BHARUCH';
        $city['BHAVNAGAR']='BHAVNAGAR';
        $city['BORSAD']='BORSAD';
        $city['DAHOD']='DAHOD';
        $city['DANGAR KHERA']='DANGAR KHERA';
        $city['DHANGADHARA']='DHANGADHARA';
        $city['GANDHINAGAR']='GANDHINAGAR';
        $city['HIMMATNAGAR']='HIMMATNAGAR';
        $city['HYDERABAD']='HYDERABAD';
        $city['JAIPUR']='JAIPUR';
        $city['JAMNAGAR']='JAMNAGAR';
        $city['KALOL']='KALOL';
        $city['KANPUR NAGAR']='KANPUR NAGAR';
        $city['KARAMSAD']='KARAMSAD';
        $city['LUDHIANA']='LUDHIANA';
        $city['MANDVI']='MANDVI';
        $city['MEHSANA']='MEHSANA';
        $city['MUNDRA']='MUNDRA';
        $city['NADIAD']='NADIAD';
        $city['NADIAD']='NALASOPARA';
        $city['NAVI MUMBAI']='NAVI MUMBAI';
        $city['PALANPUR']='PALANPUR';
        $city['PATAN']='PATAN';
        $city['RAJKOT']='RAJKOT';
        $city['VADODARA']='VADODARA';
        $city['VALLABHVIDHYA NAGAR']='VALLABHVIDHYA NAGAR';
        $city['VAPI']='VAPI';   

        $state['BIHAR']='BIHAR';
        $state['GUJARAT']='GUJARAT';
        $state['MAHARASTRA']='MAHARASTRA';
        $state['PUNJAB']='PUNJAB';
        $state['RAJASTHAN']='RAJASTHAN';
        $state['TELANGANA']='TELANGANA';
        $state['UTTAR PRADESH']='UTTAR PRADESH';

        $chapter['OTHER']='OTHER';
        $chapter['SCC CENTRAL']='SCC CENTRAL';
        $chapter['SCC DHRANGADHRA']='SCC DHRANGADHRA';
        $chapter['SCC EAST']='SCC EAST';
        $chapter['SCC NORTH']='SCC NORTH';
        $chapter['SCC PALANPUR']='SCC PALANPUR';
        $chapter['SCC SBR']='SCC SBR';

        $gender['MALE'] = "MALE";
        $gender['FEMALE'] = "FEMALE";
        $today = \Carbon\Carbon::today();
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfMonth());
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfMonth());

        if(!$id){
            $user = Auth::user();
        }else{
            $user = User::where('id',$id)->first();
        }
        //  get profile pic
        $stravaUser = stravauser::where('user_id',$user->id)->first();
        $data =[];
        $data['strava_profile_link']=null;
        $data['30']=0;
        $data['50']=0;
        $data['100']=0;
        $data['highest']=0;
        $data['total']=0;
        $data['lastActivity']=0;
        $data['page']='profile';
        $data['user']=$user;
        $data['profile_pic']='';

        if($stravaUser){
            $json = json_decode($stravaUser->raw_data);

        $data =[];
        $data['strava_profile_link']=null;
        

        if($json){
            $data['strava_profile_link']=isset($json->id)?"https://www.strava.com/athletes/$json->id":null;   
        }
        //activities start
        
        $data['30']=0;
        $data['50']=0;
        $data['100']=0;
        $data['highest']=0;
        $data['total']=0;
        $data['lastActivity']=0;

        $sActivity = stravaactivity::where('user_id',$user->id)
        ->whereBetween('stravaactivity.start_date_local', [$to, $from])
        ->get();
        $data['lastActivity']=stravaactivity::where('user_id',$user->id)
        ->whereBetween('stravaactivity.start_date_local', [$to, $from])
        ->orderBy('stravaactivity.start_date_local', 'desc')
        ->limit(5)
        ->get(); 
        // dd($data['lastActivity']);




        foreach($sActivity as $keyActy=>$vluActy){
            // dd($vluActy['distance']);
            if($vluActy['distance']>100000){
                $data['100']+=1;
            }elseif($vluActy['distance']>50000){
                $data['50']+=1;
            }elseif($vluActy['distance']>30000){
                $data['30']+=1;
            }
            //highest
            if($vluActy['distance']>$data['highest']){
                $data['highest'] = $vluActy['distance'];
            }
            $data['total'] += $vluActy['distance'];
        }
        
        $data['profile_pic']=isset($json->profile)?$json->profile:null;;
        $data['page']='profile';
        $data['user']=$user;

        }
        
        return view('users.profile',compact('data','city','state','gender','chapter'));
    }
    public function review($id=null){
       
        $today = \Carbon\Carbon::today();
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->startOfMonth());
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $today->endOfMonth());

        if(!$id){
            $user = Auth::user();
        }else{
            $user = User::where('id',$id)->first();
        }
        //  get profile pic
        $stravaUser = stravauser::where('user_id',$user->id)->first();
        $data =[];
        $data['strava_profile_link']=null;
        $data['30']=0;
        $data['50']=0;
        $data['100']=0;
        $data['highest']=0;
        $data['total']=0;
        $data['lastActivity']=0;
        $data['page']='profile';
        $data['user']=$user;
        $data['profile_pic']='';

        if($stravaUser){
            $json = json_decode($stravaUser->raw_data);
            $data['profile_pic']=isset($json->profile)?$json->profile:null;;
        }
        
        $data['page']='review';
        $data['user']=$user;
        $review = review::all();
        $rdata=[];
            foreach($review as $rkey=>$rvlu){
                $rdatatemp=[];
                
                $rdatatemp1 = User::where('id',$rvlu->user_id)->first(['name']);
                
                $rdatatemp['name'] = $rdatatemp1->name;
                $rdatatemp['review'] = $rvlu->review;
                $rdatatemp['date'] = $rvlu->review_date;
                $rdata[]=$rdatatemp;
            }
        $data['review'] = $rdata;
        
        
        return view('users.review',compact('data'));
    }
    public function saveProfile(Request $request){
        $param = $request->all();
        // dd($param);
        if(isset($param['id'])){
            User::where('id',$param['id'])->update($param);
            return redirect()->route('user.profile')->with('success','Profile updated Successfully');;
        }
    }
    public function saveReview(Request $request){
        $param = $request->all();
        
        if(isset($param['id'])){
            review::create([
                'user_id'=>$param['id'],
                'review'=>$param['review'],
                'review_date'=>new DateTime()
            ]);
            
            // User::where('id',$param['id'])->update($param);
            return redirect()->route('user.review')->with('success','Review posted Successfully');;
        }
    }

    public function importView(Request $request){
        return view('importFile');
    }
 
    public function import(Request $request){
        Excel::import(new ImportUser,
                      $request->file('file')->store('files'));
    dd("test");
        return redirect()->back();
    }
 
    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}