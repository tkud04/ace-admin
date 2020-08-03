<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use App\User;
use App\ShippingDetails;
use App\Products;
use App\ProductData;
use App\ProductImages;
use App\Categories;
use App\Discounts;
use App\Reviews;
use App\Banners;
use App\Trackings;
use App\AnonOrders;
use App\Orders;
use App\OrderItems;
use App\Ads;
use \Cloudinary\Api;
use \Cloudinary\Api\Response;
use GuzzleHttp\Client;
use Image;

class Helper implements HelperContract
{    

            public $emailConfig = [
                           'ss' => 'smtp.gmail.com',
                           'se' => 'uwantbrendacolson@gmail.com',
                           'sp' => '587',
                           'su' => 'uwantbrendacolson@gmail.com',
                           'spp' => 'kudayisi',
                           'sa' => 'yes',
                           'sec' => 'tls'
                       ];    

			public $deliveryStatuses = [
                           'pickup' => 'Your order has been processed and is scheduled for pickup.',
                           'transit' => 'The package has left the pickup point and is on its way to the delivery address.',
                           'delivered' => 'The package has been delivered to the receiver.',
                           'return' => 'The delivery address was not correct and the package has been returned.',
                           'receiver_not_present' => 'The receiver was not present at the delivery address and the package has been returned.'
                       ];     
                        
             public $signals = ['okays'=> ["login-status" => "Sign in successful",            
                     "signup-status" => "Account created successfully! You can now login to complete your profile.",
                     "create-product-status" => "Product added!",
                     "create-category-status" => "Category added!",
                     "update-product-status" => "Product updated!",
                     "edit-category-status" => "Category updated!",
                     "update-status" => "Account updated!",
                     "update-user-status" => "User account updated!",
                     "config-status" => "Config added/updated!",
                     "create-ad-status" => "Ad added!",
                     "edi-ad-status" => "Ad updated!",
					 "create-banner-status" => "Banner added!",
                     "edit-banner-status" => "Banner updated!",
                     "edit-review-status" => "Review info updated!",
                     "edit-order-status" => "Order info updated!",
                     "contact-status" => "Message sent! Our customer service representatives will get back to you shortly.",
                     "create-tracking-status" => "Tracking info updated.",
                     "update-discount-status" => "Discount updated.",
                     "create-discount-status" => "Discount created.",
                     "delete-discount-status" => "Discount deleted.",
                     "no-sku-status" => "Please select a product for single discount.",
                     "set-cover-image-status" => "Product image updated",
                     "delete-image-status" => "Image deleted",
                     "delete-order-status" => "Order deleted",
                     "bulk-update-tracking-status" => "Trackings updated",
                     "bulk-confirm-payment-status" => "Payments confirmed",
                     "bulk-upload-products-status" => "Products uploaded"
                     ],
                     'errors'=> ["login-status-error" => "There was a problem signing in, please contact support.",
					 "signup-status-error" => "There was a problem signing in, please contact support.",
					 "update-status-error" => "There was a problem updating the account, please contact support.",
					 "update-user-status-error" => "There was a problem updating the user account, please contact support.",
					 "contact-status-error" => "There was a problem sending your message, please contact support.",
					 "create-product-status-error" => "There was a problem adding the product, please try again.",
					 "create-category-status-error" => "There was a problem adding the category, please try again.",
					 "update-product-status-error" => "There was a problem updating product info, please try again.",
					 "edit-category-status-error" => "There was a problem updating category, please try again.",
					 "create-ad-status-error" => "There was a problem adding new ad, please try again.",
					 "edit-ad-status-error" => "There was a problem updating the ad, please try again.",
					 "create-banner-status-error" => "There was a problem adding new banner, please try again.",
					 "edit-banner-status-error" => "There was a problem updating the banner, please try again.",
					 "edit-order-status-error" => "There was a problem updating the order, please try again.",
					 "create-tracking-status-error" => "There was a problem updating tracking information, please try again.",
					 "create-discount-status-error" => "There was a problem creating the discount, please try again.",
					 "update-discount-status-error" => "There was a problem updating the discount, please try again.",
					 "delete-image-status-error" => "There was a problem deleting the image, please try again.",
					 "set-cover-image-status-error" => "There was a problem updating the product image, please try again.",
					 "delete-discount-status-error" => "There was a problem deleting the discount, please try again.",
					"bulk-update-tracking-status-error" => "There was a problem updating trackings, please try again.",
					"bulk-confirm-payment-status-error" => "There was a problem confirming payments, please try again.",
					"bulk-update-products-status-error" => "There was a problem updating products, please try again.",
					"bulk-upload-products-status-error" => "There was a problem uploading products, please try again."
                    ]
                   ];
				   
		    public $categories = ['watches' => "Watches",
			                      'anklets' => "Anklets",
								  'bracelets' => "Bracelets",
								  'brooches' => "Brooches",
								  'earrings' => "Ear Rings",
								  'necklaces' => "Necklaces",
								  'rings' => "Rings"
								  ];
				   
	public $smtp = [
       'ss' => "smtp.gmail.com",
       'sp' => "587",
       'sec' => "tls",
       'sa' => "yes",
       'su' => "aceluxurystoree@gmail.com",
       'spp' => "Ace12345$",
       'sn' => "Ace Luxury Store",
       'se' => "aceluxurystoree@gmail.com"
  ];
  
  
  public $adminEmail = "aceluxurystore@yahoo.com";
  public $suEmail = "kudayisitobi@gmail.com";
	
	
/**
 * Polyline encoding & decoding methods
 *
 * Convert list of points to encoded string following Google's Polyline
 * Algorithm.
 *
 * @category Mapping
 * @package  Polyline
 * @author   E. McConville <emcconville@emcconville.com>
 * @license  http://www.gnu.org/licenses/lgpl.html LGPL v3
 * @link     https://github.com/emcconville/google-map-polyline-encoding-tool
 */
	
