$(document).ready(function(){
  $("#gaucho").click(loadCharacter);
  $(window).resize(repaint);
  repaint();
  var myBox = new Box(100, 100, 20, 20);
  myBox.loader('../saludo.html'); //TODO: make wor this.
 });

function repaint(){
	$("#mainArea").height($(window).height() - 60);
	$("#mainArea").width($(window).width() - 20);
	$("#mainArea").offset({top: 60, left: 20});
	gauchoRepaint();
	characterRepaint();
}

function gauchoRepaint(){
	$("#gaucho").offset({top: $(window).height() - 140, left: $(window).width() - 100});
}

function characterRepaint(){
	$("#character").height($("#mainArea").height() - 200);
	$("#character").width($("#mainArea").width() - 110);
	$("#character").offset({top: 60, left: 110});
}

function loadCharacter(){
  $('#character').remove();
  $('#gaucho').after('<div id="character"></div>');
  $('#character').load("character/show.php #playerCharacter");
  repaint();
}