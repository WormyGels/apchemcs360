//numbers of questions on page
var questions = 1 ;
var maxQuestions = 15

//when jquery loads
$(function() {

  //when new button question is pressed
  $("#newQuestion").click(function() {

    if (questions < maxQuestions) {

      questions++ ;

      var htmlString = '<div id="question'+questions+'" class="form-group col-sm-12 separator question-box">'
                        + '<div class="form-row">'
                        +  '<div class="col-sm-12">'
                        +    '<label>Question '+ questions +'</label>'
                        +    '<input name="question'+questions+'" type="text" class="form-control" placeholder="Question">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>A</label>'
                        +    '<input name="answer'+questions+'a" type="text" class="form-control" placeholder="A">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>B</label>'
                        +    '<input name="answer'+questions+'b" type="text" class="form-control" placeholder="B">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>C</label>'
                        +    '<input name="answer'+questions+'c" type="text" class="form-control" placeholder="C">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>D</label>'
                        +    '<input name="answer'+questions+'d" type="text" class="form-control" placeholder="D">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>E</label>'
                        +    '<input name="answer'+questions+'e" type="text" class="form-control" placeholder="E">'
                        +  '</div>'
                        +  '<div class="col-sm-2">'
                        +    '<label>F</label>'
                        +    '<input name="answer'+questions+'f" type="text" class="form-control" placeholder="F">'
                      +    '</div>'
                    +    '</div>'
                  +    '</div>' ;


      $(htmlString).insertAfter('#question'+(questions-1)) ;

      if (questions >= maxQuestions) {
        $("#newQuestion").addClass("disabled")
      }

    }

  }) ;

}) ;
