// JavaScript Document

$(document).ready(function () {
	
	// make round corners
	$('#content').corner("top");						
	$('#navbar').corner("top");
	$('#logo').corner();
	// auto scroll
	$.localScroll();
	// inline help
	$(".help").tipsy({gravity : 'e' ,fade: false});
	$(".part").bind('mouseenter',fadeInHelp);
	$(".part").bind('mouseleave',fadeOutHelp);
	
	// flash search bar
	$('#map_search').fadeOut(800).fadeIn(800).fadeOut(800).fadeIn(800).fadeOut(800).fadeIn(800);
	
	// set text area char counter
	$(function(){
 		$('#tmsg_input').keyup(function(){
 			limitChars('tmsg_input', parseInt($("#error_msgs #chars_max").attr("value")), 'charlimitinfo');
 		})
	});
	
	google.setOnLoadCallback(initialize);
	contact();

});

// just make input msg disapear on click
function prepareInput() {
	//$('#map_search').stop();
	$('#search_text').attr('value', '');
}

// on hover show bubble
function showHelp(container) {
	id = $(container).attr("id");
	$("#"+id + " .help").removeClass("hidden");
}

// on hover hide bubble
function hideHelp(container) {
	id = $(container).attr("id");
	$("#"+id +  " .help").addClass("hidden");
}

// option buttons
enable_options = true;
function selectOption(a, id) {
	if (enable_options) {
		lastplace = $('#'+ id + ' .selected');
		$(lastplace).removeAttr("class");
		$(a).attr("class", "selected");
		$("#"+id+"_input").attr("value", $(a).attr("id"));
	}
}

// dow behaves a little different
function selectDow(a) {
	if (enable_options) {
		$(a).toggleClass("selected");
		current_dow = parseInt($("#dow_input").attr("value"));
		if ($(a).hasClass("selected")) {
			$("#dow_input").attr("value", current_dow + Math.pow(2,parseInt($(a).attr("id"))));
		} else {
			$("#dow_input").attr("value", current_dow - Math.pow(2,parseInt($(a).attr("id"))));
		}
	}
}

// fade in/out help icon on part hover
function fadeInHelp() {
	$(".helpimg",this).fadeIn('fast');
}

function fadeOutHelp() {
	$(".helpimg",this).fadeOut('fast');
}

// text area char counter and msg
function limitChars(textid, limit, infodiv)
{
	var text = $('#'+textid).val();	
	var textlength = text.length;
	if(textlength > limit)
	{
		$('#' + infodiv).addClass('redfont');
		$('#' + infodiv).html( $("#error_msgs #chars_limit").attr("value") + limit + $("#error_msgs #chars_unit").attr("value"));
		$('#'+textid).val(text.substr(0,limit));
		return false;
	}
	else
	{	
		$('#' + infodiv).removeClass('redfont');
		$('#' + infodiv).html($("#error_msgs #chars_remaining").attr("value") + (limit - textlength) + $("#error_msgs #chars_unit").attr("value"));
		return true;
	}
}


// dummy jalert wrapper
function display_error(id) {
	jAlert($("#error_msgs "+id).attr("value"), $("#error_msgs #title").attr("value"));
}

// validates the form, returns true when all fields valid
function validateForm() {
	result = true;
	// check search was already sent
	if ($("#send_button").hasClass("disabled")) {
		
	result = false;
	
	} else {
		// first check hidden inputs
		for (i=0;i<$("#form .seeshyinput").size();i++) {
			if ($("#form .seeshyinput").eq(i).attr("value") == "0") {
				id = "#"+$("#form .seeshyinput").eq(i).parent().parent().attr("id");
				display_error(id);
				$.scrollTo(id, 1500);
				$("#form .seeshyinput").eq(i).parent().fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium');
				result = false;
				break;
			} 
		}
		// check text area has at least 10 chars
		if (($("#form textarea").attr("value").length < 20) && result === true) {
			id = "#"+$("#form textarea").parent().parent().parent().attr("id");
			display_error(id);		
			$.scrollTo(id, 1500);			
			$("#form textarea").fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium');	
			result = false;
		
		// check email
		} else if (!checkEmail($("#form #email_input").attr("value")) && result === true) {
			id = "#"+$("#form #email_input").parent().parent().parent().attr("id");
			display_error(id);
			$.scrollTo(id, 1500);
			$("#form #email_input").fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium').fadeOut('medium').fadeIn('medium');		
			result = false;				
		}
	}	 

	return result;
	
}

// regex validation
function checkEmail(inputvalue){	
    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if(pattern.test(inputvalue)){         
		return true;   
    }else{   
		return false; 
    }
}


