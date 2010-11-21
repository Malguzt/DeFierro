$(document).ready(function(){
  $("#gaucho").click(loadCharacter);
  $(window).resize(repaint);
  repaint();
 });

function repaint(){
	$("#loadArea").height($(window).height() - 60);
	$("#loadArea").width($(window).width() - 20);
	$("#loadArea").offset({top: 60, left: 20});
	gauchoRepaint();
}

function gauchoRepaint(){
	$("#gaucho").offset({top: $(window).height() - 130, left: $(window).width() - 100});
}

function loadCharacter(){
  $('#loadArea').load("character/show.php #playerCharacter");
}