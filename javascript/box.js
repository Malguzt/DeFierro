/**
 * @class Box
 */
var BoxConter = 0;

var Box = function(width, height, x, y){
  this.width = width;
  this.height = height;
  this.x = x;
  this.y = y;
  this.id = BoxConter++;
  $('#mainArea').append('<div class="box" id="Box' + this.id
    + '" style="width:'+this.width
    + ';height:'+this.height+'"></div>'
  );
}

Box.prototype.loader = function(file){
  $('#Box' + this.id).load(file);
}