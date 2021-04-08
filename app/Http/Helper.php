<?php  

function buttonMutakhir() {
    $timeCurrent = get_time_current_data_cache();
    $time = $timeCurrent?date('d M Y H:i',strtotime($timeCurrent)):'-';
    return "<a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"bottom\" href=\"".Request::fullUrlWithQuery(['refresh'=>1])."\" title=\"Klik untuk memutakhirkan data kembali. Atau menunggu 24 Jam untuk pemutakhiran otomatis.\"><i class=\"fa fa-refresh\"></i> Terakhir Dimutakhirkan <span style='color:red' title='".$time."'>".time_elapsed_string($timeCurrent)."</span></a>";
}

function get_current_data_cache() {
    $name = Request::fullUrlWithQuery(['refresh'=>'','page'=>'']);
    $name = str_replace(['&refresh=','?refresh=','&page=','?page='],'',$name);
    $name = str_slug($name,'');   
    $name .= getUserId(); 
    if(!g('refresh')) {
        if(Cache::has($name)) {
            return Cache::get($name)['data'];
        }else{
            return false;
        }   
    }    
}
function get_time_current_data_cache() {
    $name = Request::fullUrlWithQuery(['refresh'=>'','page'=>'']);
    $name = str_replace(['&refresh=','?refresh=','&page=','?page='],'',$name);
    $name = str_slug($name,'');
    $name .= getUserId();
    if(!g('refresh')) {
        if(Cache::has($name)) {
            return Cache::get($name)['time'];
        }else{
            return false;
        }
    }
} 
function put_current_data_cache($data,$minutes=3600) {   
    $name = Request::fullUrlWithQuery(['refresh'=>'','page'=>'']);
    $name = str_replace(['&refresh=','?refresh=','&page=','?page='],'',$name);
    $name = str_slug($name,'');  
    $name .= getUserId();  
    if(g('refresh')) {
        Cache::forget($name);
        $resp = redirect()->back();
        $resp->send();
        exit;       
    }else{
        Cache::put($name,['time'=>now(),'data'=>$data],$minutes);
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}

function convertMonthYear($month=null,$year=null) {
    if($month && $year) return \DateTime::createFromFormat('Y-n',$year.'-'.$month)->format('F Y');
}

function calculate_time_span($date){
    $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $secs = floor($seconds % 60);

        if($seconds < 60)
            $time = $secs." seconds ago";
        else if($seconds < 60*60 )
            $time = $mins." min ago";
        else if($seconds < 24*60*60)
            $time = $hours." hours ago";
        else if($seconds < 24*60*60)
            $time = $day." day ago";
        else
            $time = $months." month ago";

        return $time;
}

function getStatusActive($fromTime) {
    $minute = getMinuteDiff($fromTime);
    if($minute > 20) {
        return "Offline";
    }else{
        return "Online";
    }
}

function getMinuteDiff($fromTime) {
    $to_time = strtotime(date('Y-m-d H:i:s'));
    $from_time = strtotime($fromTime);
    return ($to_time - $from_time) / 60;
}

function kalendar($month=null,$year=null,$m=null) {
   $month = ($month)?:date('n');
   $year = ($year)?:date('Y');

   $first = 1;   
   $lastday = date('t',strtotime($year.'-'.$month.'-01'));

   $cals = [];
   $mingguKe = 0;
   for($i=$first;$i<=$lastday;$i++) {
        $dayName = date('l',strtotime($year.'-'.$month.'-'.$i));
        if($dayName=='Sunday') {
            $mingguKe++;
        }else{
            if($dayName!='Saturday') { 
                $mingguKe = ($mingguKe==0)?1:$mingguKe;               
                $cals[$mingguKe][] = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
            }
        }
   }
   if($m) {
    $cals = $cals[$m];
   }

   if(!$cals) {
    $cals = [];
   }

   return $cals;
}

function lastDate($year,$month) {
    return \DateTime::createFromFormat('Y-n',$year.'-'.$month)->format('Y-m-t');
}
function dayCount($tanggalAwal,$tanggalAkhir) {
    $date1 = new DateTime($tanggalAwal);
    $date2 = new DateTime($tanggalAkhir);
    return $date2->diff($date1)->format("%a");
}

function getSession($sessionID) {
    $row = first('app_sessions',['name'=>$sessionID]);
    if($row) {
        return $row->value;
    }else{
        return false;
    }
}
function putSession($sessionID,$value) {

    DB::table('app_sessions')->whereRaw("created_at > date_sub(now(), interval 1 month)")->delete();

    DB::table('app_sessions')->insert([
        'created_at'=>now(),
        'name'=>$sessionID,
        'value'=>$value
    ]);
    return true;
}

function modulePath($path) {
    return url(config('app.adminPath').'/'.Request::segment(2).($path?'/'.$path:''));
}

function countTable($table) {
    return DB::table($table)->whereNull('deleted_at')->count();
}

function generateKodeDokter() {
	$kode = 'D'.str_pad(DB::table('dokter')->count()+1, 5, 0, STR_PAD_LEFT);
	return $kode;
}
function generateKodeOutlet() {
	$kode = 'OLT'.str_pad(DB::table('outlet')->count()+1, 5, 0, STR_PAD_LEFT);
	return $kode;
}

function responseApiFailed($message=null) {
	$message = ($message)?:'failed';
	return response()->json(['api_status'=>0,'api_message'=>$message]);
}

function responseApiSuccess($message=null) {
	$message = ($message)?:'success';
	return response()->json(['api_status'=>1,'api_message'=>$message]);
}
 
function sendFCM($regID=[],$data){
    if(!$data['title'] || !$data['content']) return 'title , content null !';

    $apikey = config('app.google_fcm_api_key');
    $url   	= 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
	  'registration_ids' => $regID,
	  'data' => $data,
      'content_available'=>true,
      // 'notification'=>array(
      //       'sound'=>'default',
      //       'badge'=>0,
      //       'title'=>trim(strip_tags($data['title'])),
      //       'body'=>trim(strip_tags($data['content']))
      //   ),
      'priority'=>'high'
	);
    $headers = array(
      'Authorization:key=' . $apikey,
      'Content-Type:application/json'
    );

    $ch = curl_init($url); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0 );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0 );
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $chresult = curl_exec($ch);
    Log::info(json_encode($fields));
    Log::info($chresult);
    curl_close($ch);    
    return $chresult;
}

