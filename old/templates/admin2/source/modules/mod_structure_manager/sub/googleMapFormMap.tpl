<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>
<script type="text/javascript" src="{$__jsRoot__}/gps_calculator.js"></script>
<style type="text/css">
{literal}
BODY { font-family: verdana; margin: 0; padding: 0; }
H1 { font-size: 18px; margin: 20px 0 0px 0; padding: 1px 0; } 
A { color: #276FC9; text-decoration: none; }
A:hover { color: #e00; }
.findOnMap { width: 500px; float:left; clear:both; padding: 0 0 5px 0; font-size: 11px; }
#map { flaot:left; clear:both; }
{/literal}
</style>
<title></title>
</head>
<body>
<h1>[MAPA]</h1>
<div class="findOnMap">
Znajdź na mapie punkt używając wyszukiwarki znajdującej się w lewym dolnym rogu mapy a następnie kliknij na miejsce na mapie aby ustawić na niej znacznik i uzupełnić współrzędne.<br />
<a href="#" onclick="document.location.href=document.location.href;">Przeładuj mapę</a> jeżeli występują na niej błędy lub została źle wczytana.
</div>

<div id="map" style="height: 340px; width: 600px;"></div>


<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key={$smarty.const.CFGDB_GOOGLE_MAPS_API_KEY}" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
{literal}
var map = new GMap2($('map'));
var geo = new GClientGeocoder();

clear_crd = function() {
	 parent.$('fi_lng').value = '';
	 parent.$('fi_lat').value = '';
}

update_crd = function(crd) {
	parent.$('fi_lat').value = crd.lat();
	parent.$('fi_lng').value =  crd.lng();
}

update_marker = function(m,p) {
	if (!m) {
		map.setCenter(p);
		map.clearOverlays();
		map.addOverlay(new GMarker(p));
	}
	update_crd(p);
}

initialize = function() {
	map.setCenter(new GLatLng(52.009534, 19.082128), 6);
	map.enableContinuousZoom();
	map.enableInfoWindow();
	map.addControl(new GLargeMapControl());
	map.addControl(new GMapTypeControl());
	map.addControl(new GOverviewMapControl());
	map.enableDoubleClickZoom();
	map.enableGoogleBar();
	map.enableScrollWheelZoom();	
	GEvent.addListener(map, 'click', update_marker);	
}

goToLoc = function(lng,lat) {
	map.clearOverlays();
	update_crd(new GLatLng(parseFloat(lng),parseFloat(lat)));
	map.addOverlay(new GMarker(new GLatLng(parseFloat(lng),parseFloat(lat))));
	map.setCenter(new GLatLng(parseFloat(lng),parseFloat(lat)),15);
}

initialize();
if(parent.$('fi_lng').value > 0 && parent.$('fi_lat').value > 0  ) {
goToLoc(parent.$('fi_lat').value, parent.$('fi_lng').value);
}
{/literal}
</script>
{*<a href="#" onclick="convertGps(); return false"><strong>oblicz pozycje GPS</strong></a>*}
</body>
</html>