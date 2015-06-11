<?php

namespace App\Repositories;

use App\Tags;

class TagRepository implements RepositoryInterface {
    
    public function getAll() {
        return Tags::all();
    }
    
    public function getById($id) {
        return Tags::find($id);
    }
    
    public function disableAllTags()
    {
        Tags::where('enabled', 1)->update(array('enabled' => 0));
    }
    
    public function enableTagById($id)
    {
        Tags::where('id', $id)->update(array('enabled' => 1));
    }
    
}