if(!function_exists('getMenu')) {
	function getMenu() {
		$result = DB::table('menu');         
        $result->where('parent_menu_id',0);          
        $result->whereNull('menu.deleted_at');
    	$result->orderby('sorting','asc');
    	$result = $result->get(); 
        foreach($result as &$row) {
            $child = DB::table('menu')
            ->where('parent_menu_id',$row->id)
            ->whereNull('menu.deleted_at')
            ->orderby('sorting','asc')->get();
            if($child) {                
                foreach($child as &$crow) {
                    $child2 = DB::table('menu')
                    ->where('parent_menu_id',$crow->id)
                    ->whereNull('menu.deleted_at')
                    ->orderby('sorting','asc')->get();
                    if($child2) {
                        $crow->child = $child2;
                    }else{
                        $crow->child = [];
                    }
                }
                $row->child = $child;
            }else{
                $row->child = [];
            }
        }
        return $result;
	}
}
if(!function_exists('comboMenu')) {
	function comboMenu($value=NULL,$parentID=0) {
		$result = getMenu($parentID);
		$option = "";
		foreach($result as $r) {
			$select = ($value == $r->id)?"selected":"";
			$option .= "<option $select value='$r->id'>$r->nama</option>";
			if($r->child) {
				foreach($r->child as $rr) {
					$select = ($value == $rr->id)?"selected":"";
					$option .= "<option $select value='$rr->id'>- $rr->nama</option>";
					if($rr->child) {
						foreach($rr->child as $rrr) {
							$select = ($value == $rrr->id)?"selected":"";
							$option .= "<option $select value='$rrr->id'>-- $rrr->nama</option>";
						}
					}
				}
			}
		}
		return $option;
	}
}

if(!function_exists('logIt')) {
	function logIt($string) {
		$filename = date('YmdHis').strtoupper(str_random(3));
		Log::useDailyFiles(storage_path().'/logs/'.$filename.'.log');
		Log::warning($string);
	}
}

function countSaturdayMonth($month=null,$year=null) {
    $lastDay = date('t',strtotime($year.'-'.$month.'-01'));
    $saturday = 0;
    for($i=1;$i<=$lastDay;$i++) {
        $dayName = DateTime::createFromFormat('j-n-Y',$i.'-'.$month.'-'.$year)->format('l');
        if($dayName == 'Saturday') {
            $saturday += 1;
        }
    }   
    return $saturday;
}

