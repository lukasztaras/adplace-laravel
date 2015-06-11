<?php

namespace App\Repositories;

use App\Adverts;
use Illuminate\Support\Facades\DB;

class AdvertRepository implements RepositoryInterface {
    
    public function getAll() 
    {
        return Adverts::all();
    }
    
    public function getById($id) 
    {
        return Adverts::find($id);
    }
    
    public function createAdvert($request, $userId)
    {
        $dateToday = new \DateTime();
        $nextWeek = new \DateTime();
        $nextWeek->add(new \DateInterval('P1W'));
        
        $advert = Adverts::create(array(
            'title'         => $request['name'],
            'description'   => $request['desc'],
            'added'         => $dateToday,
            'expires'       => $nextWeek,
            'user_id'       => $userId,
            'city'          => $request['city'],
            'color'         => $request['color'],
            'hashtag'       => $request['hash']
        ));

        $advert->save();
    }
    
    public function updateAdvert($request, $advert)
    {
        
        $advert->title = $request['name'];
        $advert->description = $request['desc'];
        $advert->color = $request['city'];
        $advert->city = $request['color'];
        $advert->hashtag = $request['hash'];

        $advert->save();
    }
    
    public function deleteAdvert(Adverts $advert)
    {
        $advert->delete();
    }
    
    public function searchForAdvert($keyword)
    {
        return $adverts = DB::table('adverts')
                    ->where('title', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('description', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('color', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('city', 'LIKE', '%'.$keyword.'%')
                    ->orWhere('hashtag', 'LIKE', '%'.$keyword.'%')
                    ->get();
    }

}