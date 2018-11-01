//numbers of questions on page
var questions = 1 ;
var maxQuestions = 50

//value of the select box which class they have selected
var selected ;
var tags = [] ;

//when jquery loads
$(function() {

  //configure autocomplete on the categories field
  //get categories from database via ajax
  updateAutoComplete() ;

  //or when we change it
  $("#class-select").click(function() {updateAutoComplete() ;}) ;

  //when new button question is pressed
  $("#newQuestion").click(function() {
    if (questions < maxQuestions) {

      questions++ ;

      var htmlString = '<div id="question'+questions+'" class="form-group col-sm-12 separator question-box">'
                        + '<div class="form-row">'
                        +  '<div class="col-sm-12">'
                        +    '<label>Question '+ questions +'</label>'
                        +    '<input name="question[]" type="text" class="form-control" placeholder="Question">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>A</label>'
                        +    '<input name="answera[]" type="text" class="form-control" placeholder="A">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>B</label>'
                        +    '<input name="answerb[]" type="text" class="form-control" placeholder="B">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>C</label>'
                        +    '<input name="answerc[]" type="text" class="form-control" placeholder="C">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>D</label>'
                        +    '<input name="answerd[]" type="text" class="form-control" placeholder="D">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>E</label>'
                        +    '<input name="answere[]" type="text" class="form-control" placeholder="E">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>F</label>'
                        +    '<input name="answerf[]" type="text" class="form-control" placeholder="F">'
                      +    '</div>'
                    +    '</div>'
                  +        '<div class="text-left" style="padding-top:20px ;">'
                +            '<label>Correct Answer</label><br>'
                +            '<div class="btn-group btn-group-toggle" data-toggle="buttons">'
                +              '<label class="btn btn-secondary active">'
                +                '<input value=1 type="radio" name="answercor[]" autocomplete="off" checked="checked" checked> A'
                +              '</label>'
                +              '<label class="btn btn-secondary">'
                +                '<input  value=2 type="radio" name="answercor[]" autocomplete="off"> B'
                +              '</label>'
                +              '<label class="btn btn-secondary">'
                +                '<input value=3 type="radio" name="answercor[]" autocomplete="off"> C'
                +              '</label>'
                +              '<label class="btn btn-secondary">'
                +                '<input value=4 type="radio" name="answercor[]" autocomplete="off"> D'
                +              '</label>'
                +              '<label class="btn btn-secondary">'
                +                '<input value=5 type="radio" name="answercor[]" autocomplete="off"> E'
                +              '</label>'
                +              '<label class="btn btn-secondary">'
                +                '<input value=6 type="radio" name="answercor[]" autocomplete="off"> F'
                +              '</label>'
                +            '</div>'
                +          '</div>'
                +       '</div>' ;


      $(htmlString).insertAfter('#question'+(questions-1)) ;

      if (questions >= maxQuestions) {
        $("#newQuestion").addClass("disabled")
      }

    }

  }) ;

}) ;

function updateAutoComplete() {
  selected = $("#class-select").val() ;
  var httpRequest1 = $.ajax("../instructor/getcategories.php?class_id="+selected).done(function(response) {
    var jsonResp ;
    if (response != "")
      jsonResp = JSON.parse(response) ;
    else
      jsonResp = {} ;
    tags = [] ;
    for (var i = 0 ; i < jsonResp.length ; i++) {
      tags[i] = jsonResp[i].quiz_category
    }
    $("#quiz-category").autocomplete({source: tags}) ;
  }) ;
}