function countSundayMonth($month=null,$year=null) {
	$lastDay = date('t',strtotime($year.'-'.$month.'-01'));
	$sunday = 0;
	for($i=1;$i<=$lastDay;$i++) {
		$dayName = DateTime::createFromFormat('j-n-Y',$i.'-'.$month.'-'.$year)->format('l');
		if($dayName == 'Sunday') {
			$sunday += 1;
		}
	}	
	return $sunday;
}

//http://stackoverflow.com/a/15362385
if(!function_exists('weeksInMonth')) {
	function weeksInMonth($month=null,$year=null){
 
	    if( null==($year) ) {
	        $year =  date("Y",time());  
	    }

	    if(null==($month)) {
	        $month = date("m",time());
	    }

	    // find number of days in this month
	    $daysInMonths =  date('t',strtotime($year.'-'.$month.'-01'));

	    $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);

	    $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));

	    $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));

	    if($monthEndingDay<$monthStartDay){

	        $numOfweeks++;

	    }

	    return $numOfweeks;
	}
}

if(!function_exists('activeParentMenu')) {
	function activeParentMenu($childMenuPath=[]) {
		foreach($childMenuPath as $c) {
			if(Request::is(config('app.adminPath').'/'.$c.'*')) {
				return "active";
				break;
			}
		}
	}
}

if(!function_exists('createSubMenu')) {
	function createSubMenu($icon,$name,$subMenu=[]) {

		$paths = [];
		foreach($subMenu as $s) {
			$paths[] = $s['path'];
			$icons[] = $s['icons'];
		}		

		$active = activeParentMenu($paths);
		$html = '<li class="treeview '.$active.'">';
		$html .= '<a href="#"><i class="'.$icon.'"></i> <span>'.$name.'</span>';
		$html .= '<span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>';
		$html .= "</a>";
		$html .= '<ul class="treeview-menu">';
			foreach($subMenu as $menu) {
				$active = (Request::is(config('app.adminPath').'/'.$menu['path'].'*'))?"active":"";
				$html .= "<li class='".$active."'>";
				$html .= "<a href='".url(config('app.adminPath').'/'.$menu['path'])."'>
                            <i class='".$menu['icons']."'></i>
                            ".$menu['label']."
                          </a>";
				$html .= "</li>";
			}
		$html .= '</ul>';
		$html .= '</li>';    

		return $html;           
	}
}

if(!function_exists('sendEmail')) {
	function sendEmail($config=[]) {	
 
        \Config::set('mail.driver',getSetting('mail_type'));
        \Config::set('mail.host',getSetting('mail_hostname'));
        \Config::set('mail.port',getSetting('mail_port'));
        \Config::set('mail.username',getSetting('mail_username'));
        \Config::set('mail.password',getSetting('mail_password'));

		Mail::send("email.template",['content'=>$config['content']],function($message) use ($config) {
	    	$message->priority(1);
	        $message->to($config['to']);
	        $message->from(getSetting('email_admin'),'PHARMASOLINDO');
			if(getSetting('email_bcc')) $message->bcc(getSetting('email_bcc'));	        
	        $message->subject($config['subject']);
	    });
	}
}

/**
 * Get Module Permission
 * 
 * @return boolean
 */
