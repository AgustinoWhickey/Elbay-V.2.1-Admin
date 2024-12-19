<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;

use Session;

class CategoryController extends Controller
{
    public function index()
    {
        $userData = json_decode(api_data_get($_ENV['API_URL'].'/category?email='.Session::get('data')['email'].'&X-API-KEY=restapi123'));
        $categories = array();


        if($userData){
            $categories = $userData->data->categories;
        }

        return view('admin/category/index', [
            'title' => 'Kelola Category',
            'slug' => 'kelola_category',
            'categories' => $userData->data->categories,
        ]);
    }

    public function show($slug)
    {
        return view('post', [
            'title' => 'Artikel',
            'post' => Post::find($slug)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StorePostRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'X-API-KEY' => 'restapi123'
        ];

        if($request->id) {
            $data["category_id"] = $request->id;
            api_data_put($_ENV['API_URL']."/category", $data);
        } else {
            api_data_post($_ENV['API_URL']."/category", $data);
        }   

    }

    public function edit($categoryid)
    {
        $getData = json_decode(api_data_get($_ENV['API_URL'].'/category?email='.Session::get('data')['email'].'&id='.$categoryid.'&X-API-KEY=restapi123'));
		$data = (array) $getData->data->category;

		echo json_encode($getData);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy($categoryid)
    {
        $data = [
			'X-API-KEY' => 'restapi123',
			'id' => (int)$categoryid,
		];
	
		api_data_delete($_ENV['API_URL']."/category", $data);
    }
}
