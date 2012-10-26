$(function() {
    $('.order_save_btn').click(function() {
          var comments = $('.ui-state-default');
	  var comments_id = new Array();
	  for (var i = 0; i < comments.length; i++) {
	      comments_id.push($(comments[i]).data('comment-id'));	       
          }

          $.ajax({
              type: 'GET',
	      url: 'dream.php',
	      data: {
	          comments_id: comments_id
	      },
	      success: function(data) {
	          alert('順番を保存しました');
		  $('.order_edit_btn').removeClass('display_none');
	          $('.order_save_btn').addClass('display_none');
	          $('.sortable').sortable({
	              disabled: true,
		  });
	      }
	 });
    });

    $('.order_edit_btn').click(function() {
        $('.sortable').sortable({
	    disabled: false,
	    cursor: 'move',
	    opacity: 0.7,
	    placeholder: 'ui-state-highlight'
	});
        $('.sortable').disableSelection();
	$('.order_edit_btn').addClass('display_none');
	$('.order_save_btn').removeClass('display_none');
    });
});