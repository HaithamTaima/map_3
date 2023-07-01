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

            <div class="card" id="citizen_form" style="display: none">
                <div class="card-header">Building Form</div>
                <div class="card-body">
                    <form  >


                        <label for="citizen_name" class="form-label" >resident Name</label>
                        <div class="col-md-7">
                            <input id="citizen_name" name="citizen_name" type="text" class="form-control" placeholder="name">
                        </div>

                        <label for="building_id" class="form-label" >Building Id</label>
                        <div class="col-md-7">
                            <input id="building_id" name="building_id" type="text" class="form-control" placeholder="Street">
                        </div>

                        <label for="citizen_status" class="form-label" >Citizen Status</label>
                        <div class="col-md-7">
                            <input id="citizen_status" name="citizen_status" type="text" class="form-control" placeholder="Citizen Name">
                        </div>


                        <label for="floor" class="form-label" >Floor</label>
                        <div class="col-md-7">
                            <select id="floor" name="floor" class="form-select" aria-label="Default select example">
                                <option value="1">1 Floors</option>
                                <option value="2">2 Floors</option>
                                <option value="3">3 Floors</option>
                                <option value="4">4 Floors</option>
                                <option value="5">5 Floors</option>
                            </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-warning" onclick="edit_building_form1()">Edit Button</button>
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
                                <th  scope="col">ID</th>
                                <th  scope="col">resident_name</th>
                                <th  scope="col">building_id</th>
                                <th  scope="col">citizen_status</th>
                                <th  scope="col">Floors</th>
                                <th  scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($buildings_query as $buildings)
                        <tr>
                            <td>{{$buildings->id}}</td>
                                <td>{{$buildings->resident_name}}</td>
                                <td>{{$buildings->building_id}}</td>
                                <td>{{$buildings->citizen_status}}</td>
                                <td>{{$buildings->floor}}</td>
                            <td>
                                <button type="button" class="btn btn-warning" onclick="edit_building1('{{$buildings->id}}')">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="delete_building1('{{$buildings->id}}')">Delete</button>
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
        function edit_building1(citizen_id){
            console.log('edit'+citizen_id);
            document.getElementById('citizen_id').value=citizen_id;
            document.getElementById('citizen_form').style.display="block";
        }
        function delete_building1(citizen_id){
            var parms={
                'citizen_id': citizen_id
            }
            $.ajax({
                type:'get',
                url:'http://maps.test/buildings/delete_one_building1',
                data:parms,
                success:function(response) {
                    console.log('delete'+response);

                }
            });

        }

        function edit_building_form1() {
            var citizen_id =document.getElementById('citizen_id').value;
            var resident_name=document.getElementById('resident_name').value;
            var building_id=document.getElementById('building_id').value;
            var citizen_status=document.getElementById('citizen_status').value;
            var floor=document.getElementById('floor').value;

            var parms={
                'citizen_id':citizen_id,
                'resident_name':resident_name,
                'building_id':building_id,
                'citizen_status':citizen_status,
                'floor':floor,

            }
            $.ajax({
                type:'get',
                url:'http://maps.test/buildings/edit_one_building1',
                data:parms,
                success:function(response) {
                    console.log('update'+response);

                }
            });
        }
    </script>


@endpush
