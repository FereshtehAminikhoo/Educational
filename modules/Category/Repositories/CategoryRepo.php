<?php

namespace Category\Repositories;

use Category\Models\Category;

class CategoryRepo
{
    public function all()
    {
        return Category::all();
    }

    public function create($request)
    {
        return Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
    }

    public function findById($id)
    {
        return Category::findOrFail($id);
    }

    public function allExceptById($id)
    {
       return $this->all()->filter(function($item) use($id){
           return $item->id != $id;
       });
    }

    public function update($id, $request)
    {
        Category::where('id', $id)->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
    }
}
