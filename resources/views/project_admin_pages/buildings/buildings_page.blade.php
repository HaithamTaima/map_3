//citizens
@extends('project_layouts.skeleton')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
@endsection
@section('page_content')

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Building Form</div>
                <div class="card-body">
                    <form action="{{route('add_new_citizen')}}" method="get">



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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Building Map</div>
                <div class="card-body">
                    <div id="map" style="height: 443px;"></div>
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

        const map = L.map('map').setView([31.3547,34.3088], 10);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


        map.on('click',addMarker);

        function addMarker(e){


            // حذف العناصر الأخرى ذات الصلة
            // $(".leaflet-marker-icon").remove();
            // $(".leaflet-shadow-pane").remove();
            // $(".leaflet-popup").remove();
            // $(".leaflet-tooltip").remove();

            console.log('You have added a new marker in the map ');

            newMarker=new L.marker(e.latlng).addTo(map);

            console.log(' latitude = '+newMarker.getLatLng().lat);
            console.log(' longitude = '+newMarker.getLatLng().lat);


            document.getElementById('point_latitude').value = newMarker.getLatLng().lat;
            document.getElementById('point_longitude').value = newMarker.getLatLng().lng;



        }

    </script>



@endpush
