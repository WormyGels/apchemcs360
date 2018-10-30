/*
Used exclusively to show the special key box for only instructors and students
*/
//start with student selected
var selection = 1 ;
var showing = false ;

//when jquery is initialized and loaded
$(function() {
  //set event listeners for the radio button clicks
  $("#student").click(function() {
    selection = 1 ;
    if (showing)
      hideKeyBox() ;
  }) ;
  $("#instructor").click(function() {
    selection = 2 ;
    if (!showing)
      drawKeyBox() ;
  }) ;
  $("#administrator").click(function() {
    selection = 3 ;
    if (!showing)
      drawKeyBox() ;
  }) ;

}) ;
//if the admin or instructor box is selected, we show a new option
function drawKeyBox() {
  var html = '<div id="keybox" class="form-group"><label for="input" class="sr-only">Special Key</label><input name="special_key" type="password" id="special_key" class="form-control" placeholder="Special Key" required></div>' ;
  $(html).insertAfter("#radio-group") ;
  showing = true ;
}
function hideKeyBox() {
  $("#keybox").remove() ;
  showing = false ;
}
