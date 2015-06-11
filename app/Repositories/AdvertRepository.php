<?php

namespace App\Repositories;

use App\Adverts;

class AdvertRepository implements RepositoryInterface {
    
    public function getAll() {
        return Adverts::all();
    }
    
    public function getById($id) {
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
            'user_id'       => $this->userRepository->getAuthenticatedUser()->id,
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
    
}