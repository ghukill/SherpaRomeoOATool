function getSuggests(keywords) {
	// ajax GET request to keyword_contains.php
	var url = 'keyword_contains.php?keywords='+keywords+'';
	$('#journal_search').html('<img src="loader.gif"/>');
  $('#journal_search').slideDown(750);

  $.ajax({
    url: url,
    dataType: "html",
    success: function( response ) {             
      if (response === "<ul></ul>"){
        response = "No results found."
        $('#journal_search').html(response);
      }
      else {
        $('#journal_search').html(response);
      }         
    }
  });

}

//selectSuggestions listener
function selectSugg(jtitle) {    

	$('#jtitle').val(jtitle);  
  var to_mark = document.getElementById(jtitle);
  var issn = $(to_mark).attr('issn'); //pulls from HTML to avoid math operations when passing it through function
  $('#issn').val(issn);  //changes issn value
  $(to_mark).wrap('<mark />');

}

// edit citation
function editCitation(author_id, cite_num) {
  //create handle
  var citation_handle = document.getElementById(cite_num);
  $(citation_handle).fadeOut(300, function () { 
  var orig_citation_text = $(citation_handle).html();

  //create, populate, and edit text area
  $(citation_handle).after('<form id="citation_edit_form" class="forms" name="citation_edit_form" action="citation_edit.php" method="POST"><textarea id="citation_edit" name="citation_edit" style="display:hidden;">'+orig_citation_text+'</textarea><input type="hidden" name="cite_num" value="'+cite_num+'"><input type="hidden" name="author_id" value="'+author_id+'"><input class="btn btn-small" type="submit" value="submit changes"></form><button class="btn btn-small" onClick="window.location.reload()">Cancel</button>');

  CKEDITOR.replace( citation_edit, {
    toolbar : [['Source','-','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', 'Checkbox', 'Image', 'Styles','Format','Font','FontSize', 'TextColor','BGColor' ]]
  });
});

}