	/**
     * Default precision level of 1e-5.
     *
     * Overwrite this property in extended class to adjust precision of numbers.
     * !!!CAUTION!!!
     * 1) Adjusting this value will not guarantee that third party
     *    libraries will understand the change.
     * 2) Float point arithmetic IS NOT real number arithmetic. PHP's internal
     *    float precision may contribute to undesired rounding.
     *
     * @var int $precision
     */
    protected static $precision = 5;


/**
     * Apply Google Polyline algorithm to list of points.
     *
     * @param array $points List of points to encode. Can be a list of tuples,
     *                      or a flat, one-dimensional array.
     *
     * @return string encoded string
     */
    final public static function encode( $points )
    {
        $points = self::flatten($points);
        $encodedString = '';
        $index = 0;
        $previous = array(0,0);
        foreach ( $points as $number ) {
            $number = (float)($number);
            $number = (int)round($number * pow(10, static::$precision));
            $diff = $number - $previous[$index % 2];
            $previous[$index % 2] = $number;
            $number = $diff;
            $index++;
            $number = ($number < 0) ? ~($number << 1) : ($number << 1);
            $chunk = '';
            while ( $number >= 0x20 ) {
                $chunk .= chr((0x20 | ($number & 0x1f)) + 63);
                $number >>= 5;
            }
            $chunk .= chr($number + 63);
            $encodedString .= $chunk;
        }
        return $encodedString;
    }

    /**
     * Reverse Google Polyline algorithm on encoded string.
     *
     * @param string $string Encoded string to extract points from.
     *
     * @return array points
     */
    final public static function decode( $string )
    {
        $points = array();
        $index = $i = 0;
        $previous = array(0,0);
        while ($i < strlen($string)) {
            $shift = $result = 0x00;
            do {
                $bit = ord(substr($string, $i++)) - 63;
                $result |= ($bit & 0x1f) << $shift;
                $shift += 5;
            } while ($bit >= 0x20);

            $diff = ($result & 1) ? ~($result >> 1) : ($result >> 1);
            $number = $previous[$index % 2] + $diff;
            $previous[$index % 2] = $number;
            $index++;
            $points[] = $number * 1 / pow(10, static::$precision);
        }
        return $points;
    }

    /**
     * Reduce multi-dimensional to single list
     *
     * @param array $array Subject array to flatten.
     *
     * @return array flattened
     */
    final public static function flatten( $array )
    {
        $flatten = array();
        array_walk_recursive(
            $array, // @codeCoverageIgnore
            function ($current) use (&$flatten) {
                $flatten[] = $current;
            }
        );
        return $flatten;
    }

    /**
     * Concat list into pairs of points
     *
     * @param array $list One-dimensional array to segment into list of tuples.
     *
     * @return array pairs
     */
    final public static function pair( $list )
    {
        return is_array($list) ? array_chunk($list, 2) : array();
    }



/********************************************************************************************************************/

         #{'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth};
         function sendEmailSMTP($data,$view,$type="view")
           {
           	    // Setup a new SmtpTransport instance for new SMTP
                $transport = "";
if($data['sec'] != "none") $transport = new Swift_SmtpTransport($data['ss'], $data['sp'], $data['sec']);

else $transport = new Swift_SmtpTransport($data['ss'], $data['sp']);

   if($data['sa'] != "no"){
                  $transport->setUsername($data['su']);
                  $transport->setPassword($data['spp']);
     }
// Assign a new SmtpTransport to SwiftMailer
$smtp = new Swift_Mailer($transport);

// Assign it to the Laravel Mailer
Mail::setSwiftMailer($smtp);

$se = $data['se'];
$sn = $data['sn'];
$to = $data['em'];
$subject = $data['subject'];
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject,$se,$sn){
                           $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject,$se,$sn){
                            $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }    

           function createUser($data)
           {
           	$ret = User::create([
                                                      'email' => $data['email'], 
                                                      'phone' => $data['phone'], 
                                                      'fname' => $data['fname'], 
                                                      'lname' => $data['lname'], 
                                                      'role' => $data['role'], 
                                                      'status' => "enabled", 
                                                      'verified' => "yes", 
                                                      'password' => bcrypt($data['pass']), 
                                                      ]);
                                                      
                return $ret;
           }
           
