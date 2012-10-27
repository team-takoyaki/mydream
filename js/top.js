$('.logout_btn').click(function() {
    if (window.confirm('ログアウトしますか？') === false) {
        return false;
    }
});
