<?php
namespace App\Libraries;

class Query{
    public static function open($query, $searchfield = null, $counter = true, $xlimit=false) {
        $request = app('request');
        $search  = $request->input('query') ? $request->input('query') : ($request->input('q') ? $request->input('q') : null);
        $sort    = $request->input('sort');
        $dir     = $request->input('dir');
        $start   = $request->input('start');
        $limit   = $request->input('limit');

        if($searchfield && count($searchfield)){
            if($search){
                $query->where(function($query) use ($search, $searchfield){
                    foreach ($searchfield as $field) {
                        if($field == 'id') {
                            $query->orWhere($field, $search);
                        }
                        else $query->orWhere($field, 'LIKE', '%'.$search.'%');
                    }
                });
            }
        }

        if($sort && $dir) $query->orderBy($sort, $dir);
        else if($sort) $query->orderBy($sort);

        if($counter) {
            $count = $query->count();

            if ($start) $query->skip($start);
            if ($limit) $query->take($limit)->get();

            return ['count' => $count, 'data' => $query->get()];
        }
        else if($xlimit) $query->take($xlimit)->get();

        return $query->get();
    }

}