           function getShippingDetails($user)
           {
           	$ret = [];
			$uid = isset($user->id) ? $user->id: $user;
               $sdd = ShippingDetails::where('user_id',$uid)->get();
 
              if($sdd != null)
               {
				   foreach($sdd as $sd)
				   {
				      $temp = [];
                   	   $temp['company'] = $sd->company; 
                       $temp['address'] = $sd->address; 
                       $temp['city'] = $sd->city;
                       $temp['state'] = $sd->state; 
                       $temp['zipcode'] = $sd->zipcode; 
                       $temp['id'] = $sd->id; 
                       $temp['date'] = $sd->created_at->format("jS F, Y"); 
                       array_push($ret,$temp); 
				   }
               }                         
                                                      
                return $ret;
           }

		   
		   function bomb($data) 
           {
           	//form query string
               $qs = "sn=".$data['sn']."&sa=".$data['sa']."&subject=".$data['subject'];

               $lead = $data['em'];
			   
			   if($lead == null)
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid recipient email"]);
			   }
			   else
			    { 
                  $qs .= "&receivers=".$lead."&ug=deal"; 
               
                  $config = $this->emailConfig;
                  $qs .= "&host=".$config['ss']."&port=".$config['sp']."&user=".$config['su']."&pass=".$config['spp'];
                  $qs .= "&message=".$data['message'];
               
			      //Send request to nodemailer
			      $url = "https://radiant-island-62350.herokuapp.com/?".$qs;
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
                 ]);
			     $res = $client->request('GET', $url);
			  
                 $ret = $res->getBody()->getContents(); 
			 
			     $rett = json_decode($ret);
			     if($rett->status == "ok")
			     {
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }
			    }
              return $ret; 
           }
		   
		   function getUsers()
           {
           	$ret = [];
              $users = User::where('id','>',"0")->get();
             
              if($users != null)
               {
				  foreach($users as $u)
				  {
					  $uu = $this->getUser($u->id);
					  array_push($ret,$uu);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getUser($id)
           {
           	$ret = [];
               $u = User::where('email',$id)
			            ->orWhere('id',$id)->first();
 
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       //$temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $u->phone; 
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y h:i"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		   function getProducts()
           {
           	$ret = [];
              $products = Products::where('id','>',"0")->get();
              $products = $products->sortByDesc('created_at');
			  
              if($products != null)
               {
				  foreach($products as $p)
				  {
					  $pp = $this->getProduct($p->id);
					  array_push($ret,$pp);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getProduct($id,$imgId=false)
           {
           	$ret = [];
              $product = Products::where('id',$id)
			                 ->orWhere('sku',$id)->first();
       
              if($product != null)
               {
				  $temp = [];
				  $temp['id'] = $product->id;
				  $temp['sku'] = $product->sku;
				  $temp['qty'] = $product->qty;
				  $temp['status'] = $product->status;
				  $temp['pd'] = $this->getProductData($product->sku);
				  $imgs = $this->getImages($product->sku);
				  if($imgId) $temp['imgs'] = $imgs;
				  $temp['imggs'] = $this->getCloudinaryImages($imgs);
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }

		   function getProductData($sku)
           {
           	$ret = [];
              $pd = ProductData::where('sku',$sku)->first();
 
              if($pd != null)
               {
				  $temp = [];
				  $temp['id'] = $pd->id;
				  $temp['sku'] = $pd->sku;
				  $temp['amount'] = $pd->amount;
				  $temp['description'] = $pd->description;
				  $temp['in_stock'] = $pd->in_stock;
				  $temp['category'] = $pd->category;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
		   function getProductImages($sku)
           {
           	$ret = [];
              $pis = ProductImages::where('sku',$sku)->get();
 
            
              if($pis != null)
               {
				  foreach($pis as $pi)
				  {
				    $temp = [];
				    $temp['id'] = $pi->id;
				    $temp['sku'] = $pi->sku;
				    $temp['cover'] = $pi->cover;
				    $temp['url'] = $pi->url;
				    array_push($ret,$temp);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function isCoverImage($img)
		   {
			   return $img['cover'] == "yes";
		   }
		   
		   function getImage($pi)
           {
       	         $temp = [];
				 $temp['id'] = $pi->id;
				 $temp['sku'] = $pi->sku;
			     $temp['cover'] = $pi->cover;
				 $temp['url'] = $pi->url;
				 
                return $temp;
           }
		   
		   function getImages($sku)
		   {
			   $ret = [];
			   $records = $this->getProductImages($sku);
			   
			   $coverImage = ProductImages::where('sku',$sku)
			                              ->where('cover',"yes")->first();
										  
               $otherImages = ProductImages::where('sku',$sku)
			                              ->where('cover',"!=","yes")->get();
			  
               if($coverImage != null)
			   {
				   $temp = $this->getImage($coverImage);
				   array_push($ret,$temp);
			   }

               if($otherImages != null)
			   {
				   foreach($otherImages as $oi)
				   {
					   $temp = $this->getImage($oi);
				       array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }

		  
		   function setCoverImage($id)
           {
              $pi = ProductImages::where('id',$id)->first();
            
              if($pi != null)
               {
				   $formerPi = ProductImages::where('sku',$pi->sku)
			              ->where('cover',"yes")->first();
                   
				   if($formerPi != null)
				   {
					   $formerPi->update(['cover' => "no"]);
				   }
				   
				  $pi->update(['cover' => "yes"]);
               }                         
                                                      
           }
		   
		   function getCloudinaryImage($dt)
		   {
			   $ret = [];
                  //dd($dt);       
               if(is_null($dt)) { $ret = "img/no-image.png"; }
               
			   else
			   {
				    $ret = "https://res.cloudinary.com/dahkzo84h/image/upload/v1585236664/".$dt;
                }
				
				return $ret;
		   }
		   
		   function getCloudinaryImages($dt)
		   {
			   $ret = [];
                  //dd($dt);       
               if(count($dt) < 1) { $ret = ["img/no-image.png"]; }
               
			   else
			   {
                   $ird = $dt[0]['url'];
				   if($ird == "none")
					{
					   $ret = ["img/no-image.png"];
					}
				   else
					{
                       for($x = 0; $x < count($dt); $x++)
						 {
							 $ird = $dt[$x]['url'];
                            $imgg = "https://res.cloudinary.com/dahkzo84h/image/upload/v1585236664/".$ird;
                            array_push($ret,$imgg); 
                         }
					}
                }
				
				return $ret;
		   }
		
		   
		     function updateUser($data)
           {		

				$uu = User::where('id', $data['xf'])->first();
				
				if(!is_null($uu))				
				{
					$uu->update(['fname' => $data['fname'], 
                                                      'lname' => $data['lname'],
                                                     'email' => $data['email'],
                                                'phone' => $data['phone'],
                                              'status' => $data['status'] 
                                                      ]);	
				}
					
           }
		   
		   function isAdmin($user)
           {
           	$ret = false; 
               if($user->role === "admin" || $user->role === "su") $ret = true; 
           	return $ret;
           }
		   
		   function generateSKU()
           {
           	$ret = "ACE".rand(1,9999)."LX".rand(1,999);
                                                      
                return $ret;
           }
		   
		   
		   function createProduct($data)
           {
           	$sku = $this->generateSKU();
               
           	$ret = Products::create(['name' => $data['name'],                                                                                                          
                                                      'sku' => $sku, 
                                                      'qty' => $data['qty'],                                                       
                                                      'added_by' => $data['user_id'],                                                       
                                                      'status' => "enabled", 
                                                      ]);
                                                      
                 $data['sku'] = $ret->sku;                         
                $pd = $this->createProductData($data);
				$ird = "none";
				$irdc = 0;
				if(isset($data['ird']) && count($data['ird']) > 0)
				{
					foreach($data['ird'] as $i)
                    {
                    	$this->createProductImage(['sku' => $data['sku'], 'url' => $i['public_id'], 'cover' => $i['ci'], 'irdc' => "1"]);
                    }
				}
                
                return $ret;
           }
           function createProductData($data)
           {
           	$in_stock = (isset($data["in_stock"])) ? "new" : $data["in_stock"];
           
           	$ret = ProductData::create(['sku' => $data['sku'],                                                                                                          
                                                      'description' => $data['description'], 
                                                      'amount' => $data['amount'],                                                      
                                                      'category' => $data['category'],                                                       
                                                      'in_stock' => $in_stock                                              
                                                      ]);
                                                      
                return $ret;
           }
         
           function createProductImage($data)
           {
			   $cover = isset($data['cover']) ? $data['cover'] : "no";
           	$ret = ProductImages::create(['sku' => $data['sku'],                                                                                                          
                                                      'url' => $data['url'], 
                                                      'irdc' => $data['irdc'], 
                                                      'cover' => $cover, 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function createDiscount($data)
           {
			   $sku = ($data['type'] == "single") ? $data['type'] : "";
			   
           	$ret = Discounts::create(['sku' => $data['sku'],                                                                                                          
                                                      'discount_type' => $data['discount_type'], 
                                                      'discount' => $data['discount'], 
                                                      'type' => $data['type'], 
                                                      'status' => $data['status'], 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getDiscounts($id="")
           {
           	$ret = [];
			if($id == "")
			{
				$discounts = Discounts::where('id','>',"0")->get();
			}
			else
			{
				$product = Products::where('id',$id)
			                 ->orWhere('sku',$id)->first();
				
				if($product != null)
               {
				    $discounts = Discounts::where('sku',$id)
			                 ->orWhere('type',"all")->get();
			   }
			}
              
 
              
							 
					if($discounts != null)
					{
						foreach($discounts as $disc)
						{
							$temp = [];
				            $temp['id'] = $disc->id;
				            $temp['sku'] = $disc->sku;
				            $temp['discount_type'] = $disc->discount_type;
				            $temp['discount'] = $disc->discount;
				            $temp['type'] = $disc->type;
				            $temp['status'] = $disc->status;
							array_push($ret,$temp);
						}
					}                      
                                                      
                return $ret;
           }

		   function getDiscount($id)
           {
           	
				$disc = Discounts::where('id',$id)->first();              
							 
					if($disc != null)
					{
					
							$temp = [];
				            $temp['id'] = $disc->id;
				            $temp['sku'] = $disc->sku;
				            $temp['discount_type'] = $disc->discount_type;
				            $temp['discount'] = $disc->discount;
				            $temp['type'] = $disc->type;
				            $temp['status'] = $disc->status;
							$ret = $temp;
					}                      
                                                      
                return $ret;
           }
		   
		   function updateProduct($data)
           {
           	$ret = [];
              $p = Products::where('id',$data['xf'])
			                 ->orWhere('sku',$data['xf'])->first();
              
			  //dd($data);
              if($p != null)
               {
				  $p->update([
				  'qty' => $data['qty'],
				    'status' => $data['status']
				  ]);
				  
				  $pd = ProductData::where('sku',$p->sku)->first();
				  if($pd != null)
				  {
					  $pd->update([
					    'category' => $data['category'],
					    'in_stock' => $data['in_stock'],
					    'amount' => $data['amount'],
					    'description' => $data['description'],
					  ]);
				  }
				  
				  //images
				  if(isset($data['ird']) && count($data['ird']) > 0)
				{
					foreach($data['ird'] as $url)
                    {
                    	$this->createProductImage(['sku' => $p->sku, 'url' => $url, 'irdc' => "1"]);
                    }
				}

                  //discounts
                  if($data['add_discount'] == "yes")
				  {
					  $disc = ['sku' => $p->sku,
					           'discount_type' => $data['discount_type'],
							   'discount' => $data['discount'],
							   'type' => 'single',
							   'status' => "enabled"
							   ];
					  $discount = $this->createDiscount($disc);
				  }				  
				 
               }                         
                                                      
                return "ok";
           }

		   function disableProduct($id,$def=false)
           {
           	$ret = [];
              $p = Products::where('id',$id)
			                 ->orWhere('sku',$id)->first();
              
			  //dd($data);
              if($p != null)
               {
				  $p->update([		
				    'status' => "disabled"
				  ]);
               }                         
                                                      
                return "ok";
           } 
		   
		    function updateDiscount($data)
           {
           	$ret = [];
              $disc = Discounts::where('id',$data['xf'])->first();
              
			  //dd($data);
              if($disc != null)
               {
				  $disc->update([
				  'type' => $data['type'],
				  'sku' => $data['sku'],
				  'discount_type' => $data['discount_type'],
				  'discount' => $data['discount'],
				    'status' => $data['status']
				  ]);
				  
				 
               }                         
                                                      
                return "ok";
           }
		   
		   function deleteDiscount($xf)
           {
           	$ret = [];
              $d = Discounts::where('id',$xf)->first();
              
			  //dd($data);
              if($d != null)
               {
				 $d->delete();
               }                         
                                                      
                return "ok";
           }
		   
		   function deleteProductImage($xf)
           {
           	$ret = [];
              $pi = ProductImages::where('id',$xf)->first();
              
			  //dd($data);
              if($pi != null)
               {
				 // $this->deleteCloudImage($pi->url);
				 $pi->delete();
               }                         
                                                      
                return "ok";
           }
		   
		  function deleteCloudImage($id)
          {
          	$dt = ['cloud_name' => "dahkzo84h",'invalidate' => true];
          	$rett = \Cloudinary\Uploader::destroy($id,$dt);
                                                     
             return $rett; 
         }
		 
		 function resizeImage($res,$size)
		 {
			  $ret = Image::make($res)->resize($size[0],$size[1])->save(sys_get_temp_dir()."/upp");			   
              // dd($ret);
			   $fname = $ret->dirname."/".$ret->basename;
			   $fsize = getimagesize($fname);
			  return $fname;		   
		 }
		   
		    function uploadCloudImage($path)
          {
          	$ret = [];
          	$dt = ['cloud_name' => "dahkzo84h"];
              $preset = "tsh1rffm";
          	$rett = \Cloudinary\Uploader::unsigned_upload($path,$preset,$dt);
                                                      
             return $rett; 
         }
		 
		  function addCategory($data)
           {
           	$category = Categories::create([
			   'name' => $data['name'],
			   'category' => $data['category'],
			   'special' => $data['special'],
			   'status' => $data['status'],
			]);                          
            return $ret;
           }
		   
		   function getCategories()
           {
           	$ret = [];
           	$categories = Categories::where('id','>','0')->get();
              // dd($cart);
			  
              if($categories != null)
               {           	
               	foreach($categories as $c) 
                    {
						$temp = [];
						$temp['id'] = $c->id;
						$temp['name'] = $c->name;
						$temp['category'] = $c->category;
						$temp['special'] = $c->special;
						$temp['status'] = $c->status;
						array_push($ret,$temp);
                    }
                   
               }                                 
                                                      
                return $ret;
           }
		   
		   function getCategory($id)
           {
           	$ret = [];
           	$c = Categories::where('id',$id)->first();
              // dd($cart);
			  
              if($c != null)
               {           	
						$temp = [];
						$temp['id'] = $c->id;
						$temp['name'] = $c->name;
						$temp['category'] = $c->category;
						$temp['special'] = $c->special;
						$temp['status'] = $c->status;
						$ret = $temp;
               }                                 
                                                      
                return $ret;
           }
		   
		   function createCategory($data)
           {
           	$ret = Categories::create(['name' => ucwords($data['category']),                                                                                                          
                                                      'category' => $data['category'],                                                      
                                                      'special' => $data['special'],                                                      
                                                      'status' => $data['status'], 
                                                      ]);
            
                
                return $ret;
           }
		   
		   function updateCategory($data)
           {
			  $c = Categories::where('id',$data['xf'])->first();
			 
			  $special = isset($data['special']) ? $data['special'] : "";
			 
			if($c != null)
			{
				$c->update(['name' => ucwords($data['category']),                                                                                                          
                                                      'category' => $data['category'],                                                      
                                                      'special' => $special,                                                      
                                                      'status' => $data['status']
				
				]);
			}

                return "ok";
           }
		   
		   function createAd($data)
           {
           	$ret = Ads::create(['img' => $data['img'], 
                                                      'type' => $data['type'], 
                                                      'status' => $data['status'] 
                                                      ]);
                                                      
                return $ret;
           }

            function getAds($type="wide-ad")
		   {
			   $ret = [];
			   $ads = Ads::where('id',">",'0')->get();
			   #dd($ads);
			   if(!is_null($ads))
			   {
				   foreach($ads as $ad)
				   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }	   

		   function getAd($id)
		   {
			   $ret = [];
			   $ad = Ads::where('id',$id)->first();
			   #dd($ads);

			   if(!is_null($ad))
			   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   $ret = $temp;
			   }
			   
			   return $ret;
		   }	 

            function updateAd($data)
           {
			  $ad = Ads::where('id',$data['xf'])->first();
			 
			 
			if($ad != null)
			{
				$ad->update(['type' => $data['type'],                                                                                                                                                               
                                                      'status' => $data['status']
				
				]);
			}

                return "ok";
           }		   
		  
		  
		    function createReview($user,$data)
           {
			   $userId = $user == null ? $this->generateTempUserID() : $user->id;
           	$ret = Reviews::create(['user_id' => $userId, 
                                                      'sku' => $data['sku'], 
                                                      'rating' => $data['rating'],
                                                      'name' => $data['name'],
                                                      'review' => $data['review'],
													  'status' => "pending",
                                                      ]);
                                                      
                return $ret;
           }
		   
		  function getReviews()
           {
           	$ret = [];
              $reviews = Reviews::where('id','>',"0")->get();
              $reviews = $reviews->sortByDesc('created_at');
			  
              if($reviews != null)
               {
				  foreach($reviews as $r)
				  {
					  $temp = [];
					  $temp['id'] = $r->id;
					  $temp['user_id'] = $r->user_id;
					  $temp['sku'] = $r->sku;
					  $temp['rating'] = $r->rating;
					  $temp['name'] = $r->name;
					  $temp['review'] = $r->review;
					  $temp['status'] = $r->status;
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getReview($id)
           {
           	$ret = [];
              $r = Reviews::where('id',$id)->first();
 
              if($r != null)
               {
				  
					  $temp = [];
					  $temp['id'] = $r->id;
					  $temp['user_id'] = $r->user_id;
					  $temp['sku'] = $r->sku;
					  $temp['rating'] = $r->rating;
					  $temp['name'] = $r->name;
					  $temp['review'] = $r->review;
					  $temp['status'] = $r->status;
					  $ret = $temp;
               }                         
                                  
                return $ret;
           }
		   
		    function updateReview($data)
           {
			  $r = Reviews::where('id',$data['xf'])->first();
			   #dd($data);
			 
			if($r != null)
			{
				$r->update(['name' => $data['name'],                                                                                                                                                               
                                                      'status' => $data['status']
				
				]);
			}

                return "ok";
           }
		   
		    function createBanner($data)
           {
			   $copy = isset($data['copy']) ? $data['copy'] : "";
           	$ret = Banners::create(['img' => $data['img'], 
                                                      'title' => $data['title'], 
                                                      'subtitle' => $data['subtitle'], 
                                                      'copy' => $copy, 
                                                      'status' => $data['status'] 
                                                      ]);
                                                      
                return $ret;
           }

            function getBanners()
		   {
			   $ret = [];
			   $banners = Banners::where('id',">",'0')->get();
			   #dd($ads);
			   if(!is_null($banners))
			   {
				   foreach($banners as $b)
				   {
					   $temp = [];
					   $temp['id'] = $b->id;
					   $img = $b->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['title'] = $b->title;
					   $temp['subtitle'] = $b->subtitle;
					   $temp['copy'] = $b->copy;
					   $temp['status'] = $b->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }	   

		   function getBanner($id)
		   {
			   $ret = [];
			   $b = Banners::where('id',$id)->first();
			   #dd($banners);
			   if(!is_null($b))
			   {
					   $temp = [];
					   $temp['id'] = $b->id;
					   $img = $b->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['title'] = $b->title;
					   $temp['subtitle'] = $b->subtitle;
					   $temp['copy'] = $b->copy;
					   $temp['status'] = $b->status;
					   $ret = $temp;
			   }
			   
			   return $ret;
		   }	 

            function updateBanner($data)
           {
			  $b = Banners::where('id',$data['xf'])->first();
			 
			 
			if($b != null)
			{
				$rr = ['status' => $data['status']];
				if(isset($data['img'])) $rr['img'] = $data['img'];
				$b->update($rr);
			}

                return "ok";
           }
		   
		   function deleteBanner($xf)
           {
           	$ret = [];
              $b = Banners::where('id',$xf)->first();
              
			  //dd($data);
              if($b != null)
               {
				 // $this->deleteCloudImage($pi->url);
				 $b->delete();
               }                         
                                                      
                return "ok";
           }

		   function getDashboardStats()
           {
			   $ret = [];
			   
			  //total products
			  $ret['total'] = Products::where('id','>',"0")->count();
			  $ret['enabled'] = Products::where('status',"enabled")->count();
			  $ret['disabled'] = Products::where('status',"disabled")->count();
			  $ret['o_total'] = Orders::where('id','>',"0")->count();
			  $ret['o_paid'] = Orders::where('id','>',"0")->where('status',"paid")->count();
			  $ret['o_unpaid'] = Orders::where('id','>',"0")->where('status',"unpaid")->count();
			  $ret['o_today'] = Orders::whereDate('created_at',date("Y-m-d"))->count();
			  $ret['o_month'] = Orders::whereMonth('created_at',date("m"))->count();
			
              return $ret;
           }
		   
		   function getProfits()
		   {
			   $ret = [];
			   
			    //total profits
				$ret['total'] = Orders::where('id','>',"0")->where('status',"paid")->sum('amount');
				$ret['today'] = Orders::whereDate('created_at',date("Y-m-d"))->where('status',"paid")->sum('amount');
				$ret['month'] = Orders::whereMonth('created_at',date("m"))->where('status',"paid")->sum('amount');
				
				return $ret;
		   }
		   
		   
		   function createTracking($dt)
		   {
			   $status = $dt['status'];
			   $description = $this->deliveryStatuses[$status];
			   $ret = Trackings::create(['user_id' => $dt['user_id'],
			                          'reference' => $dt['reference'],
			                          'description' => $description,
			                          'status' => $status
			                 ]);
			  return $ret;
		   }

           function getTrackings($reference="")
		   {
			   $ret = [];
			   if($reference == "") $trackings = Trackings::where('id','>',"0")->get();
			   else $trackings = Trackings::where('reference',$reference)->get();
			   
			   if(!is_null($trackings))
			   {
				  $trackings = $trackings->sortByDesc('created_at');
				   foreach($trackings as $t)
				   {
					   $temp = [];
					   $temp['id'] = $t->id;
					   $temp['user_id'] = $t->user_id;
					   $temp['reference'] = $t->reference;
					   $temp['description'] = $t->description;
					   $temp['status'] = $t->status;
					   $temp['date'] = $t->created_at->format("jS F, Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }	



            function createOrder($user, $dt)
		   {
			   $ret = Orders::create(['user_id' => $user->id,
			                          'reference' => $dt['ref'],
			                          'amount' => $dt['amount'],
			                          'type' => $dt['type'],
			                          'payment_code' => $dt['payment_code'],
			                          'notes' => $dt['notes'],
			                          'status' => $dt['status'],
			                 ]);
			  return $ret;
		   }
		   
		    function getDeliveryFee()
		   {
			   return 1000;
		   }

		   function createOrderItems($dt)
		   {
			   $ret = OrderItems::create(['order_id' => $dt['order_id'],
			                          'sku' => $dt['sku'],
			                          'qty' => $dt['qty']
			                 ]);
			  return $ret;
		   }

           function getOrderTotals($items)
           {
           	$ret = ["subtotal" => 0, "delivery" => 0, "items" => 0];
              #dd($items);
              if($items != null && count($items) > 0)
               {           	
               	foreach($items as $i) 
                    {
						$amount = $i['product']['pd']['amount'];
						$qty = $i['qty'];
                    	$ret['items'] += $qty;
						$ret['subtotal'] += ($amount * $qty);	
                    }
                   
                   $ret['delivery'] = $this->getDeliveryFee();
                  
               }                                 
                                                      
                return $ret;
           }

           function getOrders()
           {
           	$ret = [];

			  $orders = Orders::where('id','>',"0")->get();
			  $orders = $orders->sortByDesc('created_at');
			  #dd($uu);
              if($orders != null)
               {
               	  foreach($orders as $o) 
                    {
                    	$temp = $this->getOrder($o->reference);
                        array_push($ret, $temp); 
                    }
               }                                 
              			  
                return $ret;
           }
		   
		   function getOrder($ref)
           {
           	$ret = [];

			  $o = Orders::where('id',$ref)
			                  ->orWhere('reference',$ref)->first();
			  #dd($uu);
              if($o != null)
               {
				  $temp = [];
                  $temp['id'] = $o->id;
                  $temp['user_id'] = $o->user_id;
                  $temp['reference'] = $o->reference;
                  $temp['amount'] = $o->amount;
                  $temp['type'] = $o->type;
                  $temp['payment_code'] = $o->payment_code;
                  $temp['notes'] = $o->notes;
                  $temp['status'] = $o->status;
                  $temp['current_tracking'] = $this->getCurrentTracking($o->reference);
                  $temp['items'] = $this->getOrderItems($o->id);
                  $temp['totals'] = $this->getOrderTotals( $temp['items']);
				  if($o->user_id == "anon")
				  {
						$anon = $this->getAnonOrder($o->reference,false);
						$temp['totals']['delivery'] = $this->getDeliveryFee($anon['state'],"state");
                        $temp['anon'] = $anon;						
				  }
                  $temp['date'] = $o->created_at->format("jS F, Y");
                  $ret = $temp; 
               }                                 
              		#dd($ret);	  
                return $ret;
           }


           function getOrderItems($id)
           {
           	$ret = [];

			  $items = OrderItems::where('order_id',$id)->get();
			  #dd($uu);
              if($items != null)
               {
               	  foreach($items as $i) 
                    {
						$temp = [];
                    	$temp['id'] = $i->id; 
                        $temp['product'] = $this->getProduct($i->sku); 
                        $temp['qty'] = $i->qty; 
                        array_push($ret, $temp); 
                    }
               }                                 
              			  
                return $ret;
           }

           function updateOrder($data)
           {
			  $o = Orders::where('id',$data['xf'])->first();
			 
			 
			if($o != null)
			{
				$o->update(['status' => $data['status']
				
				]);
			}

                return "ok";
           }		   
		
		
		 function getPasswordResetCode($user)
           {
           	$u = $user; 
               
               if($u != null)
               {
               	//We have the user, create the code
                   $code = bcrypt(rand(125,999999)."rst".$u->id);
               	$u->update(['reset_code' => $code]);
               }
               
               return $code; 
           }
           
           function verifyPasswordResetCode($code)
           {
           	$u = User::where('reset_code',$code)->first();
               
               if($u != null)
               {
               	//We have the user, delete the code
               	$u->update(['reset_code' => '']);
               }
               
               return $u; 
           }
		   
		   function confirmPayment($id)
           {
            $o = $this->getOrder($id);
             # dd($o);
               if(count($o) > 0)
               {
				   if($o['user_id'] == "anon")
				   {
					   $u = $o['anon'];
					   $shipping = [
					     'address' => $u['address'],
					     'city' => $u['city'],
					     'state' => $u['state']
					   ];
				   }
				   else
				   {
					   $u = $this->getUser($o['user_id']);
					   $sd = $this->getShippingDetails($u['id']);
					   $shipping = $sd[0];
				   }
				   
				  # dd($u);
               	//We have the user, update the status and notify the customer
				$oo = Orders::where('reference',$o['reference'])->first();
               	if(!is_null($oo)) $oo->update(['status' => 'paid']);
				$ret = $this->smtp;
				$ret['order'] = $o;
				$ret['name'] = $o['user_id'] == "anon" ? $u['name'] : $u['fname'];
				$ret['subject'] = "Your payment for order ".$o['payment_code']." has been confirmed!";
		        $ret['em'] = $u['email'];
		        $this->sendEmailSMTP($ret,"emails.confirm-payment");
				
				$ret = $this->smtp;
				$ret['order'] = $o;
				$ret['user'] = $u['email'];
				$ret['name'] = $o['user_id'] == "anon" ? $u['name'] : $u['fname']." ".$u['lname'];
		        $ret['subject'] = "URGENT: Received payment for order ".$o['payment_code'];
		        $ret['shipping'] = $shipping;
		        $ret['em'] = $this->adminEmail;
		        $this->sendEmailSMTP($ret,"emails.payment-alert");
				$ret['em'] = $this->suEmail;
		        $this->sendEmailSMTP($ret,"emails.payment-alert");
               }
               
               return $o; 
           }
		   
		   function deleteOrder($id)
           {
			  $o = Orders::where('id',$id)
			           ->OrWhere('reference',$id)->first();
			 
			 
			if($o != null)
			{
				$items = OrderItems::where('order_id',$o->id)->get();
			    if($items != null)
                 {
                   foreach($items as $i) 
                    {
                    	$i->delete();
                    }
                }
                
                $o->delete();
			}

                return "ok";
           }


          function manageUserStatus($dt)
		  {
			  $user = User::where('id',$dt['id'])
			              ->orWhere('email',$dt['id'])->first();
			  
			  if($user != null)
			  {
				  $val = $dt['action'] == "enable" ? "enabled" : "disabled";
				  $user->update(['status' => $val]);
			  }
			  
			  return "ok";
		  }
		
		  function updateTracking($o,$action)
         {
         	$order = $this->getOrder($o->reference);
                    if(count($order) > 0)
                    {
                    	if($order['user_id'] == "anon")
                        {
                        	$u = order['anon'];
                        }
                        else
                        {
                        	$u = $this->getUser($order['user_id']);
                        }
                    	$t = [
                         'user_id' => $order['user_id'],
                         'reference' => $o->reference,
                         'status' => $action
                         ];
                         
                         $this->createTracking($t);
                         
                         $ret = $this->smtp;
				         $ret['order'] = $order;
				        $ret['tracking'] = $this->deliveryStatuses[$action];
				       $ret['name'] = $order['user_id'] == "anon" ? $u['name'] : $u['fname']." ".$u['lname'];
		               $ret['subject'] = "New update for order #".$o['reference'];
		        $ret['em'] = $u['email'];
		        $this->sendEmailSMTP($ret,"emails.tracking-alert");
                    }
         }

          function bulkUpdateTracking($data)
		  {
			$dt = json_decode($data['dt']);
			$action = $data['action'];
			
			#dd($dt);
			 
			foreach($dt as $o)
            {
            	if($o->selected)
                {
                	$this->updateTracking($o,$action);
                }
            }
			  
			  
			  return "ok";
		  }	

         function getCurrentTracking($reference)
         {
         	$ret = null;
         	$trackings = $this->getTrackings($reference);
             
             if(count($trackings) > 0)
             {
             	$ret = $trackings[0];
             }
             
             return $ret;
        }

         function bulkConfirmPayment($data)
		  {
			$dt = json_decode($data['dt']);
			$action = $data['action'];
			
			#dd($dt);
			 
			foreach($dt as $o)
            {
            	if($o->selected)
                {
                	$this->confirmPayment($o->reference);
                }
            }
			  
			  
			  return "ok";
		  }		
		  
		 function bulkUpdateProducts($data)
		  {
			$dt = json_decode($data['dt']);
			
			#dd($dt);
			 
			foreach($dt as $p)
            {
                	$product = Products::where('sku',$p->sku)->first();
					
					if($product != null)
					{
						$product->update(['qty' => $p->qty]);
					}
            }
			  
			  
			  return "ok";
		  }		  
		  
		  
		   function getAnonOrder($id,$all=true)
           {
           	$ret = [];
			if($all)
			{
				$o = AnonOrders::where('reference',$id)
			            ->orWhere('id',$id)->first();
						
               $o2 = Orders::where('reference',$id)
			            ->orWhere('id',$id)->first();
						#dd([$o,$o2]);
              if($o != null || $o2 != null)
               {
				   if($o != null)
				   {
					 $temp['name'] = $o->name; 
                       $temp['reference'] = $o->reference; 
                       //$temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $o->phone; 
                       $temp['email'] = $o->email; 
                       $temp['address'] = $o->address; 
                       $temp['city'] = $o->city; 
                       $temp['state'] = $o->state; 
                       $temp['id'] = $o->id; 
                       $temp['date'] = $o->created_at->format("jS F, Y"); 
                       $ret = $temp;  
				   }
				   else if($o2 != null)
				   {
					   $u = $this->getUser($o2->user_id);
					   $sd = $this->getShippingDetails($u['id']);
					   $shipping = $sd[0];
					   
					  if(count($u) > 0)
					   {
						 $temp['name'] = $u['fname']." ".$u['lname']; 
                         $temp['reference'] = $o2->reference;                 
                         $temp['phone'] = $u['phone']; 
                         $temp['email'] = $u['email']; 
                         $temp['address'] = $shipping['address']; 
                         $temp['city'] = $shipping['city']; 
                         $temp['state'] = $shipping['state']; 
                         $temp['id'] = $o2->id; 
                         $temp['date'] = $o2->created_at->format("jS F, Y"); 
                         $ret = $temp;  
					   }  
				   }
                   	 
               }
			}
			
			else
			{
				$o = AnonOrders::where('reference',$id)
			            ->orWhere('id',$id)->first();
						
				if($o != null)
				   {
					 $temp['name'] = $o->name; 
                       $temp['reference'] = $o->reference; 
                       //$temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $o->phone; 
                       $temp['email'] = $o->email; 
                       $temp['address'] = $o->address; 
                       $temp['city'] = $o->city; 
                       $temp['state'] = $o->state; 
                       $temp['id'] = $o->id; 
                       $temp['date'] = $o->created_at->format("jS F, Y"); 
                       $ret = $temp;  
				   }
			}
                                         
                                                      
                return $ret;
           }
		
           
           
}
?>