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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Map</div>
                <div class="card-body">
                    <div id="map" style="height: 443px;"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Building Table</div>
                <div class="card-body">
                    <table class="table" border="1">
                        <thead>
                        <tr>
                            <th  scope="col">#</th>
                            <th  scope="col">Building No</th>
                            <th  scope="col">Street No</th>
                            <th  scope="col">Owner</th>
                            <th  scope="col">Floors Count</th>
                            <th  scope="col">latitude</th>
                            <th  scope="col">longitude</th>
                            <th  scope="col">created_at</th>
                            <th  scope="col">updated</th>
{{--                            <th  scope="col">Actions</th>--}}
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

                                <td>{{$buildings->latitude}}</td>
                                <td>{{$buildings->longitude}}</td>
                                <td>{{$buildings->created_at}}</td>
                                <td>{{$buildings->updated}}</td>
{{--                                <td>--}}
{{--                                    <button type="button" class="btn btn-warning" onclick="edit_building('{{$buildings->id}}')">Edit</button>--}}
{{--                                    <button type="button" class="btn btn-danger" onclick="delete_building('{{$buildings->id}}')">Delete</button>--}}
{{--                                </td>--}}
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
        }
        function delete_building(building_id){
            console.log('delete'+building_id);

        }
    </script>



@endpush
