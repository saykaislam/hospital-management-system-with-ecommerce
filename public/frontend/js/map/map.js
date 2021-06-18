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

    createMap(myLatLng);
    searchVendors(latval,lngval);
    $('#vendorModal').modal('show');
}

function fail() {
    alert("Please Allow Location Access To Take Service");
}
//Create Map
function createMap(myLatLng) {
    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 14,
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: 'http://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Azure-icon.png',
        title: "Current Location"
    });
}
//Create marker
function createMarker(latlng, icn, name,content) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: icn,
        title: name
    });

    var infoWindow = new google.maps.InfoWindow({
        content:content,
    });

    marker.addListener('click', function(){
        infoWindow.open(map, marker);
    });
}

function searchVendors(lat,lng){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/service/service_provider/near/list',
        method: 'post',
        data: {
            lat:lat,
            lng:lng,
            // service_id:get_service(),
        },
        success: function(data){
            console.log(data);
            if (data.response.length==0){
                $('#exampleModalLongTitle').html('No Service Provider Near You');
                $('.near_venodr_list').html(`<div class="row">
								<div class="col-md-12 text-center">
									<p class="font-weight-light p-5">Empty Service Provider List</p>
								</div>
							</div>`);
            }
            else{
                var i;
                $('.near_venodr_list').empty();
                $('#exampleModalLongTitle').html('Select Service Provider From Map or List' );
                for(i=0;i<data.response.length;i++){
                    var glatval=data.response[i].lat;
                    var glngval=data.response[i].lng;
                    var gname=data.response[i].title;
                    var star=data.response[i].star ? data.response[i].star : 0;
                    var gcontent= `<div class="row mx-1">
			<div class="col-12">
				<h6 class="m-1 p-0" style="font-size: 14px;line-height: 23px;font-weight: bold;">`+data.response[i].title+`</h6>
				<button  id="`+data.response[i].id+`" class="btn btn-sm px-1" style="border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="Click To Take This Service" onclick="selectVendor(`+data.response[i].id+`)">Take Service From Here<i class="fa fa-arrow-right ml-1" aria-hidden="true"></i></button>
			</div>
		</div>`;
                    var gicn= 'http://icons.iconarchive.com/icons/graphicloads/polygon/32/shopping-cart-icon.png';
                    var GLatLng = new google.maps.LatLng(glatval, glngval);
                    createMarker(GLatLng,gicn,gname,gcontent);
                    // console.log(GLatLng);
                    $('.near_venodr_list').append(`<div class="row px-1 mb-3" style="cursor: pointer;" onclick="selectVendor(`+data.response[i].id+`)">
									<div class="col-2 p-0 text-center">
										<h5>Name</h5>
									</div>
									<div class="col-10 ">
										<h6 class="mb-1 p-0 pr-2" style="font-size: 14px;line-height: 19px;font-weight: bold;">`+data.response[i].name+`</h6>
										<p class="m-0 mb-1 pr-2" style="font-size: 14px;line-height: 15px;display:inline;"><strong style="color:#174fd8;"><i class="fa fa-star mr-1" aria-hidden="true"></i>`+star+`</strong> out of 5</p>
										<p class="m-0 mb-1 pr-2" style="font-size: 14px;line-height: 15px;display:inline;"><strong style="color:#174fd8;"><i class="fa fa-home mr-1" aria-hidden="true"></i>`+Math.floor((Math.random() * 20) + 1)+`</strong> Service Completed</p>
										<p class="m-0 pr-2" style="font-size: 13px;line-height: 15px;">`+data.response[i].address+`</p>
									</div>
								</div>`);
                    //For list
                }
            }
        }
    });
}
function selectVendor(id){
    document.getElementById('vendor_id').value = id;
    $('#vendorModal').modal('hide');
    $("#orderBtn").removeClass('d-none');

}


