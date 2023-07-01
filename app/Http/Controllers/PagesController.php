<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function main_page()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;
        return view('project_admin_pages.buildings2.buildings_map',
            ['user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email
            ]);
    }

    public function buildings_table_page()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;

        $buildings_query = DB::table('buildings')
            ->select('buildings.id','building_no','street_no','floors_count','latitude','longitude',
                'citizen_name')
//             ->where('citizen_name','like','%محمد%')
//            ->where('buildings.street_no','=',1630)
//            ->where('floors_count','>',2)
            ->get();

        return view('project_admin_pages.buildings.buildings_table_page',
            ['user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'buildings_query'=>$buildings_query
            ]);
    }


    public function resident_main_page()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;
        return view('project_admin_pages.resident.buildings_map',
            ['user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email
            ]);
    }

    public function resident_buildings_table_page()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;

        $buildings_query = DB::table('citizens')

            ->select('id','building_id','resident_name','citizen_status','floor')
//             ->where('citizen_name','like','%محمد%')
//            ->where('buildings.street_no','=',1630)
//            ->where('floors_count','>',2)
            ->get();

        return view('project_admin_pages.resident.buildings_table_page',
            ['user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'buildings_query'=>$buildings_query
            ]);
    }


    public function owner_resident_buildings_table_page()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;
        $user_email = Auth::user()->email;

        $buildings_query = DB::table('buildings')
            ->join('citizens','citizens.building_id','buildings.id')
            ->select('buildings.id','building_no','street_no','floors_count','latitude','longitude',
                'citizen_name','resident_name','citizen_status','floor')

            //             ->where('citizen_name','like','%محمد%')
//            ->where('buildings.street_no','=',1630)
//            ->where('floors_count','>',2)
            ->get();

        return view('project_admin_pages.owner_resident.buildings_table_page',
            ['user_id'=>$user_id,
                'user_name'=>$user_name,
                'user_email'=>$user_email,
                'buildings_query'=>$buildings_query
            ]);
    }



    public function building_details(){

    }


    public function buildings_page()
    {}





    public function building_citizens()
    {

    }


    public function buildings_map(){

    }

}
