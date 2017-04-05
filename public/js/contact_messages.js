function  deleteMessage(id) {

    var id=id;

    $.ajax({
        type:'GET',
        url:"http://localhost/laravel5-tutorial/admin/contact/messages/delete",
        data:{id:id},
        success:function (message) {
            var deletedArticle=$('article[data-id1="'+id+'"]');
            deletedArticle.text(message['message']);
            deletedArticle.css('color',"red");
            deletedArticle.css('border',"1px solid red");
            deletedArticle.parent().fadeOut(1000);


        }
    });
}
