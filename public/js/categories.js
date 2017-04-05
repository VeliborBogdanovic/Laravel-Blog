/**
 * Created by velja on 3/16/2017.
 */

$( document ).ready(function()
{
    $('#create_category').click(function (e) {
        e.preventDefault();
        var name=$('#name').val();
        // if(name.length===0)
        // {
        //     alert("Please insert a valid category");
        //     return;
        // }

        // alert(url);
        // alert(name);
        $.ajax({
            type:'GET',
            url:"http://localhost/laravel5-tutorial/admin/blog/category/create",
            data:{name:name},
            success:function (result) {
                var txt="<article><div class='category-info'><h3 id='cat_name"+result['category']['id']+"'>"+result['category']['name']+" </h3></div><nav class='edit'><ul><li class='category-edit'><input type='text' id='"+result['category']['id']+"'></li><li><a href='javascript:void()' onclick='edit("+result['category']['id']+")' id='edit"+result['category']['id']+"' class='edit-link'>Edit</a> </li> <li><a class='danger' href='javascript:void(0)' onclick='deleteCategory("+result['category']['id']+")'>Delete</a> </li></ul></nav></article>";
              $('.list').prepend(txt);

                $('#name').val('');
            }
        });

    });


});
function edit(id) {
    $.ajax({
        type:'GET',
        url: baseUrl+"/admin/blog/category/edit",
        data:{id:id},
        success:function (result) {

            $('#'+id).css("width", "10px");
            $('#'+id).animate({
                width: "200px"
            }, 500);
            $('#'+id).css("display", "inline-block");
            $('#'+id).css("margin-top", "20px");
            $('#'+id).val(result['category']['name']);
            $('#'+id).closest('article').css('border',"1px solid #58c73f");
            $('#cat_name'+id).fadeToggle();

           $('#edit'+id).text('Save');
            $('#edit'+id).attr('href',"javascript:void(0)");
            $('#edit'+id).attr('onclick','update('+id+')');
        }
    });

}
function update(id) {
    var name=document.getElementById(id).value;

    $.ajax({
        type:'GET',
        url: baseUrl+"/admin/blog/category/update",
        data:{id:id,name:name},
        success:function (result) {

            $('#'+id).css("width", "150px");
            $('#'+id).animate({
                width: "0px"
            }, 500);
            $('#'+id).css("display", "none");

            $('#cat_name'+id).text(result['category']['name']);
            $('#cat_name'+id).fadeToggle(1000);

            $('#edit'+id).text('Edit');
            $('#edit'+id).attr('href',"javascript:void(0)");
            $('#edit'+id).attr('onclick','edit('+id+')');
            $('#'+id).closest('article').css('border',"1px solid black");
        }
    });

}function deleteCategory(id) {

    $.ajax({
        type:'GET',
        url: baseUrl+"/admin/blog/category/delete",
        data:{id:id},
        success:function (result) {

            $('#cat_name'+id).text(result['message']);
            $('#cat_name'+id).css('color',"red");

            $('#'+id).closest('article').css('border',"2px solid red");
            $('#'+id).closest('article').fadeOut(900);
            // polja.animate({
            //     'background-color':"red"
            // },1000);
            // polja.fadeOut(2000);
        }
    });

}