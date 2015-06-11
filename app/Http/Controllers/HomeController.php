<?php 

namespace App\Http\Controllers;

use Auth;
use Request;
use Validator;
use Input;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Adverts;
use App\Tags;
use App\Repositories\UserRepository;
use App\Repositories\TagRepository;
use App\Repositories\AdvertRepository;

class HomeController extends Controller {

	protected $userRepository;
        protected $tagRepository;
        protected $advertRepository;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(UserRepository $_userRepository, TagRepository $_tagRepository, AdvertRepository $_advertRepository)
	{
            $this->middleware('auth');
            $this->userRepository = $_userRepository;
            $this->tagRepository = $_tagRepository;
            $this->advertRepository = $_advertRepository;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{           
            return view('home/home');
	}
        
        /**
	 * Form to add new Advertisement
	 *
	 * @return Response
	 */
	public function newAd()
	{
            // we need to get list of Tags so
            $tags = $this->tagRepository->getAll();
            
            $enabledTags = array();
            foreach ($tags as $tag)
            {
                $enabledTags[$tag->name] = $tag->enabled;
            }
            
            return view('home/add', array(
                'tags' => $enabledTags
            ));
	}
        
        /**
	 * Process request of adding new advertisement
	 *
	 * @return Response
	 */
	public function newAdPost(Request $request)
	{
            $validator = Validator::make($request::all(),[
                'name' => 'required',
                'desc' => 'required'
            ]);
            
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator->errors());
            }
            
            $request = $request::all();
            
            if (!isset($request['city']))
                $request['city'] = 'undefined';
            
            if (!isset($request['color']))
                $request['color'] = 'undefined';
            
            if (!isset($request['hash']))
                $request['hash'] = 'undefined';
            
            $this->advertRepository->createAdvert($request, $this->userRepository->getAuthenticatedUser()->id);
            
            return redirect()->back()->withErrors(array('Advertisement successfully added'));
	}
        
        /**
	 * List of advertisements
	 *
	 * @return Response
	 */
	public function ads()
	{
            // we need to get list of Tags so
            $ads = $this->advertRepository->getAll()->where('user_id', $this->userRepository->getAuthenticatedUser()->id);
            
            return view('home/list', array(
                'ads' => $ads
            ));
	}
        
        /**
	 * Delete requested Ad
	 *
	 * @return Response
	 */
	public function adsDelete($id)
	{
            $advert = $this->advertRepository->getById($id);
            
            if (empty($var) || !is_numeric($var) || $advert == null)
            {
                return Redirect::route('home/ads')->withErrors(array('Incorrect Advertisement Id'));
            }
            
            // does it belong to user that requested removal?
            if ($advert->user_id != $this->userRepository->getAuthenticatedUser()->id)
            {
                return Redirect::route('home/ads')->withErrors(array('Ahh you naughty boy!. Behave properly ;-)'));
            }
            
            $this->advertRepository->deleteAdvert($advert);
            // we need to get list of Adverts so
            $ads = $this->advertRepository->getAll()->where('user_id', $this->userRepository->getAuthenticatedUser()->id);

            return view('home/list', array(
                'ads' => $ads
            ));
	}
        
        /**
	 * Edit requested Ad
	 *
	 * @return Response
	 */
	public function adsEdit($id)
	{
            $advert = $advert = $this->advertRepository->getById($id);
            
            if (empty($var) || !is_numeric($var) || $advert == null)
            {
                return Redirect::route('home/ads')->withErrors(array('Incorrect Advertisement Id'));
            }
            
            // does it belong to user that requested removal?
            if ($advert->user_id != $this->userRepository->getAuthenticatedUser()->id)
            {
                return Redirect::route('home/ads')->withErrors(array('Ahh you naughty boy!. Behave properly ;-)'));
            }
            
            // we need to get list of Tags so
            $tags = $this->tagRepository->getAll();
            
            $enabledTags = array();
            foreach ($tags as $tag)
            {
                $enabledTags[$tag->name] = $tag->enabled;
            }
            
            return view('home/edit', array(
                'tags' => $enabledTags,
                'ad' => $advert
            ));
	}
        
        /**
	 * Process request of editing existing advertisement
	 *
	 * @return Response
	 */
	public function adsEditPost(Request $request)
	{
            $validator = Validator::make($request::all(),[
                'name' => 'required',
                'desc' => 'required'
            ]);
            
            if ($validator->fails())
            {
                return redirect()->back()->withErrors($validator->errors());
            }
            
            // validator passed, let's add that ad and display success message
            $request = $request::all();
            $advert = $this->advertRepository->getById($request['adId']);
            
            if ($advert == null || $advert->user_id != $this->userRepository->getAuthenticatedUser()->id)
            {
                return Redirect::route('home/ads')->withErrors(array('Ahh you naughty boy!. Behave properly ;-)'));
            }
            
            $this->advertRepository->updateAdvert($request, $advert);
            
            return redirect()->back()->withErrors(array('Advertisement successfully modified'));
	}

}
