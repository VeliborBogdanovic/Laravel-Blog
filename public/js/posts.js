$( document ).ready(function() {

    var dataList = $(".list1").map(function() {
        return $(this).data("id");
    }).get();
    var dataList1=dataList.join(" ");
    $('#categories').val(dataList1);
    //dohvata sve data-id vrednosti i upisuje ih u hidden polje



    var select=document.getElementById('category_select');

        setInterval(function()
        {
            [].slice.call(select.options)
                .map(function(a){
                    if(this[a.innerText]){
                        select.removeChild(a);
                    } else {
                        this[a.innerText]=1;
                    }
                },{});
        }, 300);



    $('#addCategory').click(function (e) {
        e.preventDefault();
        var valueHidden=$('#categories').val();
        var id=$('#category_select').val();
        var name= $('#category_select :selected').text();
        if(name.length!==0 && name!=='undefined') {

            if(valueHidden==0)
            {
                $('#categories').val(id);
            }
            else
            {
                var idNew=$('#categories').val();
                idNew=idNew+' '+id;
                $('#categories').val(idNew);

            }
            var categories = '<li><a href="javascript:void(0)" id="cat' + id + '" name="' + name + '" onclick="removeCategory(' + id + ')" >' + name + '</a></li>';
            $(categories).appendTo(".added-categories ul").hide().fadeIn(1000);
            $("#category_select option[value='" + id + "']").remove();

            if ($('#category_select').has('option').length <= 0)  $('#addCategory').text('No more categories');

            else if($('#category_select').has('option').length === 0) $('#addCategory').text('Add Category');
        }
    });
});

function removeCategory(id) {
    var name = $('#cat' + id).attr('name');
    $("#cat" + id).parents('li').remove();
    $("#category_select").append('<option value=' + id + '>' + name + '</option>');
    $('#addCategory').text('Add Category');
    var newValues = [];
    var valueHidden = $('#categories').val();
    $('#categories').val('0');
    var ids = valueHidden.split(' ');

    for (var i = 0; i < ids.length; i++) {
        if (ids[i] != id) {
            newValues += ids[i] + ' ';
        }
    }



    newValues=newValues.toString().trim();

    $('#categories').val(newValues);
    if(newValues.length==0 )    {
        $('#categories').val(0);
    }

}

// function create()
// {
//     var title=$('#title').val();
//     var author=$('#author').val();
//     var categories=$('#categories').val();
//     var body=$('#body').val();
//
//
//     $.ajax({
//         type:'GET',
//         url:"http://localhost/laravel5-tutorial/admin/blog/post/ajax",
//         data:{title:title,author:author,categories:categories,body:body},
//         success:function (result) {
//
//
//
//         }
//     });
// }