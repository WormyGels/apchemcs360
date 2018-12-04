//when jquery loads
$(function() {
  //get the url parameters with function defined below
  var quizId = getUrlParameter("quiz") ;

  if (quizId != null)

    var httpRequest1 = $.ajax("getquizinfo.php?quiz="+quizId).done(function(response) {

    //parse our response as a JSON (because it is)
    var jsonResp = JSON.parse(response) ;

    var name = jsonResp.name ;
    var total = jsonResp.total ;
    var correct = jsonResp.correct ;
    var comment = jsonResp.comment ;
    if (comment == "") {
      comment = "n/a" ;
    }

    var body = "<span class='grade-info-label'>Correct: <span class='grade-info-item'>"+correct+"</span></span>" ;
    body += "<br><span class='grade-info-label'>Total: <span class='grade-info-item'>"+total+"</span></span>"
    body += "<br><span class='grade-info-label'>Score: <span class='grade-info-item'>"+round(correct/total*100)+"%</span></span>" ;
    body += "<br><span class='grade-info-label'>Instructor Feedback</span>"
    body += "<br><span class='grade-info-item'>"+comment+"</span>"

    displayModal(name, body) ;

    }) ;

}) ;

//displays the generic modal with the given strings
function displayModal(title, body) {
  $("#modal-title").text(title) ;
  $("#modal-body").html(body) ;
  $("#modal").modal() ;
}
function getUrlParameter(param) {
  //get the page url
  var pageURL = decodeURIComponent(window.location.search.substring(1)) ;
  //split the page url by the & sign (how we separate variables)
  var urlVars = pageURL.split('&') ;

  //go through all the paramaeters and split by equal sign to get value
  for (var i = 0; i < urlVars.length; i++) {
    var paramName = urlVars[i].split('=') ;

    //if we find the passed parameter then we are to return the proper value
    if (paramName[0] === param) {
      //just a check to make sure that it is defined (otherwise we can get some wonky stuff)
      return paramName[1] === undefined ? true : paramName[1] ;
    }
  }
}
function round(n) {
  return Math.round(n * 100) / 100 ;
}
