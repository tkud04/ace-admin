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
use App\Carts;
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
use App\Settings;
use App\Plugins;
use App\Senders;
use App\Catalogs;
use Analytics;
use Spatie\Analytics\Period;
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
                     "delete-product-status" => "Product deleted!",
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
                     "bulk-update-products-status" => "Products updated",
                     "bulk-upload-products-status" => "Products uploaded",
                     "no-validation-status" => "Please fill all required fields",
                     "add-plugin-status" => "Plugin added",
                     "update-plugin-status" => "Plugin updated",
                     "remove-plugin-status" => "Plugin removed",
                     "add-sender-status" => "Sender added",
                     "remove-sender-status" => "Sender removed",
                     "mark-sender-status" => "Sender updated",
					 "add-catalog-status" => "Item(s) added to catalog",
                     "remove-catalog-status" => "Item(s) removed from catalog",
                     "update-catalog-status" => "Catalog updated",
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
  
  public $smtpp = [
       'gmail' => [
       'ss' => "smtp.gmail.com",
       'sp' => "587",
       'sec' => "tls",
       ],
       'yahoo' => [
       'ss' => "smtp.mail.yahoo.com",
       'sp' => "587",
       'sec' => "ssl",
       ],
  ];
  
   public $banks = [
      'access' => "Access Bank", 
      'citibank' => "Citibank", 
      'diamond-access' => "Diamond-Access Bank", 
      'ecobank' => "Ecobank", 
      'fidelity' => "Fidelity Bank", 
      'fbn' => "First Bank", 
      'fcmb' => "FCMB", 
      'globus' => "Globus Bank", 
      'gtb' => "GTBank", 
      'heritage' => "Heritage Bank", 
      'jaiz' => "Jaiz Bank", 
      'keystone' => "KeyStone Bank", 
      'polaris' => "Polaris Bank", 
      'providus' => "Providus Bank", 
      'stanbic' => "Stanbic IBTC Bank", 
      'standard-chartered' => "Standard Chartered Bank", 
      'sterling' => "Sterling Bank", 
      'suntrust' => "SunTrust Bank", 
      'titan-trust' => "Titan Trust Bank", 
      'union' => "Union Bank", 
      'uba' => "UBA", 
      'unity' => "Unity Bank", 
      'wema' => "Wema Bank", 
      'zenith' => "Zenith Bank"
 ];		

 public $states = [
			                       'abia' => 'Abia',
			                       'adamawa' => 'Adamawa',
			                       'akwa-ibom' => 'Akwa Ibom',
			                       'anambra' => 'Anambra',
			                       'bauchi' => 'Bauchi',
			                       'bayelsa' => 'Bayelsa',
			                       'benue' => 'Benue',
			                       'borno' => 'Borno',
			                       'cross-river' => 'Cross River',
			                       'delta' => 'Delta',
			                       'ebonyi' => 'Ebonyi',
			                       'enugu' => 'Enugu',
			                       'edo' => 'Edo',
			                       'ekiti' => 'Ekiti',
			                       'gombe' => 'Gombe',
			                       'imo' => 'Imo',
			                       'jigawa' => 'Jigawa',
			                       'kaduna' => 'Kaduna',
			                       'kano' => 'Kano',
			                       'katsina' => 'Katsina',
			                       'kebbi' => 'Kebbi',
			                       'kogi' => 'Kogi',
			                       'kwara' => 'Kwara',
			                       'lagos' => 'Lagos',
			                       'nasarawa' => 'Nasarawa',
			                       'niger' => 'Niger',
			                       'ogun' => 'Ogun',
			                       'ondo' => 'Ondo',
			                       'osun' => 'Osun',
			                       'oyo' => 'Oyo',
			                       'plateau' => 'Plateau',
			                       'rivers' => 'Rivers',
			                       'sokoto' => 'Sokoto',
			                       'taraba' => 'Taraba',
			                       'yobe' => 'Yobe',
			                       'zamfara' => 'Zamfara',
			                       'fct' => 'FCT'  
			];  
 
  
  
  public $adminEmail = "aceluxurystore@yahoo.com";
  //public $adminEmail = "aquarius4tkud@yahoo.com";
  public $suEmail = "kudayisitobi@gmail.com";
  
  public $googleProductCategories = [
				              'bracelets' => "191",
							  'brooches' => "197",
							  'earrings' => "194",
							  'necklaces' => "196",
							  'rings' => "200",
							  'anklets' => "189",
							  'scarfs' => "177",
							  'Hair Accessories' => "171"
							  ];
	
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
		   
		   function getUsers($all=false)
           {
           	$ret = [];
              $users = User::where('id','>',"0")->get();
             
              if($users != null)
               {
				  foreach($users as $u)
				  {
					  $uu = $this->getUser($u->id,$all);
					  array_push($ret,$uu);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getUser($id,$all=false)
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
                       if($all)
					   {
						   $sd =  $this->getShippingDetails($u);
						   $temp['sd'] = count($sd) > 0 ? $sd[0] : $sd;
					   }					   
                       $temp['status'] = $u->status; 
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y h:i"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		    function getCarts()
           {
           	$ret = [];

			  $carts = Carts::where('id','>',"0")->get();
			  #dd($uu);
              if($carts != null)
               {
               	foreach($carts as $c) 
                    {
                    	$temp = [];
               	     $temp['id'] = $c->id; 
               	     $temp['user_id'] = $c->user_id; 
                        $temp['product'] = $this->getProduct($c->sku); 
                        $temp['qty'] = $c->qty; 
                        $temp['date'] = $c->created_at->format("jS F,Y h:i A"); 
                        array_push($ret, $temp); 
                   }
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
				  $temp['name'] = $product->name;
				  $temp['sku'] = $product->sku;
				  $temp['qty'] = $product->qty;
				  $temp['status'] = $product->status;
				  $temp['pd'] = $this->getProductData($product->sku);
				  $temp['discounts'] = $this->getDiscounts($product->sku);
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
		   
		   function getDiscounts($id,$type="product")
           {
           	$ret = [];
             if($type == "product")
			 {
				$discounts = Discounts::where('sku',$id)
			                 ->orWhere('type',"general")
							 ->where('status',"enabled")->get(); 
			 }
			 elseif($type == "user")
			 {
				 $discounts = Discounts::where('sku',$id)
			                 ->where('type',"user")
							 ->where('status',"enabled")->get();
             }
			 
              if($discounts != null)
               {
				  foreach($discounts as $d)
				  {
					$temp = [];
				    $temp['id'] = $d->id;
				    $temp['sku'] = $d->sku;
				    $temp['discount_type'] = $d->discount_type;
				    $temp['discount'] = $d->discount;
				    $temp['type'] = $d->type;
				    $temp['status'] = $d->status;
				    array_push($ret,$temp);  
				  }
               }                         
                                                      
                return $ret;
           }
		   
		     function getDiscountPrices($amount,$discounts)
		   {
			   $newAmount = 0;
						$dsc = [];
                     
					 if(count($discounts) > 0)
					 { 
						 foreach($discounts as $d)
						 {
							 $temp = 0;
							 $val = $d['discount'];
							 
							 switch($d['discount_type'])
							 {
								 case "percentage":
								   $temp = floor(($val / 100) * $amount);
								 break;
								 
								 case "flat":
								   $temp = $val;
								 break;
							 }
							 
							 array_push($dsc,$temp);
						 }
					 }
				   return $dsc;
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
		   
		   function deleteProduct($id,$def=false)
           {
           	$ret = [];
              $p = Products::where('id',$id)
			                 ->orWhere('sku',$id)->first();
              
			  //dd($data);
              if($p != null)
               {
				  $pis = ProductImages::where('sku',$id)->get();
				  
				  if($pis != null)
				  {
					foreach($pis as $pi) $pi->delete();  
				  }
				  
				  $pd = ProductData::where('sku',$id)->first();
				  
				  if($pd != null) $pd->delete();
				  
				  $p->delete();
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

		   function updateStock($s,$q)
		   {
			   $p = Products::where('sku',$s)->first();
			   
			   if($p != null)
			   {
				   $oldQty = ($p->qty == "" || $p->qty < 0) ? 0: $p->qty;
				   $qty = $p->qty - $q;
				   if($qty < 0) $qty = 0;
				   $p->update(['qty' => $qty]);
			   }
		   }
		   
		   function clearNewUserDiscount($u)
		   {
			  # dd($user);
			  if(!is_null($u))
			  {
			     $d = Discounts::where('sku',$u->id)
			                 ->where('type',"user")
							 ->where('discount',$this->newUserDiscount)->first();
			   
			     if(!is_null($d))
			     {
				   $d->delete();
			     }
			  }
		   }		   


            function addOrder($user,$data,$gid=null)
           {
			   $cart = [];
			   $gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";  
           	   $order = $this->createOrder($user, $data);
			   
                if($user == null && $gid != null) $cart = $this->getCart($user,$gid);
			 else $cart = $this->getCart($user);
			 #dd($cart);
			 
               #create order details
               foreach($cart as $c)
               {
				   $dt = [];
                   $dt['sku'] = $c['product']['sku'];
				   $dt['qty'] = $c['qty'];
				   $dt['order_id'] = $order->id;
				   $this->updateStock($dt['sku'],$dt['qty']);
                   $oi = $this->createOrderItems($dt);                    
               }

               #send transaction email to admin
               //$this->sendEmail("order",$order);  
               
			   
			   //clear cart
			   //$this->clearCart($user);
			   
			   //if new user, clear discount
			   $this->clearNewUserDiscount($user);
			   return $order;
           }

           function createOrder($user, $dt)
		   {
			   #dd($dt);
			   //$ref = $this->helpers->getRandomString(5);
			   $psref = isset($dt['ps_ref']) ? $dt['ps_ref'] : "";
			   
			   if(is_null($user))
			   {
				   $gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
				   $anon = AnonOrders::create(['email' => $dt['email'],
				                     'reference' => $dt['ref'],
				                     'name' => $dt['name'],
				                     'phone' => $dt['phone'],
				                     'address' => $dt['address'],
				                     'city' => $dt['city'],
				                     'state' => $dt['state'],
				             ]);
				   
				   $ret = Orders::create(['user_id' => "anon",
			                          'reference' => $dt['ref'],
			                          'ps_ref' => $psref,
			                          'amount' => $dt['amount'],
			                          'type' => $dt['type'],
			                          'payment_code' => $dt['payment_code'],
			                          'notes' => $dt['notes'],
			                          'status' => $dt['status'],
			                 ]); 
			   }
			   
			   else
			   {
				 $ret = Orders::create(['user_id' => $user->id,
			                          'reference' => $dt['ref'],
			                          'ps_ref' => $psref,
			                          'amount' => $dt['amount'],
			                          'type' => $dt['type'],
			                          'payment_code' => $dt['payment_code'],
			                          'notes' => $dt['notes'],
			                          'status' => $dt['status'],
			                 ]);   
			   }
			   
			  return $ret;
		   }

		   function createOrderItems($dt)
		   {
			   $ret = OrderItems::create(['order_id' => $dt['order_id'],
			                          'sku' => $dt['sku'],
			                          'qty' => $dt['qty']
			                 ]);
			  return $ret;
		   }
		   
		   function isSouthWestState($s)
		   {
			   $ret = false;
			   $sw = ["ekiti","lagos","ogun","ondo","osun","oyo"];
			   
			   foreach($sw as $sww)
			   {
				   if(strtolower($s) == $sww) $ret = true;
			   }
			   
			   return $ret;
		   }
		   
		    function getDeliveryFee($u=null,$type="user")
		   {
			    $s1 = Settings::where('name',"delivery1")->first();
			    $s2 = Settings::where('name',"delivery2")->first();
			   
			   $state = "";
			   
			   if($s1 == null || $s2 == null)
			   {
				   if($s1 == null) $delivery1 = 1000;
				   if($s2 == null) $delivery2 = 2000;
			   }
			   else
			   {
				   $delivery1 = $s1->value;
				   $delivery2 = $s2->value;
			   }
			   $ret = $delivery2;
			   
			   switch($type)
			   {
				 case "user":
				 if(!is_null($u))
			     {
				   $shipping = $this->getShippingDetails($u);
                   $s = $shipping[0];				  
                   $state = $s['state'];
			     }
                 break;

                 case "state":
				  $state = $u;
                 break;				 
			   }
			   
			   if($state != null && $state != "")
			   {
				 if($this->isSouthWestState($state)) $ret = $delivery1;   
			   }
			   
			    
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
                    	if(count($i['product']) > 0)
                        {
						  $amount = $i['product']['pd']['amount'];
						  $qty = $i['qty'];
                      	$ret['items'] += $qty;
						  $ret['subtotal'] += ($amount * $qty);
                       }	
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
            $items = [];
            
             # dd($o);
               if(count($o) > 0)
               {
               	$items = $o['items'];
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
				
				//update each product stock
				foreach($items as $i)
               {
               	if(count($i['product']) > 0)
                   {
                   	$sku = $i['product']['sku'];
				       $qty = $i['qty'];
				      $this->updateStock($sku,$qty);                   
                   }
                   
               }
               
				//$ret = $this->smtp;
				$ret = $this->getCurrentSender();
				$ret['order'] = $o;
				$ret['name'] = $o['user_id'] == "anon" ? $u['name'] : $u['fname'];
				$ret['subject'] = "Your payment for order ".$o['payment_code']." has been confirmed!";
		        $ret['phone'] = $u['phone'];
		        $ret['em'] = $u['email'];
		        $this->sendEmailSMTP($ret,"emails.confirm-payment");
				
				//$ret = $this->smtp;
				$ret = $this->getCurrentSender();
				$ret['order'] = $o;
				$ret['user'] = $u['email'];
				$ret['name'] = $o['user_id'] == "anon" ? $u['name'] : $u['fname']." ".$u['lname'];
				$ret['phone'] = $u['phone'];
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
					   
			  $a = AnonOrders::where('id',$id)
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
				if($a != null) $a->delete();
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
                        	$u = $order['anon'];
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
                         
                         //$ret = $this->smtp;
						 $ret = $this->getCurrentSender();
						 #dd($ret);
				         $ret['order'] = $order;
				        $ret['tracking'] = $this->deliveryStatuses[$action];
				       $ret['name'] = $order['user_id'] == "anon" ? $u['name'] : $u['fname']." ".$u['lname'];
		               $ret['subject'] = "New update for order #".$o->reference;
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
						$dt = [];
						
						if(isset($p->qty)) $dt['qty'] = $p->qty;
						if(isset($p->name) || isset($p->origName))
						{
							if(isset($p->name)) $dt['name'] = $p->name;
							else if(isset($p->origName)) $dt['name'] = $p->origName;
						}
						$product->update($dt);
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
                       #dd($o2);
                       if($o2 != null) $temp['order'] = $this->getOrder($id);
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
                         $temp['order'] = $this->getOrder($id);
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
		   
function getRandomString($length_of_string) 
           { 
  
              // String of all alphanumeric character 
              $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
              // Shufle the $str_result and returns substring of specified length 
              return substr(str_shuffle($str_result),0, $length_of_string); 
            } 
		   
		   function getPaymentCode($r=null)
		   {
			   $ret = "";
			   
			   if(is_null($r))
			   {
				   $ret = "ACE_".rand(1,99)."LX".rand(1,99);
			   }
			   else
			   {
				   $ret = "ACE_".$r;
			   }
			   return $ret;
		   }

    function computeTotals($items)
           {
			   //	items: "[{"ctr":0,"sku":"ACE6870LX226","qty":"5"},{"ctr":"1","sku":"ACE281LX516","qty":"4"}]",
           	$ret = 0;
			  
              if($items != null && count($items) > 0)
               {           	
               	foreach($items as $i) 
                    {
						$product = $this->getProduct($i->sku);
						$amount = $product['pd']['amount'];
						$discounts = $product['discounts'];
						#dd($discounts);
						$dsc = $this->getDiscountPrices($amount,$discounts);
						
						$newAmount = 0;
						if(count($dsc) > 0)
			            {
				          foreach($dsc as $d)
				          {
					        if($newAmount < 1)
					        {
						      $newAmount = $amount - $d;
					        }
					        else
					        {
						      $newAmount -= $d;
					        }
				          }
					      $amount = $newAmount;
			            }
						$qty = $i->qty;
                    	$ret += ($amount * $qty);
                       					
                    }
					
               }                                 
                   #dd($ret);                                  
                return $ret;
           }		   
		
	function bulkAddOrder($order)
	{
		$dt = [];
		/**
		order: 
				 {
					items: "[{"ctr":0,"sku":"ACE6870LX226","qty":"5"},{"ctr":"1","sku":"ACE281LX516","qty":"4"}]",
                    notes: "test notes",
                    user: "{"id":"anon","name":"Tobi Hay","email":"aquarius4tkud@yahoo.com","phone":"08079284917","address":"6 alfred rewane rd","city":"lokoja","state":"kogi"}" 
				 }
		**/
		$u = json_decode($order->user);
		$items = json_decode($order->items);
		$notes = $order->notes;
		
		$ref = $this->getRandomString(5);
		$dt['ref'] = $ref;
		$dt['amount'] = $this->computeTotals($items);
		$dt['notes'] = is_null($notes) ? "" : $notes;
		$dt['payment_code'] = $this->getPaymentCode($ref);
		$dt['type'] = "admin";
		$dt['status'] = "paid";
		
		if($u->id == "anon")
		{
			$dt['name'] = $u->name;
					$dt['email'] = $u->email;
					$dt['phone'] = $u->phone;
					$dt['address'] = $u->address;
					$dt['city'] = $u->city;
					$dt['state'] = $u->state;
			$uu = null;
		}
		else
		{
			//"{"id":"16","name":"Tobi Lay","email":"testing2@yahoo.com","state":"Lagos"}",
			$uu = $u;
			$uuu = $this->getUser($u->id);
			$sd = $this->getShippingDetails($u->id);
		}
		
		 $o = $this->createOrder($uu, $dt);
		 
		 #dd($oo);
		 #create order details
               foreach($items as $i)
               {
				   $dt = [];
                   $dt['sku'] = $i->sku;
				   $dt['qty'] = $i->qty;
				   $dt['order_id'] = $o->id;
				   $this->updateStock($i->sku,$i->qty);
                   $oi = $this->createOrderItems($dt);                    
               }
               $oo = $this->getOrder($o->reference);
			   
		/*******************************************************/
         //We have the user, update the status and notify the customer
				if(!is_null($o)) $o->update(['status' => 'paid']);
				//$ret = $this->smtp;
				$ret = $this->getCurrentSender();
				$ret['order'] = $oo;
				$ret['name'] = $u->name;
				$ret['subject'] = "Your payment for order ".$o->payment_code." has been confirmed!";
		        $ret['phone'] = $u->id == "anon" ? $u->phone : $uuu['phone'];
		        $ret['em'] = $u->email;
		        $this->sendEmailSMTP($ret,"emails.confirm-payment");
				
				//$ret = $this->smtp;
				$ret = $this->getCurrentSender();
				$ret['order'] = $oo;
				$ret['user'] = $u->email;
				$ret['name'] = $u->name;
				 $ret['phone'] = $u->id == "anon" ? $u->phone : $uuu['phone'];
		        $ret['subject'] = "URGENT: Received payment for order ".$o->payment_code;
		        $ret['shipping'] = $u->id == "anon" ? ['address' =>$u->address,'city' =>$u->city,'state' =>$u->state] : $sd[0];
		        $ret['em'] = $this->adminEmail;
		        $this->sendEmailSMTP($ret,"emails.bao-alert");
				$ret['em'] = $this->suEmail;
		        $this->sendEmailSMTP($ret,"emails.bao-alert");		
		/*******************************************************/ 
			   
			   
	     return $o;
	}
	
	function createSetting($data)
           {
			   #dd($data);
			 $ret = null;
			 
			 
				 $ret = Settings::create(['name' => $data['k'], 
                                                      'value' => $data['v'],                                                      
                                                      'status' => "enabled", 
                                                      ]);
			  return $ret;
           }
	
	function getSetting($id)
	{
		$temp = [];
		$s = Settings::where('id',$id)
		             ->orWhere('name',$id)->first();
 
              if($s != null)
               {
				      $temp['name'] = $s->name; 
                       $temp['value'] = $s->value;                  
                       $temp['id'] = $s->id; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $temp['updated'] = $s->updated_at->format("jS F, Y"); 
                   
               }      
       return $temp;            	   
   }
		
    function getSettings()
           {
           	$ret = [];
			  $settings = Settings::where('id','>',"0")->get();
 
              if($settings != null)
               {
				   foreach($settings as $s)
				   {
				      $temp = $this->getSetting($s->id);
                       array_push($ret,$temp); 
				   }
               }                         
                                                      
                return $ret;
           }
		   
	  function updateSetting($a,$b)
           {
			
				 $s = Settings::where('name',$a)
				              ->orWhere('id',$a)->first();
			 
			 
			 if(!is_null($s))
			 {
				 $s->update(['value' => $b]);
			  
			 }
           	
           }
		   
		function updateBank($data)
           {
			 $ret = $data->bname.",".$data->acname.",".$data->acnum;
				 $b = Settings::where('name',"bank")->first();
			 
			 
			 if(is_null($b))
			 {
				 Settings::create(['name' => "bank",'value' => $ret]);
				 
			  
			 }
			 else
			 {
				 $b->update(['value' => $ret]);
			 }
           	
           }
           
           
           function createSender($data)
           {
			   #dd($data);
			 $ret = null;
			 
			 
				 $ret = Senders::create(['ss' => $data['ss'], 
                                                      'type' => $data['type'], 
                                                      'sp' => $data['sp'], 
                                                      'sec' => $data['sec'], 
                                                      'sa' => $data['sa'], 
                                                      'su' => $data['su'], 
                                                      'current' => $data['current'], 
                                                      'spp' => $data['spp'], 
                                                      'sn' => $data['sn'], 
                                                      'se' => $data['se'], 
                                                      'status' => "enabled", 
                                                      ]);
			  return $ret;
           }

   function getSenders()
   {
	   $ret = [];
	   
	   $senders = Senders::where('id','>',"0")->get();
	   
	   if(!is_null($senders))
	   {
		   foreach($senders as $s)
		   {
		     $temp = $this->getSender($s->id);
		     array_push($ret,$temp);
	       }
	   }
	   
	   return $ret;
   }
   
   function getSender($id)
           {
           	$ret = [];
               $s = Senders::where('id',$id)->first();
 
              if($s != null)
               {
                   	$temp['ss'] = $s->ss; 
                       $temp['sp'] = $s->sp; 
                       $temp['se'] = $s->se;
                       $temp['sec'] = $s->sec; 
                       $temp['sa'] = $s->sa; 
                       $temp['su'] = $s->su; 
                       $temp['current'] = $s->current; 
                       $temp['spp'] = $s->spp; 
					   $temp['type'] = $s->type;
                       $sn = $s->sn;
                       $temp['sn'] = $sn;
                        $snn = explode(" ",$sn);					   
                       $temp['snf'] = $snn[0]; 
                       $temp['snl'] = count($snn) > 0 ? $snn[1] : ""; 
					   
                       $temp['status'] = $s->status; 
                       $temp['id'] = $s->id; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		  function updateSender($data,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			 if($user == null)
			 {
				 $s = Senders::where('id',$data['xf'])->first();
			 }
			 else
			 {
				$s = Senders::where('id',$data['xf'])
			             ->where('user_id',$user->id)->first(); 
			 }
			 
			 
			 if(!is_null($s))
			 {
				 $s->update(['ss' => $data['ss'], 
                                                      'type' => $data['type'], 
                                                      'sp' => $data['sp'], 
                                                      'sec' => $data['sec'], 
                                                      'sa' => $data['sa'], 
                                                      'su' => $data['su'], 
                                                      'spp' => $data['spp'], 
                                                      'sn' => $data['sn'], 
                                                      'se' => $data['se'], 
                                                      'status' => "enabled", 
                                                      ]);
			   $ret = "ok";
			 }
           	
                                                      
                return $ret;
           }

		   function removeSender($xf,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			 if($user == null)
			 {
				 $s = Senders::where('id',$xf)->first();
			 }
			 else
			 {
				$s = Senders::where('id',$xf)
			             ->where('user_id',$user->id)->first(); 
			 }
			 
			 
			 if(!is_null($s))
			 {
				 $s->delete();
			   $ret = "ok";
			 }
           
           }
		   
		   function setAsCurrentSender($id)
		   {
			   $s = Senders::where('id',$id)->first();
			   
			   if($s != null)
			   {
				   $prev = Senders::where('current',"yes")->first();
				   if($prev != null) $prev->update(['current' => "no"]);
				   $s->update(['current' => "yes"]);
			   }
		   }
		   
		   function getCurrentSender()
		   {
			   $ret = [];
			   $s = Senders::where('current',"yes")->first();
			   
			   if($s != null)
			   {
				   $ret = $this->getSender($s['id']);
			   }
			   
			   return $ret;
		   }
		   
		   function getCurrentBank()
		   {
			   $ret = [];
			   $s = Settings::where('name',"bank")->first();
			   
			   if($s != null)
			   {
				   $val = explode(',',$s->value);
				   $ret = [
				     'bname' => $val[0],
					 'acname' => $val[1],
					 'acnum' => $val[2]
				   ];
			   }
			   
			   return $ret;
		   }
		   
		   
		 function createPlugin($data)
           {
			   #dd($data);
			 $ret = null;
			 
			 
				 $ret = Plugins::create(['name' => $data['name'], 
                                                      'value' => $data['value'], 
                                                      'status' => $data['status'], 
                                                      ]);
			  return $ret;
           }

   function getPlugins()
   {
	   $ret = [];
	   
	   $plugins = Plugins::where('id','>',"0")->get();
	   
	   if(!is_null($plugins))
	   {
		   foreach($plugins as $p)
		   {
		     $temp = $this->getPlugin($p->id);
		     array_push($ret,$temp);
	       }
	   }
	   
	   return $ret;
   }
   
   function getPlugin($id)
           {
           	$ret = [];
               $p = Plugins::where('id',$id)->first();
 
              if($p != null)
               {
                   	$temp['name'] = $p->name; 
                       $temp['value'] = $p->value; 	   
                       $temp['status'] = $p->status; 
                       $temp['id'] = $p->id; 
                       $temp['date'] = $p->created_at->format("jS F, Y"); 
                       $temp['updated'] = $p->updated_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		  function updatePlugin($data,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			  $p = Plugins::where('id',$data['xf'])->first();
			 
			 
			 if(!is_null($p))
			 {
				 $p->update(['name' => $data['name'], 
                                                      'value' => $data['value'], 
                                                      'status' => $data['status']
                                                      ]);
			   $ret = "ok";
			 }
           	
                                                      
                return $ret;
           }

		   function removePlugin($xf,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			 $p = Plugins::where('id',$xf)->first();

			 
			 if(!is_null($p))
			 {
				 $p->delete();
			   $ret = "ok";
			 }
           
           }
           
           
           function getAnalytics($dt)
           {
			$ret = [];
			//$days = $dt['days'];
			
			try
			{
				if($dt['period'] == "days") $period = Period::days($dt['num']);
				else if($dt['period'] == "months") $period = Period::months($dt['num']);
				
				switch($dt['type'])
				{
					case "most-visited-pages":
					  //fetch most visited pages for
         			  $ret = Analytics::fetchMostVisitedPages($period);
					break;
				}
            //retrieve visitors and pageview data for the current day and the last seven days
            //$ret = Analytics::fetchVisitorsAndPageViews(Period::days(7));
             
			
            }
			catch(Exception $e)
			{
				$ret = ['status' => "error"];
			}
		   finally
		   {
			   return $ret;
		   }
           }
		   
		   
		   function fetchAnalytics($dt)
		   {
			   $data = json_decode($dt);
			   $ret = ['status' => "error",'message' => "type not set"];
			   
			   if(isset($data->type))
			   {
				 $ret = $this->getAnalytics([
				                    'type' => $data->type,
				                    'period' => $data->period,
				                    'num' => $data->num
									]);
			   }
			   return $ret;
		   }
		   
		    function createCatalog($data)
           {
			   #dd($data);
			 $ret = null;
			 
			 
				 $ret = Catalogs::create(['sku' => $data['sku'],
                                                      'status' => $data['status'], 
                                                      ]);
			  return $ret;
           }

   function getCatalogs()
   {
	   $ret = [];
	   
	   $catalogs = Catalogs::where('id','>',"0")->get();
	   
	   if(!is_null($catalogs))
	   {
		   foreach($catalogs as $c)
		   {
		     $temp = $this->getCatalog($c->id);
		     array_push($ret,$temp);
	       }
	   }
	   
	   return $ret;
   }
   
   function getCatalog($id)
           {
           	$ret = [];
               $c = Catalogs::where('id',$id)->first();
 
              if($c != null)
               {
                   	$temp['sku'] = $c->sku;  
                       $temp['status'] = $c->status; 
                       $temp['id'] = $c->id; 
                       $temp['date'] = $c->created_at->format("jS F, Y"); 
                       $temp['updated'] = $c->updated_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		   
		  function updateCatalog($data,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			  $c = Catalogs::where('id',$data['xf'])->first();
			 
			 
			 if(!is_null($c))
			 {
				 /**
				 $c->update(['name' => $data['name'], 
                                                      'value' => $data['value'], 
                                                      'status' => $data['status']
                                                      ]);
			     **/
				 $c->touch();
			   $ret = "ok";
			 }
           	
                                                      
                return $ret;
           }

		   function removeCatalog($xf,$user=null)
           {
			   #dd($data);
			 $ret = "error";
			 $c = Catalogs::where('id',$xf)
			              ->orWhere('sku',$xf)->first();

			 
			 if(!is_null($c))
			 {
				 $c->delete();
			   $ret = "ok";
			 }
           
           }
		   
		   
		   function addToFBCatalog($dt,$tk)
		   {
			   $products = json_decode($dt);
			   #dd($products);
			   
			   foreach($products as $p)
			   {
		        $pu = "www.aceluxurystore.com/product";
		        $product = $this->getProduct($p);
		        $iss = ['in_stock' => "in stock",'out_of_stock' => "out of stock",'new' => "available for order"];
		        $pd = $product['pd'];
			    $description = $pd['description'];
			    $category = $pd['category'];
			    $in_stock = $pd['in_stock'];
			    $amount = $pd['amount'] * 100;
			    $imggs = $product['imggs'];
				$cid = env('FACEBOOK_CATALOG_ID');
		        $url = "https://graph.facebook.com/v8.0/".$cid."/batch";
		        $dt = [
		           'access_token' => $tk,
		           'requests' => [
		               [
		                  'method' => "CREATE",
			              'retailer_id' => $product['sku'],
			              'data' => [
			                'availability' => "in stock",
			                'brand' => "Ace Luxury Store",
			                'category' => $this->googleProductCategories[$category],
			                'description' => $description,
			                'image_url' => $imggs[0],
			                'price' => $amount,
			                'name' => $product['name'],
			                'currency' => "NGN",
			                'condition' => "new",
			                'url' => $pu."?sku=".$product['sku'] 
			              ]
			           ]
		          ]
		       ];
		       $data = [
		        'type' => "json",
		        'data' => $dt
		       ];
		       $ret = $this->callAPI($url,"POST",$data);
				   //$this->createCatalog(['sku' => $p->sku,'status' => "enabled"]);
			   }
			   
			   return true;
		   }
		   
		   function removeFromFBCatalog($dt,$tk)
		   {
			   $products = json_decode($dt);
			   #dd($products);
			   
			   foreach($products as $p)
			   {
				   $this->removeCatalog($p->sku);
			   }
			   
			   return true;
		   }
		   
		    function callAPI($url,$method,$params) 
           {
           	
              # $lead = $data['em'];
			   
		   if($params == null || count($params) < 1)
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid data"]);
			   }
			   else
			    { 
                  $dt = $params['data'];
			      #dd(json_encode($dt));
				  $guzzleData = [];
				  
				  switch($params['type'])
				  {
					 case "json":
					   $guzzleData = [
				        'json' => $dt
				       ];
                     break;					 
				  }
				  
				  
			
			     $client = new Client();
			     $res = $client->request('POST', $url, $guzzleData);
			  
                 $ret = $res->getBody()->getContents(); 
			     dd($ret);
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
		   
           
}
?>