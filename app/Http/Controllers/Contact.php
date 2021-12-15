<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact as Request;
use App\Jobs\sendMail;
use App\Models\Contact as Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request as HttpRequest;

class Contact extends Controller
{
    public function index()
    {
        try{
            return ['success' => true, 'contacts' => Model::paginate(8)];
        }catch(QueryException $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    public function store(Request $request)
    {
        try{
            Model::create($request->validated());
            dispatch(new sendMail($request->email, $request->name));
            return ['success' => true, 'message' => 'Contact added successfully'];
        }catch(QueryException $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        try{
            Model::where('id', $id)->delete();
            return ['success' => true, 'message' => 'Contact deleted successfully'];
        }catch(QueryException $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    public function search(HttpRequest $request)
    {
        try{
            $query = $request['query'];
            $results = Model::where('name', 'LIKE', "%".$query ."%")->orWhere('email', 'LIKE',  "%".$query ."%")->paginate(8);
            return ['success' => true , 'contacts' => $results];
        }catch(QueryException $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }

    public function filter($gender)
    {
        try{
            if($gender === 'all') {
                $response = ['success' => true, 'contacts' => Model::paginate(8)];
            }else {
                $response = ['success'=> true, 'contacts' => Model::where('gender', $gender)->paginate(8)];
            }
            return $response;
        }catch(QueryException $exception) {
            return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}
