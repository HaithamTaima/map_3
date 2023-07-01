<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Citizens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuildindingController extends Controller
{


    public function add_building(Request $request){
        $building = new Building();


        $building->building_no = $request->input( 'building_no');
        $building->street_no = $request->input('street_no');
        $building->citizen_name =  $request->input('citizen_name');
        $building->citizen_id = $request->input('citizen_id');
        $building->floors_count =  $request->input('floors_count');

        $building-> latitude=  $request->input('point_latitude');
        $building->longitude =  $request->input('point_longitude');

        $building->save();
        return redirect('buildings_table_page');

    }

    public function add_new_citizen(Request $request){
        $citizen = new Citizens();


        $citizen->building_id = $request->input( 'building_id');
        $citizen->resident_name =  $request->input('resident_name');
        $citizen->citizen_status = $request->input('citizen_status');
        $citizen->floor =  $request->input('floor');




        $citizen->save();
        return redirect('resident_buildings_table_page');


    }

    public function delete_one_building(Request $request){
        DB::table('buildings')
            ->where('id',$request->input('building_id'))
            ->delete();
        return  'delete success';

    }

    public function edit_one_building(Request $request){
        DB::table('buildings')
            ->where('id',$request->input('building_id'))
            ->update([
                'building_no'=>$request->input('building_no'),
                'street_no'=>$request->input('street_no'),
                'citizen_name'=>$request->input('citizen_name'),
                'citizen_id'=>$request->input('citizen_id'),
                'floors_count'=>$request->input('floors_count'),
            ]);
        return  'update success';

    }

    public function delete_one_resident(Request $request){
        DB::table('citizens')
            ->where('id',$request->input('citizen_id'))
            ->delete();
        return  'delete success';

    }

    public function edit_one_resident(Request $request){
        DB::table('citizens')
            ->where('id',$request->input('citizen_id'))
            ->update([
                'resident_name'=>$request->input('resident_name'),
                'building_id'=>$request->input('building_id'),
                'citizen_status'=>$request->input('citizen_status'),
                'floor'=>$request->input('floor'),
            ]);
        return  'update success';
    }



}
