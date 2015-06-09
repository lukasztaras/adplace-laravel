<?php namespace App\Http\Controllers;

use Request;
use App\Adverts;
use App\User;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            $adverts = array();
            
            if (Request::method() == 'POST') 
            {
                $keyword = Request::all()['name'];
                
                $adverts = DB::table('adverts')
                    ->where('title', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('color', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('city', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('hashtag', 'LIKE', '%'.$keyword.'%')
                    ->get();
            }
            
            return view('welcome', array(
                'adverts' => $adverts
            ));
	}
        
        /**
	 * Show requested item
	 *
	 * @return Response
	 */
	public function item($var)
	{
            $var = explode("_", $var);
            
            if (empty($var) || !is_numeric($var[0]))
            {
                return redirect()->back();
            }
            
            $advert = Adverts::find($var[0]);
            
            if ($advert == null) {
                return redirect()->back();
            }
            
            $seller = User::find($advert->user_id);
            
            return view('item', array(
                'advert' => $advert,
                'seller' => $seller
            ));
	}

}
