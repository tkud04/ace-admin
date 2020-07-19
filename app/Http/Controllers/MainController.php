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
        #dd($ordersCollection);
		 $products = $this->helpers->getProducts();
		 $productsCollection = collect($products);
		 $lowStockProducts = $productsCollection->where('qty','<',"10");
		#dd($lowStockProducts);
    	return view('index',compact(['user','stats','profits','orders','ordersCollection','products','lowStockProducts','signals']));
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
			  //dd($product);
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
			//dd($order);
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
       $req = $request->all();
		  # dd($req); 
		  $ret = ['status' => "ok","message"=>"nothing happened"];
        $validator = Validator::make($req, [
                             'dt' => 'required',
                             
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
            $ret = ['status' => "error",'message' => "validation error"];
         }
         
         else
         {
					
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


}