if(!function_exists('getPermission')) {	
	function getPermission($module=NULL,$type='can_view',$roleID=NULL) {
		$module = ($module)?:Request::segment(2);
		@$roleID = ($roleID)?:getUser()->id_role;
		$row = first('role',['id'=>$roleID]);
		if($row) { 
			$config = $row->config;
			if($config && @unserialize($config)) {
				$config = unserialize($config);
				if(@$config[$module]) {					
					@$value = $config[$module][$type];
					if($value) {
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}				
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}

/**
 * Get current timestamp Y-m-d H:i:s
 *
 * @return dateTime
 */
if(!function_exists('now')) {
	function now() {
		return date('Y-m-d H:i:s');
	}
}

/**
 * Generate bootstrap alert 
 * 
 * @return string
 */
if(!function_exists('bootstrapAlert')) {
	function bootstrapAlert() {
		$message = Session::get('message');
		$type = Session::get('message_type');
		$type = ($type)?:"info";
		if($message && $type) {			
			return "<div class='alert alert-$type'>$message</div>";
		}
	}
}

/**
 * Redirect action
 * 
 * @return void
 */
if(!function_exists('goAction')) {
	function goAction($action,$message=NULL,$type=TRUE) {
		$res = redirect()->action($action);
		if($message) {
			$res->with(['message'=>$message,'message_type'=>($type == TRUE)?'success':'warning']);
		}                 
        \Session::driver()->save();
        $res->send();
        exit;
	}
}

/**
 * Redirect user to specific page
 * 
 * @return void
 */
if(!function_exists('redir')) {
	function redir($path,$message=NULL,$type='warning') {
		$res = redirect($path);
		if($message) {
			$res->with(['message'=>$message,'message_type'=>$type]);
		}                 
        \Session::driver()->save();
        $res->send();
        exit;
	}
} 

/**
 * Redirect user to back
 * 
 * @param string $message
 * @param string $type
 * @return void
 */
if(!function_exists('goBack')) {
	function goBack($message,$type='warning') {
		$res = redirect()->back()->with(['message'=>$message,'message_type'=>$type])->withInput();
		Session::driver()->save();
		$res->send();
		exit;
	}
}

/**
 * Get the rows of table
 *
 * @return object array
 */
if(!function_exists('getData')) {
	function getData($table,$condition=NULL,$orderbyString=NULL) {
		$rows = DB::table($table);
		if(Schema::hasColumn($table,'deleted_at')) {
			$rows->whereNull('deleted_at');
		}		
		if($condition) {
			$rows->whereRaw($condition);
		}		

        if($orderbyString) {
            $rows->orderByRaw($orderbyString);
        }

		return $rows->get();		
	}
}

/**
 * Get the rows of table
 *
 * @return object array
 */
if(!function_exists('getDataFull')) {
	function getDataFull($table,$condition=NULL,$orderbyString=NULL) {
		$columns = Schema::getColumnListing($table);

		$rows = DB::table($table);
		if(Schema::hasColumn($table,'deleted_at')) {
			$rows->whereNull($table.'.deleted_at');
		}		

		$rows->addselect($table.'.*');

		foreach($columns as $col) {
			if(substr($col, 0, 3) == 'id_') {
				$tableJoin = substr($col, 3);
				if(Schema::hasTable($tableJoin)) {
					$rows->leftjoin($tableJoin,$tableJoin.'.id','=',$table.'.'.$col);
					$tableJoinColumns = Schema::getColumnListing($tableJoin);
					foreach($tableJoinColumns as $jcol) {
						$rows->addselect(DB::raw('IFNULL('.$tableJoin.'.'.$jcol.',"") as '.$tableJoin.'_'.$jcol));
					}
				} 
			}elseif (substr($col, 0, -3) == '_id') {
				$tableJoin = substr($col, 0, strpos($col, '_id')-1);
				if(Schema::hasTable($tableJoin)) {
					$rows->leftjoin($tableJoin,$tableJoin.'.id','=',$table.'.'.$col);
					$tableJoinColumns = Schema::getColumnListing($tableJoin);
					foreach($tableJoinColumns as $jcol) {
						$rows->addselect(DB::raw('IFNULL('.$tableJoin.'.'.$jcol.',"") as '.$tableJoin.'_'.$jcol));
					}
				}
			}
		}

		if($condition) {
			$rows->whereRaw($condition);
		}		

        if($orderbyString) {
            $rows->orderByRaw($orderbyString);
        }
		return $rows->get();		
	}
}

function firstFull($table,$id,$condition=null) {
    $columns = Schema::getColumnListing($table);

    $rows = DB::table($table);
    if(Schema::hasColumn($table,'deleted_at')) {
        $rows->whereNull($table.'.deleted_at');
    }       

    $rows->addselect($table.'.*');

    foreach($columns as $col) {
        if(substr($col, 0, 3) == 'id_') {
            $tableJoin = substr($col, 3);
            if(Schema::hasTable($tableJoin)) {
                $rows->leftjoin($tableJoin,$tableJoin.'.id','=',$table.'.'.$col);
                $tableJoinColumns = Schema::getColumnListing($tableJoin);
                foreach($tableJoinColumns as $jcol) {
                    $rows->addselect(DB::raw('IFNULL('.$tableJoin.'.'.$jcol.',"") as '.$tableJoin.'_'.$jcol));
                }
            } 
        }elseif (substr($col, 0, -3) == '_id') {
            $tableJoin = substr($col, 0, strpos($col, '_id')-1);
            if(Schema::hasTable($tableJoin)) {
                $rows->leftjoin($tableJoin,$tableJoin.'.id','=',$table.'.'.$col);
                $tableJoinColumns = Schema::getColumnListing($tableJoin);
                foreach($tableJoinColumns as $jcol) {
                    $rows->addselect(DB::raw('IFNULL('.$tableJoin.'.'.$jcol.',"") as '.$tableJoin.'_'.$jcol));
                }
            }
        }
    }

    if(is_array($id)) {
        foreach($id as $k=>$v) {
            $rows->where($k,$v);
        }
    }else{
        $rows->where($table.'.id',$id);
    }

    if($condition) {
        $rows->whereRaw($condition);
    }

    return $rows->first();
}

/**
 * Get the first row
 *
 * @param string name
 * @return string
 */
if(!function_exists('first')) {
	function first($table,$id) {
		if(!is_array($id)) {
			return DB::table($table)->where('id',$id)->first();
		}elseif (is_array($id)) {
			$first = DB::table($table);
			foreach($id as $k=>$v) {
				$first->where($k,$v);
			}
			return $first->first();
		}
	}
}

/**
 * Validation 
 *
 * @param array $userInputs
 * @param string $type
 * @return void
 */
if(!function_exists('validation')) {
	function validation($userInputs=[],$type='view') {
	    $inputs = Request::all();
	    if($userInputs) {
	    	foreach($userInputs as $a=>$b) {
		        if(is_int($a)) {
		            $userInputs[$b] = 'required';
		        }else{
		            $userInputs[$a] = $b;
		        }
		    }
	    }else{
	    	foreach($inputs as $a=>$b) {
	    		$userInputs[$a] = "required";
	    	}
	    }
	    
	    $validator = Validator::make($inputs,$userInputs);
	    
	    if ($validator->fails()) 
	    {
	        $message = $validator->errors()->all(); 

	        if($type == 'json') {
	            $result = array();      
	            $result['api_status'] = 0;
	            $result['api_message'] = implode(', ',$message);
	            $res = response()->json($result,200);
	            $res->send();
	            exit;
	        }else{                        
	            $res = redirect()->back()            
	            ->with(['message'=>implode('<br/>',$message),'message_type'=>'warning'])
	            ->withInput();
	            \Session::driver()->save();
	            $res->send();
	            exit;
	        }        
	    }
	}
}

/**
 * Retrieve HTTP Get
 *
 * @param string name
 * @return string
 */
if(!function_exists('g')) {
	function g($name) {
		return Request::get($name);
	}
}

/**
 * Retrieve HTTP Post
 *
 * @param string name
 * @return string
 */
if(!function_exists('p')) {
	function p($name) {
		return Request::get($name);
	}
}

/**
 * Generate route each methods
 *
 * @return void
 */
function routeController($prefix,$controller,$namespace=NULL) {        

    $prefix = trim($prefix,'/').'/';

    $namespace = ($namespace)?:'App\Http\Controllers';

    try{
    	Route::get($prefix,['uses'=>$controller.'@getIndex','as'=>$controller.'GetIndex']);

        $controller_class = new \ReflectionClass($namespace.'\\'.$controller);                          
        $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
        $wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';         
        foreach($controller_methods as $method) {	      

            if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {                                             
                if(substr($method->name, 0, 3) == 'get') {
                    $method_name = substr($method->name, 3);
                    $slug = array_filter(preg_split('/(?=[A-Z])/',$method_name));   
                    $slug = strtolower(implode('-',$slug));
                    $slug = ($slug == 'index')?'':$slug;
                    Route::get($prefix.$slug.$wildcards,['uses'=>$controller.'@'.$method->name,'as'=>$controller.'Get'.$method_name] );
                }elseif(substr($method->name, 0, 4) == 'post') {
                    $method_name = substr($method->name, 4);
                    $slug = array_filter(preg_split('/(?=[A-Z])/',$method_name));                                   
                    Route::post($prefix.strtolower(implode('-',$slug)).$wildcards,['uses'=>$controller.'@'.$method->name,'as'=>$controller.'Post'.$method_name] );
                }
            }                   
        }
    }catch(\Exception $e) {

    }    
}

/**
 * Get Admin Session Id
 *
 * @return integer
 */
if(!function_exists('getUserId')) {
	function getUserId() { 
		return Session::get(config('app.adminSessionName'))?:false;
	}
} 

if(!function_exists('getUserNik')) {
    function getUserNik() { 
        return Session::get('admin_user_nik')?:false;
    }
}

function getUserSession() {
    return Session::get('admin_user');
}

if(!function_exists('getUserStatus')) {
    function getUserStatus() {
        $u = first('user',getUserId());
        return $u->status;
    }
}

function getRoleByIdUser($id_user) {
    $row = DB::table('user')
    ->join('role','role.id','=','id_role')
    ->where('user.id',$id_user)
    ->select('role.nama')
    ->first();
    return $row->nama;
}

if(!function_exists('getRole')) {
	function getRole() {
		return getUserSession()->role_nama;
	}
}

if(!function_exists('getRoleId')) {
	function getRoleId() {
		return getUser()->id_role;
	}
}


if(!function_exists('getUserDetail')) {
    function getUserDetail($condition=null) {
        $row = getDataFull('user',$condition);
        if($row) {
            return $row[0];
        }else{
            return false;
        }
    }
}

if(!function_exists('getUserIds')) {
	function getUserIds() {
		$rows = DB::table('user');
		$rows->whereNull('deleted_at');
		$rows->where('user.status','enable');
		return $rows->pluck('id')->toArray();
	}
}

/**
 * Get Admin Data
 * 
 * @return object
 * Penggunaan Session untuk meringankan query load time
 */
if(!function_exists('getUser')) {
    function getUser() {
        if(getUserId()) {
            return getUserSession(); //Session::get('admin_user');
        }else{
            return false;
        }
    }
}

/**
 * Get Setting
 *
 * @param string name 
 */
if(!function_exists('getSetting')) {
	function getSetting($name){	
		if(Cache::has('setting_'.$name)) {
			return Cache::get('setting_'.$name);
		}

	    $query = DB::table('setting')->where('nama',$name)->first();
	    if($query) {    	
		    Cache::forever('setting_'.$name,$query->nilai);
		    return $query->nilai;       
	    }else{
	    	return false;
	    }
	}
}


/**
 * Put Setting
 *
 * @param string name 
 */
if(!function_exists('putSetting')) {
	function putSetting($name,$value){	
	    $query = DB::table('setting')->where('nama',$name)->first();
	    if($query) {    	
	    	DB::table('setting')->where('id',$query->id)->update(['nilai'=>$value]);
		    Cache::forever('setting_'.$name,$value);
		    return true;     
	    }else{
	    	DB::table('setting')
	    	->insert([
	    		'created_at'=>now(),
	    		'nama'=>$name,
	    		'nilai'=>$value
	    		]);
	    	Cache::forever('setting_'.$name,$value);
	    	return true;
	    }
	}
}

function addToUrl($url, $key, $value = null) {
    $query = parse_url($url, PHP_URL_QUERY);
    if ($query) {
        parse_str($query, $queryParams);
        $queryParams[$key] = $value;
        $url = str_replace("?$query", '?' . http_build_query($queryParams), $url);
    } else {
        $url .= '?' . urlencode($key) . '=' . urlencode($value);
    }
    return $url;
}

function showFilterTeamButton($label=null,$dateFilter='',$disableTeam=[],$callback=null) {
    $label = ($label)?:"Filter Team";
    $data['dateFilter'] = $dateFilter;
    $data['label'] = $label;
    $data['disableTeam'] = $disableTeam;
    $data['callback'] = $callback;
    $html = "<a class='btn btn-primary' href='javascript:;' onclick='showFilterTeam()'><i class='fa fa-filter'></i> $label</a>";
    $html .= view('admin.filter_team_full',$data)->render();
    return $html;
}

function showFilterTeamBySM($id_sm,$label=null,$dateFilter='') {
    $label = ($label)?:"Filter Team";
    $data['dateFilter'] = $dateFilter;
    $data['label'] = $label;
    $data['id_sm'] = $id_sm;
    $html = "<a class='btn btn-primary' href='javascript:;' onclick='showFilterTeam()'><i class='fa fa-filter'></i> $label</a>";
    $html .= view('admin.filter_team_by_sm',$data)->render();
    return $html;
}

function showFilterTeamByAM($id_am,$label=null,$dateFilter='') {
    $label = ($label)?:"Filter Team";
    $data['dateFilter'] = $dateFilter;
    $data['label'] = $label;
    $data['id_am'] = $id_am;
    $html = "<a class='btn btn-primary' href='javascript:;' onclick='showFilterTeam()'><i class='fa fa-filter'></i> $label</a>";
    $html .= view('admin.filter_team_by_am',$data)->render();
    return $html;
}

function getListYear($data,$start=1,$end=2)
{
    #name   = Tag Name
    #awal   = Start Year
    #akhir  = End Year
    $property = $data;
            
    $awal   = date('Y')-$start;
    $akhir  = date('Y')+$end;
    if($property==''){
        $select = date('Y');
    }
    else{
        $select = $property;
    }   
    $i  = $awal;        
    for($i>=$awal;$i<=$akhir;$i++)
    {
        #cond Selection
        if($i==$select){
            $sta    = 'selected';
        }
        else{
            $sta    = '';
        }                   
        echo '<option value="'.$i.'" '.$sta.'>'.$i.'</option>';
    }
}

function getListMonth($post){
    $bulan = array("",
                           "Januari", 
                           "Februari", 
                           "Maret", 
                           "April", 
                           "Mei", 
                           "Juni", 
                           "Juli", 
                           "Agustus", 
                           "September", 
                           "Oktober", 
                           "November", 
                           "Desember");                                 
            
    if(empty($post)){
        $select = date('m');
    }
    else{
        $select = $post;
    }
    
    print_r("<option>** Pilih Bulan **</option>");
        
    for($y=1;$y<=12;$y++){
            if($y==$select){ 
                $pilih="selected";
            }
            else {
                $pilih="";
            }
            print_r("<option value=\"$y\" $pilih>".strtoupper($bulan[$y])."</option>"."\n");
    }
}

//time epoch to date human readable
function epochToDate($epoch,$format){
    /*
        @epoch = 1483228800;
        $format= Y,m,d,j,n,H,i,s
    */
    $dt     = new DateTime("@$epoch");
    $convert= $dt->format($format);
    return $convert;
}

//Y-m-d to epoch
function dateToEpoch($date){
    $dt   = new DateTime($date);
    $epoch= $dt->getTimestamp();
    return $epoch;
}

//Convert date('Y-m-d') to weekNumberPer Month
function dateToWeek($qDate){
    $dt = strtotime($qDate);
    $day  = date('j',$dt);
    $month = date('m',$dt);
    $year = date('Y',$dt);
    $totalDays = date('t',$dt);
    $weekCnt = 1;
    $retWeek = 0;
    for($i=1;$i<=$totalDays;$i++) {
        $curDay = date("N", mktime(0,0,0,$month,$i,$year));
        if($curDay==7) {
            if($i==$day) {
                $retWeek = $weekCnt+1;
            }
            $weekCnt++;
        } else {
            if($i==$day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek;
}

#Pembuatan Kode Otomatis 3 Digits
function add_zero($num){    
    switch (strlen($num))
    {   
        case 2 : $NoTrans = "000".$num; break;     
        case 1 : $NoTrans = "00".$num; break;
        default: $NoTrans = $num;   
    }      
    return $NoTrans;
}

#menghindari division by zero to percentil
function toPersen($total,$pembagi){	
    $hasil = empty($pembagi) ? 0 : round(($total)/($pembagi)*100,2);
	return $hasil;
}

//Panel boostrap start
function panel_start($title,$warna=''){
    $tipe = $warna?:'default';
    $panel = '<div class="panel panel-'.$tipe.'">
              <div class="panel-heading">'.$title.'</div>
              <div class="panel-body">';
    echo $panel;
}

//Panel boostrap end
function panel_end(){
    $panel = '</div>
              </div>';
    echo $panel;
}

//Provinsi
function Provinsi(){
    $prov = DB::table('provinsi AS aa')
        ->whereNull('aa.deleted_at')
        ->select('aa.*')
        ->orderby('aa.nama', 'ASC');
    return $prov->get();
}

//Mendapatkan jumlah hari dalam satu bulan
//modul php-calendar harus diaktifkan
function totalHari($month,$year){
    $jumlah = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    return $jumlah;
}

//Convert tanggal to year
function dateConvert($date,$format){
    //Casting created_at
    $date = new DateTime($date);
    $waktu = $date->Format($format);
    return $waktu;
}

//after upgarde from 5.4 to 6.0
//str_limit has remove
if(!function_exists('str_limit')){
    function str_limit($text, $limit){
        return Str::limit($text, $limit);
    }
}

//after upgarde from 5.4 to 6.0
//str_random has remove
if(!function_exists('str_random')){
    function str_random($limit){
        return Str::random($limit);
    }
}