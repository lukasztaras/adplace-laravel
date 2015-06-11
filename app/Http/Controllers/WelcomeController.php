<?php namespace App\Http\Controllers;

use Request;
use App\Adverts;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\AdvertRepository;
use App\Repositories\UserRepository;

class WelcomeController extends Controller {

	protected $advertRepository;
        protected $userRepository;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(AdvertRepository $_advertRepository, UserRepository $_userRepository)
	{
            $this->advertRepository = $_advertRepository;
            $this->userRepository = $_userRepository;
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
                $adverts = $this->advertRepository->searchForAdvert($keyword);
            }
            else {
                $adverts = $this->advertRepository->getAll()->sortBy('added');
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
            
            $advert = $this->advertRepository->getById($var[0]);
            
            if ($advert == null) {
                return redirect()->back();
            }
            
            $seller = $this->userRepository->getById($advert->user_id);
            
            return view('item', array(
                'advert' => $advert,
                'seller' => $seller
            ));
	}

}