// validates and if everything is ok then sends
function validateAndSend() {
	if (validateForm()) {
		// disable button
		$("#send_button").addClass("disabled");	
		// unbind it from function
		$("#send_button").unbind();
		// change button msg
		$("#send_button").html($("#error_msgs #submit_working").attr("value"));
		// send form data
		var data = $('#form').serialize();
		$.post("clerk.php", data, clerkResponse, "json");
		// fade out form and disable option edit
		$('.part:not(#send)').fadeTo('slow', 0.33);
		enable_options = false;

	} else { return false; }
}

// ajax response callbak
function clerkResponse(data) {
	// 1 means ok
	if (data.code == 1) {		
		// change button msg to OK!
		$("#send_button").html($("#error_msgs #submit_done").attr("value"));
		$("#social").fadeIn('slow');
		$.scrollTo('#social', 6000);
	} else {
		// code !=1 means error
		// enable button again to allow retry
		$("#send_button").removeClass("disabled");	
		$("#send_button").html($("#error_msgs #submit_retry").attr("value"));
		// rebind function
		$("#send_button").bind("click", validateAndSend);		
	}
	// display response msg
	jAlert(data.msg, data.title);
}




var map = null; // google map
var marker = null; // user marker
var circle = null; // user marker zone
var radius = 0.15; // radius in miles for zone
var geocoder = null; // to convert from address to coords
var mapControl = null; // controls for map

// Call this function when the page has been loaded
function initialize() {
	map = new google.maps.Map2(document.getElementById("map_canvas"));
	if (google.loader.ClientLocation !== null) {
		// try to geolocate client
		map.setCenter(new google.maps.LatLng(google.loader.ClientLocation.latitude, google.loader.ClientLocation.longitude), 15);
	} else {
		map.setCenter(new GLatLng(0, 0), 2);
	}
	geocoder = new GClientGeocoder();
	mapControl = new GMapTypeControl();
	map.addControl(mapControl);
	map.addControl(new GLargeMapControl());
	GEvent.addListener(map, "mouseout", function() {
		document.getElementById('map_lat').value = map.getCenter().lat();
		document.getElementById('map_lng').value = map.getCenter().lng();			
	});
	moveUserMarker(map.getCenter());
	marker.openInfoWindowHtml($("#error_msgs #mapinfo").attr("value"));	
	
}

// moves user marker to the specified point
function moveUserMarker(point) {
	// remove old marker
	if (circle != null && marker !== null) {
		map.removeOverlay(circle);
		map.removeOverlay(marker);
	}
	// create distinctive marker and special options
	var greenIcon = new GIcon(G_DEFAULT_ICON);
	greenIcon.image = 'http://alfa.seeshy.com/img/marker.png';

	map.setCenter(point);
	var markerOpts = {
		bouncy : true,
		draggable : true,
		icon : greenIcon
	};
	marker = new GMarker(point, markerOpts);
	map.addOverlay(marker);

	// create and place zone
	circle = new CircleOverlay(point, radius, "#336699", 1, 1, '#336699', 0.25);
	map.addOverlay(circle);
	GEvent.addListener(marker, "dragend", function(point) {
		moveUserMarker(point);
		$('#map_lat').attr('value', map.getCenter().lat());
		$('#map_lng').attr('value', map.getCenter().lng());		
	});
	$('#map_lat').attr('value', map.getCenter().lat());
	$('#map_lng').attr('value', map.getCenter().lng());				

}

// moves the map center to the specified address (if recognized)
function goToAddress() {
	address = document.getElementById('search_text').value;
	if (geocoder) {
		geocoder.getLatLng(address, function(point) {
			if (!point) {
				alert(address + " not found");
			} else {
				// center map
				map.setCenter(point, 16);
				// create zone overlay
				moveUserMarker(map.getCenter());
				// search for nearby places
			}
		});
	}
}

ta_flag = true;
em_flag = true;
// clears text area on first click only
function clearTAOnce(ta) {
	if (ta_flag) {
		ta.value = '';
		ta_flag = false;
	}
}
// clears email input on first click only
function clearEmailOnce(em) {
	if (em_flag) {
		em.value = '';
		em_flag = false;
	}
}

// makes enter search
function onEnter(e) {
  key = (document.all) ? e.keyCode : e.which;
  if (key==13) { goToAddress(); }
}

function contact() {
	email = String.fromCharCode(60,97,32,104,114,101,102,61,34,109,97,105,108,116,111,58,99,111,110,116,97,99,116,64,115,101,101,115,104,121,46,99,111,109,34,62,99,111,110,116,97,99,116,64,115,101,101,115,104,121,46,99,111,109,60,47,97,62);
	$('a.email').attr('href', 'mailto:'+email);
	$('a.email').html(email);
}