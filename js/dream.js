$(function() {
    // ボタンでの並び変え
    $('.order_button').click(function(event) {
        var order_value = $(event.currentTarget).val();
        var $li = $($(event.currentTarget).parents('li').get(0));
        if (order_value === 'order_top') {
            $($li.prev('li').get(0)).before($li);
        } else if (order_value === 'order_bottom') {
            $($li.next('li').get(0)).after($li);
        }
        update_edit_button();
    });

    // 順番を保存するボタン
    $('.order_save_btn').click(function() {
          var comments = $('.comment');
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
                  if ($('.order_edit_area').hasClass('display_none') === false) {
                      $('.order_edit_area').addClass('display_none');
                  }
	              $('.sortable').sortable({
	                                          disabled: true,
		                                  });
              } else {
                 console.log(data);
              }
	      }
	 });
    });

    // 順番を変えるボタン
    $('.order_edit_btn').click(function() {
        update_edit_button();

        if ($('.order_edit_area').hasClass('display_none') === true) {
            $('.order_edit_area').removeClass('display_none');
        }

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

      // ログアウトがおされた時
      $('.logout_btn').click(function() {
          if (window.confirm('ログアウトしますか？') === false) {
              return false;
          }
     });

    function update_edit_button() {
        var order_edit_areas = $('.order_edit_area');
        for (var i = 0; i < order_edit_areas.length; i++) {
            var $li = $($(order_edit_areas[i]).parents('li').get(0));
            if ($li.prev('li').size() === 0) {
                $($(order_edit_areas[i]).children('#order_top').get(0)).addClass('display_none');
            } else {
                $($(order_edit_areas[i]).children('#order_top').get(0)).removeClass('display_none');
            }

            if ($li.next('li').size() === 0) {
                $($(order_edit_areas[i]).children('#order_bottom').get(0)).addClass('display_none');
            } else {
                $($(order_edit_areas[i]).children('#order_bottom').get(0)).removeClass('display_none');
            }
        }
    }
});