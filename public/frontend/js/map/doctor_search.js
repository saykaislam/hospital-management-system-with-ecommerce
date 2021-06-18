var map;
var myLatLng;

// $(document).ready(function() {
//     //geoLocationInit();
// });
function geoLocationInit() {

    var check_session = sessionStorage.getItem("latitude");
    //console.log(session);
    if(check_session==null){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Browser not supported");
        }
    }else{
        let sessionPos = {
            coords: {
                latitude:sessionStorage.getItem("latitude"),
                longitude:sessionStorage.getItem("longitude"),
            },
        };
        success(sessionPos);
    }
}

function success(position) {
    //console.log(position);
    sessionStorage.setItem("latitude", position.coords.latitude);
    sessionStorage.setItem("longitude", position.coords.longitude);

    var latval = position.coords.latitude;
    var lngval = position.coords.longitude;

    myLatLng = new google.maps.LatLng(latval, lngval);

    searchDoctors(latval,lngval);
}

function fail() {
    alert("Please Allow Location Access To Take Service");
}


function searchDoctors(lat,lng){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/doctor/near/list',
        method: 'post',
        data: {
            lat:lat,
            lng:lng,
            // service_id:get_service(),
        },
        success: function(data){
            console.log(data);
            if (data.response.length==0){
                $('#doctor_list').html('No Service Provider Near You');
            }else{
                var i;
                $('#doctor_list').empty();
                for(i=0;i<data.response.length;i++) {
                    var glatval = data.response[i].lat;
                    var glngval = data.response[i].lng;
                    var gname = data.response[i].title;

                    $('#doctor_list').append(`<div class="card">
                                                <div class="card-body">
                                                    <div class="doctor-widget">
                                                        <div class="doc-info-left">
                                                            <div class="doctor-img">
                                                                <a href="javascript:void(0);">
                                                                    <img src="" class="img-fluid" alt="User Image">
                                                                </a>
                                                            </div>
                                                            <div class="doc-info-cont">
                                                                <h4 class="doc-name"><a href="javascript:void(0);">`+data.response[i].name+`</a></h4>
                                                                <p class="doc-speciality">`+data.response[i].spe_name+`</p>
                                                                <h5 class="doc-department"><img src="" class="img-fluid" alt="Speciality">`+data.response[i].name+`</h5>
                                                                <div class="rating">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star"></i>
                                                                <span class="d-inline-block average-rating">(67)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="doc-info-right">
                                                            <div class="clini-infos">
                                                                <ul>
                                                                    <li><i class="fas fa-map-marker-alt">`+data.response[i].address+`</i></li>
                                                                </ul>
                                                            </div>
                                                            <div class="clinic-booking">
                                                                <a class="view-pro-btn" href="">View Profile</a>
                                                                <a class="apt-btn" href="">Book Appointment</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`);
                }
            }
        }
    });
}



