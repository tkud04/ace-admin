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
        
    	return view('index',compact(['user','signals']));
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
		$c = $this->helpers->categories;
		#dd($cg);
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
              $product = $this->helpers->getProduct($req['id']);
			  $categories = $this->helpers->getCategories();
			  $signals = $this->helpers->signals;
			  $xf = $req['id'];
			  //dd($product);
		      return view('edit-product',compact(['user','product','categories','xf','signals']));
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
		#dd($req);
        $validator = Validator::make($req, [
                             'xf' => 'required',                            
                             'description' => 'required',                            
                             'amount' => 'required|numeric',
                             'category' => 'required',
                             'status' => 'required|not_in:none',
                             'in_stock' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
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


}