<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class ApiPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $people_query = new Person();
        $people_query = $people_query->AcceptRequest(Person::$accepted_filters)->filter();
        $people_query = $people_query->sortable(['updated_at' => 'desc']);

        $people = $people_query->paginate(10);
        $people->withQueryString();

        return response()->json($people, 200, array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
