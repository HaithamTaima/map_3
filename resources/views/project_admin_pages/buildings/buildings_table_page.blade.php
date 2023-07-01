@extends('project_layouts.skeleton')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #ffffff;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>

@endsection
@section('page_content')

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"> Map</div>
                <div class="card-body">
                    <div id="map" style="height: 443px;"></div>
                </div>
            </div>

            <div class="card" id="building_form" style="display: none">
                <div class="card-header">Building Form</div>
                <div class="card-body">
                    <form  >

                        <div class="col-md-7">
                            <input id="building_id" name="building_id" type="hidden" class="form-control" placeholder="">
                        </div>

                        <div class="col-md-7">
                            <input id="point_longitude" name="point_longitude" type="hidden" class="form-control" placeholder="">
                        </div>

                        <label for="building_no" class="form-label" >Building no</label>
                        <div class="col-md-7">
                            <input id="building_no" name="building_no" type="text" class="form-control" placeholder="">
                        </div>

                        <label for="street_no" class="form-label" >Street</label>
                        <div class="col-md-7">
                            <input id="street_no" name="street_no" type="text" class="form-control" placeholder="">
                        </div>

                        <label for="citizen_name" class="form-label" >Citizen Name</label>
                        <div class="col-md-7">
                            <input id="citizen_name" name="citizen_name" type="text" class="form-control" placeholder=" ">
                        </div>

                        <label for="citizen_id" class="form-label" >Citizen Id</label>
                        <div class="col-md-7">
                            <input id="citizen_id" name="citizen_id" type="text" class="form-control" placeholder="123456789" pattern="{0-9} {9}">
                        </div>

                        <label for="floors_count" class="form-label" >Floors Count</label>
                        <div class="col-md-7">
                            <select id="floors_count" name="floors_count" class="form-select" aria-label="Default select example">
                                <option value="1">1 Floors</option>
                                <option value="2">2 Floors</option>
                                <option value="3">3 Floors</option>
                                <option value="4">4 Floors</option>
                                <option value="5">5 Floors</option>
                            </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-warning" onclick="edit_building_form()">Edit Button</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Building Table</div>
                <div class="card-body">
                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th  scope="col">Id</th>
                                <th  scope="col">Building</th>
                                <th  scope="col">Street</th>
                                <th  scope="col">Owner</th>
                                <th  scope="col">Floors</th>

                                <th  scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($buildings_query as $buildings)
                        <tr>
                            <td>{{$buildings->id}}</td>
                                <td>{{$buildings->building_no}}</td>
                                <td>{{$buildings->street_no}}</td>
                                <td>{{$buildings->citizen_name}}</td>
                                <td>{{$buildings->floors_count}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" onclick="edit_building('{{$buildings->id}}')">Edit</button>
                                    <button type="button" class="btn btn-danger" onclick="delete_building('{{$buildings->id}}')">Delete</button>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>




                </div>
            </div>

        </div>



    </div>

@endsection

@section('page_scripts')
    <script>


        const map =L.map('map',
            {
                center:[31.3547,34.3088],
                zoom:10
            })
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);





    </script>
@endsection

@push('javascript')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>

    <script>

        const map =L.map('map',
            {
                center:[31.3547,34.3088],
                zoom:10
            })
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        var buildings = @json ($buildings_query);
        console.log('buidlings: '+buildings);
        buildings.forEach(element=> {
            console.log('row: '+element.id);
            console.log('row: '+element.citizen_name );
            console.log('row: '+element.latitude);
            console.log('row: '+element.longitude);

             L.marker([element.latitude,element.longitude])
                 .addTo(map)
                 .bindPopup(element.building_no+' - '+element.citizen_name)
                 .openPopup()   ;
        });


    </script>

    <script>
        function edit_building(building_id){
            console.log('edit'+building_id);
            document.getElementById('building_id').value=building_id;
            document.getElementById('building_form').style.display="block";

        }
        function delete_building(building_id){
            var parms={
                'building_id': building_id
            }
            $.ajax({
                type:'get',
                url:'http://map_2.test/buildings/delete_one_building',
                data:parms,
                success:function(response) {
                    console.log('delete'+response);

                }
            });

        }

        function edit_building_form() {
            var building_id=document.getElementById('building_id').value;
            var building_no=document.getElementById('building_no').value;
            var street_no=document.getElementById('street_no').value;
            var citizen_name=document.getElementById('citizen_name').value;
            var citizen_id=document.getElementById('citizen_id').value;
            var floors_count=document.getElementById('floors_count').value;

            var parms={
            'building_id':building_id,
            'building_no':building_no,
            'street_no':street_no,
            'citizen_name':citizen_name,
            'citizen_id':citizen_id,
            'floors_count':floors_count,
            }
            $.ajax({
                type:'get',
                url:'http://map_2.test/buildings/edit_one_building',
                data:parms,
                success:function(response) {
                    console.log('update'+response);

                }
            });
        }
    </script>


@endpush
