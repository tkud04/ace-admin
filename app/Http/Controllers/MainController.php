<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		//$accounts = $this->helpers->getUsers();
		$accounts = [];
		$stats = $this->helpers->getDashboardStats();
		$profits = $this->helpers->getProfits();
		$orders = $this->helpers->getOrders();
		$ordersCollection = collect($orders);
		$ccarts = $this->helpers->getCarts();
        #dd($ordersCollection);
		 $products = $this->helpers->getProducts();
		 $productsCollection = collect($products);
		 $lowStockProducts = $productsCollection->where('qty','<',"10");
		#dd($lowStockProducts);
		
		//Analytics
		$mostVisitedPages = $this->helpers->getAnalytics(['type' => "most-visited-pages",'period' => "days",'num' => 7]);
		
    	return view('index',compact(['user','stats','profits','orders','ordersCollection','products','lowStockProducts','mostVisitedPages','ccarts','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSettings()
    {
       $user = null;

		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$banks = $this->helpers->banks;
		//$accounts = $this->helpers->getUsers();
		$accounts = [];
		$smtp = $this->helpers->getSetting('smtp');
		$d1 = $this->helpers->getSetting('delivery1');
		$d2 = $this->helpers->getSetting('delivery2');
		$nud = $this->helpers->getSetting('nud');
		$plugins = $this->helpers->getPlugins();
		$bank = $this->helpers->getCurrentBank();
		
		
		$sender = $this->helpers->getSender($smtp['value']);
		$senders = $this->helpers->getSenders();
		$settings = [
		   'smtp' => $smtp,
		   'd1' => $d1,
		   'd2' => $d2,
		   'bank' => $bank,
		   'nud' => $nud
		   
        ];
		#dd($settings);
    	return view('settings',compact(['user','settings','senders','sender','plugins','banks','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddSetting(Request $request)
    {
       $user = null;
       $req = $request->all();
       $ret = ['status' => "ok",'data' => "nothing happened"];
		
		if(Auth::check())
		{
			$user = Auth::user();
			if($this->helpers->isAdmin($user))
			{
				
			
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'k' => 'required',
                             'v' => 'required',
            ]);
         
            if($validator->fails())
            {
               $ret = ['status' => "error",'message' => "validation"];
            }
         
            else
            {
              $s = $this->helpers->createSetting($req);
              $ret = ['status' => "ok",'data' => "settings updated"];
            }
          }
		}
		
        return json_encode($ret);	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSettingsDelivery(Request $request)
    {	
       $req = $request->all();
		  # dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$dt = json_decode($req['dt']);
			$dtt = [];
			foreach($dt as $key => $value)
			{
              $this->helpers->updateSetting($key,$value);
              $dtt[$key] = number_format($value,2);			  
			}
			
			return json_encode(['status' => "ok",'data' => $dtt]);
         }       
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSettingsBank(Request $request)
    {	
	  $ret = ['status' => 'ok','message' => "nothing happened"];
       $req = $request->all();
		  # dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
			 $ret = ['status' => "error"];
         }
         
         else
         {
			$dt = json_decode($req['dt']);
			$this->helpers->updateBank($dt);			
			
			$ret = ['status' => "ok"];
         }
 
        return json_encode($ret); 
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSettingsDiscount(Request $request)
    {	
       $req = $request->all();
		  # dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$dt = json_decode($req['dt']);
			if($dt != null)
			{
              $this->helpers->updateSetting($dt->type,$dt->value);			
			}
			
			return json_encode(['status' => "ok",'data' => number_format($dt->value,2)]);
         }       
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddSender(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		 $signals = $this->helpers->signals;
		 
		return view('add-sender',compact(['user','signals']));	
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddSender(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             'server' => 'required|not_in:none',
                             'name' => 'required',
                             'username' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$dt = ['type' => $req['server'],'sn' => $req['name'],'su' => $req['username'],'spp' => $req['password']];
         
			 if($req['server'] == "other")
			 {
				$v = isset($req['ss']) && isset($req['sp']) && isset($req['sec']) && $req['sec'] != "nonee";
				if($v)
				{
					$dt['ss'] = $req['ss'];
					$dt['sp'] = $req['sp'];
					$dt['sec'] = $req['sec'];
				}
				else
				{
					session()->flash("no-validation-status", "success"); 
					return redirect()->back()->withInput();
				}
			 }
			else
            {
            	$smtp = $this->helpers->smtpp[$req['server']];
                $dt['ss'] = $smtp['ss'];
					$dt['sp'] = $smtp['sp'];
					$dt['sec'] = $smtp['sec'];
            }
            
            $dt['se'] = $dt['su'];
            $dt['sa'] = "yes";
            $dt['current'] = "no";
            $this->helpers->createSender($dt);
			session()->flash("add-sender-status", "success");
			return redirect()->intended('settings');
         } 	  
    }
    
         /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSenders(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$senders = $this->helpers->getSenders();
		
		$signals = $this->helpers->signals;
		//dd($drivers);
    	return view('senders',compact(['user','senders','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSender(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             's' => 'required'
         ]);
         
         if($validator->fails())
         {
         	return redirect()->intended('senders');
         }
         else
		 {
			$signals = $this->helpers->signals;
			$s = $this->helpers->getSender($req['s']);
		    return view('sender',compact(['user','s','signals']));	
         } 
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSender(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		dd($req);
        $validator = Validator::make($req, [                          
                             'server' => 'required|not_in:none',
                             'name' => 'required',
                             'username' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$dt = ['sn' => $req['name'],'su' => $req['username'],'spp' => $req['password']];
         
			 if($req['server'] == "other")
			 {
				$v = isset($req['ss']) && isset($req['sp']) && isset($req['sec']) && $req['sec'] != "nonee";
				if($v)
				{
					$dt['ss'] = $req['ss'];
					$dt['sp'] = $req['sp'];
					$dt['sec'] = $req['sec'];
				}
				else
				{
					session()->flash("no-validation-status", "success"); 
					return redirect()->back()->withInput();
				}
			 }
			else
            {
            	$smtp = $this->helpers->smtpp[$req['server']];
                $dt['ss'] = $smtp['ss'];
					$dt['sp'] = $smtp['sp'];
					$dt['sec'] = $smtp['sec'];
            }
            
            $dt['se'] = $dt['su'];
            $dt['sa'] = "yes";
            $this->helpers->createSender($dt);
			session()->flash("add-sender-status", "success");
			return redirect()->intended('settings');
         } 	  
    }
	
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getRemoveSender(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             's' => 'required'
         ]);
         
         if($validator->fails())
         {
         	return redirect()->intended('senders');
         }
         else
		 {
			$this->helpers->removeSender($req['s']);
		    session()->flash("remove-sender-status", "success");
			return redirect()->intended('senders');
         } 
		
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMarkSender(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             's' => 'required'
         ]);
         
         if($validator->fails())
         {
         	return redirect()->intended('senders');
         }
         else
		 {
			$this->helpers->setAsCurrentSender($req['s']);
		    session()->flash("mark-sender-status", "success");
			return redirect()->intended('senders');
         } 
		
    }
	
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddPlugin(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		 $signals = $this->helpers->signals;
		 
		return view('add-plugin',compact(['user','signals']));	
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddPlugin(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             'status' => 'required|not_in:none',
                             'name' => 'required',
                             'value' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	
            $this->helpers->createPlugin($req);
			session()->flash("add-plugin-status", "success");
			return redirect()->intended('plugins');
         } 	  
    }
    
         /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPlugins(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$plugins = $this->helpers->getPlugins();
		
		$signals = $this->helpers->signals;
		//dd($drivers);
    	return view('plugins',compact(['user','plugins','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPlugin(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             's' => 'required'
         ]);
         
         if($validator->fails())
         {
         	return redirect()->intended('senders');
         }
         else
		 {
			$signals = $this->helpers->signals;
			$p = $this->helpers->getPlugin($req['s']);
		    return view('plugin',compact(['user','p','signals']));	
         } 
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postPlugin(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
        $validator = Validator::make($req, [                          
                             'status' => 'required|not_in:none',
                             'xf' => 'required|numeric',
                             'name' => 'required',
                             'value' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updatePlugin($req);
			session()->flash("update-plugin-status", "success");
			return redirect()->intended('plugins');
         } 	  
    }
	
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getRemovePlugin(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             's' => 'required'
         ]);
         
         if($validator->fails())
         {
         	return redirect()->intended('senders');
         }
         else
		 {
			$this->helpers->removePlugin($req['s']);
		    session()->flash("remove-plugin-status", "success");
			return redirect()->intended('plugins');
         } 
		
    }
	
	
	

     /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProducts(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$products = $this->helpers->getProducts();
		
		$signals = $this->helpers->signals;
		//dd($drivers);
    	return view('products',compact(['user','products','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getProduct(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $product = $this->helpers->getProduct($req['id']);
			  $signals = $this->helpers->signals;
		      return view('product',compact(['user','product','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddProduct(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$c = $this->helpers->getCategories();
		#dd($c);
    	return view('add-product',compact(['user','signals','c']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddProduct(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'category' => 'required|not_in:none',
                             'description' => 'required',                        
                             'in_stock' => 'required|not_in:none',                        
                             'amount' => 'required|numeric',
                             'qty' => 'required|numeric',
                             'img' => 'array|min:1',
                             'img.*' => 'file'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            //upload product images 
             $img = $request->file('img');
                 //dd($img);
                 $ird = [];
             for($i = 0; $i < count($img); $i++)
             {           
             	$ret = $this->helpers->uploadCloudImage($img[$i]->getRealPath());
			     #dd($ret);
			    array_push($ird, $ret['public_id']);
             }         
             $req['ird'] = $ird;
             $req['user_id'] = $user->id;
             $req['name'] = "";
			
             $product = $this->helpers->createProduct($req);
			session()->flash("create-product-status", "success");
			return redirect()->intended('products');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditProduct(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $product = $this->helpers->getProduct($req['id'],true);
              $discounts = $this->helpers->getDiscounts($req['id']);
			  $categories = $this->helpers->getCategories();
			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
			  #dd($product);
		      return view('edit-product',compact(['user','product','discounts','categories','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditProduct(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		//dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required',                            
                             'description' => 'required',                            
                             'amount' => 'required|numeric',
							 'qty' => 'required|numeric',
                             'category' => 'required',
                             'status' => 'required|not_in:none',
                             'in_stock' => 'required|not_in:none',
                             'add_discount' => 'required',
                             'img' => 'array',
                             'img.*' => 'file'							 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $img = $request->file('img');
			 //dd($img);
			 $ird = [];
			 if(!is_null($img) && count($img) > 0)
			 {
				 //upload product images if present  
             for($i = 0; $i < count($img); $i++)
             {
				/**
				$imgResource = imagecreatefromjpeg($img[$i]->path());
				 $resizedImg = imagescale($imgResource, 200, 200);    
                	
               **/
              $resizedImg = $this->helpers->resizeImage($img[$i],[650,650]);
             	$ret = $this->helpers->uploadCloudImage($resizedImg);
			     #dd($ret);
			    array_push($ird, $ret['public_id']);
             } 
			 }
			 $req['ird'] = $ird;
            $this->helpers->updateProduct($req);
			session()->flash("update-product-status", "success");
			return redirect()->back();
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDisableProduct(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $this->helpers->disableProduct($req['id'],true);
              session()->flash("update-product-status", "success");
			return redirect()->back();
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteProduct(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $this->helpers->deleteProduct($req['id'],true);
              session()->flash("delete-product-status", "success");
			return redirect()->back();
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	  /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUsers(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$users = $this->helpers->getUsers();
		
		$signals = $this->helpers->signals;
		#dd($users);
    	return view('users',compact(['user','users','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUser(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $u = $this->helpers->getUser($req['id']);

			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
			  //dd($product);
		      return view('user',compact(['user','u','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getManageUserStatus(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('products');
            }
         
            else
            {
              $ret = $this->helpers->manageUserStatus($req);

			  session()->flash("update-user-status", "success");
			return redirect()->intended('users');
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCategories(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
		//dd($drivers);
    	return view('categories',compact(['user','categories','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddCategory(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$c = $this->helpers->categories;
		#dd($cg);
    	return view('add-category',compact(['user','signals','c']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddCategory(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'category' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $req['user_id'] = $user->id;
             $this->helpers->createCategory($req);
			session()->flash("create-category-status", "success");
			return redirect()->intended('categories');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditCategory(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('categories');
            }
         
            else
            {
              $category = $this->helpers->getCategory($req['id']);
			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
		      return view('edit-category',compact(['user','category','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditCategory(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required',                            
                             'category' => 'required',                            
                             'status' => 'required|not_in:none',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updateCategory($req);
			session()->flash("edit-category-status", "success");
			return redirect()->intended('categories');
         } 	  
    }

    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAds(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$ads = $this->helpers->getAds();
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('ads',compact(['user','categories','ads','signals']));
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddAd(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$c = $this->helpers->categories;
		#dd($cg);
    	return view('add-ad',compact(['user','signals','c']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddAd(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'type' => 'required',
                             'status' => 'required|not_in:none',
                             'img' => 'required|file',
							 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //upload product images 
             $img = $request->file('img');
              $ret = $this->helpers->uploadCloudImage($img->getRealPath());
			  $req['img'] = $ret['public_id'];
			 
             $this->helpers->createAd($req);
			session()->flash("create-ad-status", "success");
			return redirect()->intended('ads');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditAd(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('categories');
            }
         
            else
            {
              $ad = $this->helpers->getAd($req['id']);
			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
		      return view('edit-ad',compact(['user','ad','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditAd(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             'xf' => 'required',                            
                             'type' => 'required|not_in:none',                            
                             'status' => 'required|not_in:none',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updateAd($req);
			session()->flash("edit-ad-status", "success");
			return redirect()->intended('ads');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBanners(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$banners = $this->helpers->getBanners();
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('banners',compact(['user','categories','banners','signals']));
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddBanner(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$c = $this->helpers->categories;
		#dd($cg);
    	return view('add-banner',compact(['user','signals','c']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddBanner(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'subtitle' => 'required',
                             'title' => 'required',
                             'status' => 'required|not_in:none',
                             'img' => 'required|file',
							 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //upload product images 
             $img = $request->file('img');
              $ret = $this->helpers->uploadCloudImage($img->getRealPath());
			  $req['img'] = $ret['public_id'];
			 
             $this->helpers->createBanner($req);
			session()->flash("create-banner-status", "success");
			return redirect()->intended('banners');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditBanner(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('categories');
            }
         
            else
            {
              $b = $this->helpers->getBanner($req['id']);
			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
		      return view('edit-banner',compact(['user','b','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditBanner(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                            'subtitle' => 'required',
                             'title' => 'required',
                             'status' => 'required|not_in:none',
                             'img' => 'file',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 if(!isset($req['copy'])) $req['copy'] = "";
            $this->helpers->updateBanner($req);
			session()->flash("edit-banner-status", "success");
			return redirect()->intended('banners');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getSetCoverImage(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required' 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //delete product images 
              $ret = $this->helpers->setCoverImage($req['xf']);
			session()->flash("set-cover-image-status", "success");
			return redirect()->back();
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteImage(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required' 
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //delete product images 
              $ret = $this->helpers->deleteBanner($req['xf']);
			session()->flash("delete-image-status", "success");
			return redirect()->back();
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getReviews(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$reviews = $this->helpers->getReviews();
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('reviews',compact(['user','categories','reviews','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditReview(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'id' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('reviews');
            }
         
            else
            {
              $r = $this->helpers->getReview($req['id']);
			  $signals = $this->helpers->signals;
			  $xf = $r['id'];
			  #dd($r);
		      return view('edit-review',compact(['user','r','xf','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditReview(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                            'name' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updateReview($req);
			session()->flash("edit-review-status", "success");
			return redirect()->back();
         } 	  
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUserCarts(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$carts = $this->helpers->getCarts();
		$ccarts = [];
	    
        if(count($carts) > 0)
        {
		    foreach($carts as $c)
		    {
			  $uid = $c['user_id'];
			  
			  if(isset($ccarts[$uid]))
              {
              	array_push($ccarts[$uid]['data'],$c);
              }
              else
              {
              	$u = $this->helpers->getUser($uid);
              	$ccarts[$uid] = [ 'user' => $u, 'data' => [$c] ];
              }
           }
        }
		#dd($ccarts);
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('carts',compact(['user','categories','ccarts','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOrders(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$orders = $this->helpers->getOrders();
		#dd($orders);
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('orders',compact(['user','categories','orders','signals']));
    }
	
	public function getDeliveryFee(Request $request)
	{
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             's' => 'required'
         ]);
		 
         if($validator->fails())
         {
             return json_encode(['status' => "error", 'message' => "validation"]);
         }
         
         else
         {
			 $total = 0; $tt = 0;
             $ret = $this->helpers->getDeliveryFee($req['s'],"state");
			
			if(isset($req['st']) && is_numeric($req['st']))
			{
				$tt = $ret + $req['st'];
				$total = number_format($tt,2);
			}
           return json_encode(['status' => "ok", 'message' => [$ret,number_format($ret,2)],'total' => [$tt,$total]]);
         } 
         
		
	}
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddOrder()
    {
       	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		$c = $this->helpers->getCategories();
		$products = $this->helpers->getProducts();
		$users = $this->helpers->getUsers(true);
		$signals = $this->helpers->signals;
		$states = $this->helpers->states;
		#dd($users);
       return view('bao',compact(['user','c','products','users','states','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getTestAddOrder(Request $request)
    {	
	  $user = null;
	  
	  if(Auth::check())
	  {
		  $user = Auth::user();
	  }
       $req = $request->all();
	   
		 #dd($req);
		  $ret = ['status' => "ok","message"=>"nothing happened"];
           $dt = <<<EOD
{id: 0,data:{items: [{"ctr":0,"sku":"ACE6870LX226","qty":"5"},{"ctr":"1","sku":"ACE281LX516","qty":"4"}],notes: "test notes",user: {"id":"anon","name":"Tobi Hay","email":"aquarius4tkud@yahoo.com","phone":"08079284917","address":"6 alfred rewane rd","city":"lokoja","state":"kogi"}}}
EOD;
			$dtt = json_decode($dt);
			dd($dtt);
			
			//foreach($dt as $dtt)
			//{
				#dd($dtt);
				$id = substr($dtt->id,1);
				$o = $dtt->data;
				
                 $order = $this->helpers->bulkAddOrder($o);
                 $ret = ['status' => "ok","message"=>"order added"];
					 
			//}
			
			//session()->flash("bulk-upload-products-status", "success");
			//return redirect()->back();
		 return json_encode($ret);
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddOrder(Request $request)
    {	
	  $user = null;
	  
	  if(Auth::check())
	  {
		  $user = Auth::user();
	  }
       $req = $request->all();
	   
		 #dd($req);
		  $ret = ['status' => "ok","message"=>"nothing happened"];
        $validator = Validator::make($req, [
                             'dt' => 'required',
                             
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
          //return redirect()->withInput()->with("errors",$messages);
		  $ret = ['status' => "error","message"=>"validation"];
         }
         
         else
         {
			$dtt = json_decode($req['dt']);
			/**	
			 {
				 id: 0,
				 data: 
				 {
					items: "[{"ctr":0,"sku":"ACE6870LX226","qty":"5"},{"ctr":"1","sku":"ACE281LX516","qty":"4"}]",
                    notes: "test notes",
                    user: "{"id":"anon","name":"Tobi Hay","email":"aquarius4tkud@yahoo.com","phone":"08079284917","address":"6 alfred rewane rd","city":"lokoja","state":"kogi"}" 
				 }
			 }
			**/
			//dd([$req['dt'],$dtt]);
			/**
			array:2 [▼
  0 => "{"id":0,"data":{"notes":"test","user":"{\"id\":\"16\",\"name\":\"Tobi Lay\",\"email\":\"testing2@yahoo.com\",\"state\":\"Lagos\"}","items":"[{\"ctr\":0,\"sku\": ▶"
  1 => {#1233 ▼
    +"id": 0
    +"data": {#1235 ▼
      +"notes": "test"
      +"user": "{"id":"16","name":"Tobi Lay","email":"testing2@yahoo.com","state":"Lagos"}"
      +"items": "[{"ctr":0,"sku":"ACE2072LX87","qty":"1"}]"
    }
  }
]
			**/
			//foreach($dt as $dtt)
			//{
				#dd($dtt);
				$id = $dtt->id;
				$o = $dtt->data;

                 $order = $this->helpers->bulkAddOrder($o);
                 $ret = ['status' => "ok","message"=>"order added"];
					 
			//}
			
			//session()->flash("bulk-upload-products-status", "success");
			//return redirect()->back();
         } 
		 return json_encode($ret);
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditOrder(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'r' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('orders');
            }
         
            else
            {
				#dd($req);
              $o = $this->helpers->getOrder($req['r']);
			  $signals = $this->helpers->signals;
			  if(count($o) > 0)
			  {
				  $xf = $o['id'];
			     #dd($order);
		         return view('edit-order',compact(['user','o','xf','signals']));
			  }
			  else
			  {
				  return redirect()->intended('orders');
			  }
			  
            }
		}
		else
		{
			return redirect()->intended('login');
		}	
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditOrder(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                            'xf' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updateOrder($req);
			session()->flash("edit-order-status", "success");
			return redirect()->back();
         } 	  
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteOrder(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'o' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
           $this->helpers->deleteOrder($req['o']);
			session()->flash("delete-order-status", "success");
			return redirect()->back();
         } 	  
    }
    
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTrackings(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$req = $request->all();
		$trackings = $this->helpers->getTrackings($req['o']);
		$r = $req['o'];
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($ads);
		
    	return view('trackings',compact(['user','categories','r','trackings','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddTracking(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$req = $request->all();
		if(isset($req['r']))
		{
		  $r = $req['r'];
		  $categories = $this->helpers->getCategories();
		
		  $signals = $this->helpers->signals;
	      #dd($ads);
		
    	  return view('add-tracking',compact(['user','categories','r','signals']));	
		}
		else
		{
			 return redirect()->intended('orders');
		}
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddTracking(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             'reference' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $req['user_id'] = $user->id;
            $this->helpers->createTracking($req);
			session()->flash("create-tracking-status", "success");
			return redirect()->intended('orders');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddDiscount(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$categories = $this->helpers->getCategories();
		$products = $this->helpers->getProducts();
		 $signals = $this->helpers->signals;
		 
		return view('add-discount',compact(['user','products','categories','signals']));	
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddDiscount(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [                          
                             'discount_type' => 'required|not_in:none',
                             'discount' => 'required',
                             'type' => 'required|not_in:none',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 if($req['type'] == "single")
			 {
				if(isset($req['sku']) && $req['sku'] != "none")
				{
					
				}
				else
				{
					session()->flash("no-sku-status", "success"); 
					return redirect()->back();
				}
			 }
            $this->helpers->createDiscount($req);
			session()->flash("create-discount-status", "success");
			return redirect()->intended('discounts');
         } 	  
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDiscounts(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
		{
			return redirect()->intended('login');
		}
		
		
		$req = $request->all();
		$discounts = $this->helpers->getDiscounts();
		$categories = $this->helpers->getCategories();
		
		$signals = $this->helpers->signals;
	    #dd($discounts);
		
    	return view('discounts',compact(['user','categories','discounts','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEditDiscount(Request $request)
    {
       $user = null;
       $req = $request->all();
       
		
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
			$req = $request->all();
			
            $validator = Validator::make($req, [                            
                             'd' => 'required',
            ]);
         
            if($validator->fails())
            {
               return redirect()->intended('orders');
            }
         
            else
            {
				#dd($req);
              $discount = $this->helpers->getDiscount($req['d']);
			  $signals = $this->helpers->signals;
			  $xf = $discount['id'];
			  $products = $this->helpers->getProducts();
			  #dd($discount);
		      return view('edit-discount',compact(['user','discount','xf','products','signals']));
            }
		}
		else
		{
			return redirect()->intended('login');
		}
		
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postEditDiscount(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [       
                              'xf' => 'required',		
                             'discount_type' => 'required|not_in:none',
                             'discount' => 'required',
                             'type' => 'required|not_in:none',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 if($req['type'] == "single")
			 {
				if(isset($req['sku']) && $req['sku'] != "none")
				{
					
				}
				else
				{
					session()->flash("no-sku-status", "success"); 
					return redirect()->back();
				}
			 }
			 else
			 {
				 $req['sku'] = "";
			 }
            $this->helpers->updateDiscount($req);
			session()->flash("update-discount-status", "success");
			return redirect()->intended('discounts');
         } 	  
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteDiscount(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			} 
		}
		else
        {
        	return redirect()->intended('login');
        }
        
        $req = $request->all();
		#dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
           $this->helpers->deleteDiscount($req['xf']);
			session()->flash("delete-discount-status", "success");
			return redirect()->back();
         } 	  
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getConfirmPayment(Request $request)
    {	
       $req = $request->all();
		    
        $validator = Validator::make($req, [
                             'o' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->intended('orders');
             //dd($messages);
         }
         
         else
         {
			$order = $this->helpers->getOrder($req['o']);
			#dd($order);
			if(count($order) > 0 && $order['status'] == "unpaid" && $order['type'] == "bank")
			{
				$this->helpers->confirmPayment($req['o']);
				return view("confirm-payment",compact(['order']));
			}
			else
			{
				
             return redirect()->intended('orders');
			}
					
         }       
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBulkUpdateTracking(Request $request)
    {	
       $req = $request->all();
		   #dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required',
                             'action' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$this->helpers->bulkUpdateTracking($req);
			session()->flash("bulk-update-tracking-status", "success");
			return redirect()->back();
					
         }       
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBulkConfirmPayment(Request $request)
    {	
       $req = $request->all();
		   #dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required',
                             'action' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$this->helpers->bulkConfirmPayment($req);
			session()->flash("bulk-confirm-payment-status", "success");
			return redirect()->back();
					
         }       
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBulkUpdateProducts(Request $request)
    {	
       $req = $request->all();
		  # dd($req); 
        $validator = Validator::make($req, [
                             'dt' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			$this->helpers->bulkUpdateProducts($req);
			session()->flash("bulk-update-products-status", "success");
			return redirect()->back();
					
         }       
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBulkUploadProducts(Request $request)
    {	
	  $user = null;
	  
	  if(Auth::check())
	  {
		  $user = Auth::user();
	  }
       $req = $request->all();
	   
		 #dd($req);
		  $ret = ['status' => "ok","message"=>"nothing happened"];
        $validator = Validator::make($req, [
                             'dt' => 'required',
                             
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
          //return redirect()->withInput()->with("errors",$messages);
		  $ret = ['status' => "error","message"=>"validation"];
         }
         
         else
         {
			$dtt = json_decode($req['dt']);
			#dd($dt);
			
			//foreach($dt as $dtt)
			//{
				#dd($dtt);
				$id = substr($dtt->id,1);
				$p = $dtt->data;
				
				$rr = [
				  'category' => $p->category,
                             'description' => $p->desc,                        
                             'in_stock' => $p->status,                        
                             'amount' => $p->price,
                             'qty' => $p->stock,
				];
				
				$coverImg = isset($req[$id."-cover"]) ? $req[$id."-cover"] : null;
				$img = isset($req[$id.'-images']) ? $request->file($id.'-images') : null;
                $ird = [];
				
				 if(!is_null($img))
				 {
                    for($i = 0; $i < count($img); $i++)
                    {           
             	      $imgg = $this->helpers->uploadCloudImage($img[$i]->getRealPath());
			          #dd($ret);
					 // $imgg = ['public_id' => "default"];
					  $ci = ($coverImg != null && $coverImg == $i) ? "yes": "no";
					  $temp = ['public_id' => $imgg['public_id'],'ci' => $ci];
			          array_push($ird, $temp);
                    } 
					
				 }
				 
				 $rr['ird'] = $ird;
                 $rr['user_id'] = $user->id;
                 $rr['name'] = "";
			
                 $product = $this->helpers->createProduct($rr);
                 $ret = ['status' => "ok","message"=>"product uploaded"];
					 
			//}
			
			//session()->flash("bulk-upload-products-status", "success");
			//return redirect()->back();
         } 
		 return json_encode($ret);
    }
    
    
    /****************
    BUlk ACtions
    ****************/
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBulkUpdateTracking()
    {     
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$os = $this->helpers->getOrders();
		$ordersCollection = collect($os);
		$orders = $ordersCollection->where('status',"paid");
       return view('but',compact(['user','orders','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBulkConfirmPayment()
    {
		if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$os = $this->helpers->getOrders();
		$ordersCollection = collect($os);
		$orders = $ordersCollection->where('status',"unpaid");
       return view('bcp',compact(['user','orders','signals']));
    }
    
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBulkUpdateProducts()
    {
       	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		
		$signals = $this->helpers->signals;
		$ps = $this->helpers->getProducts();
		 $products = collect($ps);
       return view('bup',compact(['user','products','signals']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBulkUploadProducts()
    {
       	if(Auth::check())
		{
			$user = Auth::user();
			if(!$this->helpers->isAdmin($user))
			{
				Auth::logout();
				 return redirect()->intended('/');
			}  
		}
		else
		{
			return redirect()->intended('login');
		}
		$c = $this->helpers->getCategories();
		$signals = $this->helpers->signals;
       return view('buup',compact(['user','c','signals']));
    }
    
    
   
	
	
	
	
	
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "1535561942737";
    	return $ret;
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
		$url = "http://www.kloudtransact.com/cobra-deals";
	    $msg = "<h2 style='color: green;'>A new deal has been uploaded!</h2><p>Name: <b>My deal</b></p><br><p>Uploaded by: <b>A Store owner</b></p><br><p>Visit $url for more details.</><br><br><small>KloudTransact Admin</small>";
		$dt = [
		   'sn' => "Tee",
		   'em' => "kudayisitobi@gmail.com",
		   'sa' => "KloudTransact",
		   'subject' => "A new deal was just uploaded. (read this)",
		   'message' => $msg,
		];
    	return $this->helpers->bomb($dt);
    }   
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAnalytics(Request $request)
    {
    	$user = null;
	  
	  if(Auth::check())
	  {
		  $user = Auth::user();
	  }
       $req = $request->all();
       
	   $req['type'] = "most-visited-pages";
	   $req['period'] = "days";
	   $req['num'] = 7;
		$results = $this->helpers->getAnalytics($req);
		dd($results);
    	#return $this->helpers->bomb($dt);
    }  

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAnalytics(Request $request)
    {
    	$req = $request->all();
		 $ret = ['status' => "error", 'message' => "nothing happened"];
		 
        $validator = Validator::make($req, [
                             'dt' => 'required'
         ]);
         
         if($validator->fails())
         {
            $ret = ['status' => "error",'message'=>"validation"];
         }
         
         else
         {
			$dt = $this->helpers->fetchAnalytics($req['dt']);
			$ret = ['status' => "ok","data"=>json_encode($dt)];				
         } 

        return $ret;		 
    }   


}