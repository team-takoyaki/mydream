$(function() {
    $('.order_save_btn').click(function() {
          var comments = $('.ui-state-default');
	      var comment_ids = new Array();
	      for (var i = 0; i < comments.length; i++) {
	          comment_ids.push($(comments[i]).data('comment-id'));
          }

          $.ajax({
              type: 'POST',
	          url: 'dream.php',
	          data: {
                  order_change: 1,
	              order_comment_ids: comment_ids
	          },
	      success: function(data) {
              if (data === '200') {
	              alert('順番を保存しました');
		          $('.order_edit_btn').removeClass('display_none');
	              $('.order_save_btn').addClass('display_none');
	              $('.sortable').sortable({
	                                          disabled: true,
		                                  });
              } else {
                  alert(data);
              }
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

      $('.logout_btn').click(function() {
          if (window.confirm('ログアウトしますか？') === false) {
              return false;
          }
     });
});