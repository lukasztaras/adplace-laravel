<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Request as MyRequest;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\UserRepository;
use App\Repositories\TagRepository;
use App\Repositories\AdvertRepository;

class AdminController extends Controller {

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
            
            if ($this->userRepository->getAuthenticatedUser() === null || $this->userRepository->getAuthenticatedUser()->inRole('administrator') === false)
            {
                return Redirect::to('/')->send();
            }
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            return view('admin/admin');
	}
        
        /**
	 * Show all available tags
	 *
	 * @return Response
	 */
	public function tags()
	{
            $tags = $this->tagRepository->getAll();
            
            return view('admin/tags', array(
                'tags' => $tags
            ));
	}
        
        /**
	 * Process Request of editing tags
	 *
	 * @return Response
	 */
	public function tagsPost()
	{
            $this->tagRepository->disableAllTags();
            
            // let's get all tags we want to set to enabled
            $tags = MyRequest::all();
            foreach($tags as $id => $tag) 
            {
                $this->tagRepository->enableTagById($id);
            }
            
            return Redirect::to('admin/tags')->send();
	}
        
        /**
	 * Show all available users
	 *
	 * @return Response
	 */
	public function users()
	{
            $users = $this->userRepository->getAll();
            
            return view('admin/users', array(
                'users' => $users
            ));
	}
        
        /**
	 * Process request of editing users
	 *
	 * @return Response
	 */
	public function usersPost()
	{
            $this->userRepository->disableAllUsers();
            
            // let's get all tags we want to set to enabled
            $users = MyRequest::all();

            foreach($users as $id => $user) 
            {
                $this->userRepository->enableUserById($id);
            }
            
            return Redirect::to('admin/users')->send();
	}
        
        /**
	 * List of all advertisements
	 *
	 * @return Response
	 */
	public function adverts()
	{
            $adverts = $this->advertRepository->getAll();
            
            return view('admin/adverts', array(
                'ads' => $adverts
            ));
	}
        
        /**
	 * Delete advertisement
	 *
	 * @return Response
	 */
	public function advertsDelete($id)
	{
            $advert = $this->advertRepository->getById($id);
            
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            $this->advertRepository->deleteAdvert($advert);
            
            return redirect()->back()->withErrors(array('Advertisement successfully deleted'));
	}
        
        /**
	 * Edit existing advertisement
	 *
	 * @return Response
	 */
	public function advertsEdit($id)
	{
            $advert = $this->advertRepository->getById($id);
            
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            return view('admin/adverts/edit', array(
                'ad' => $advert
            ));
	}
        
        /**
	 * Process request of editing advertisement
	 *
	 * @return Response
	 */
	public function advertsEditPost(MyRequest $request)
	{
            $request = $request::all();
            $advert = $advert = $this->advertRepository->getById($request['adId']);
            
            if ($advert == null)
            {
                return redirect()->back()->withErrors(array('Incorrect Advertisement Id'));
            }
            
            $this->advertRepository->updateAdvert($request, $advert);
            
            return redirect()->back()->withErrors(array('Advertisement successfully modified'));
	}

}
