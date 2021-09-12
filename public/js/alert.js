let forms = $('.delet-element');

$.each(forms, function( index, value ) {
    console.log("." + forms[index].className);
$("." + forms[index].className).on('submit',function (e) {

        console.log(forms[index]);
            swal({
            title: "تحذير",
            text: "هل انت متاكد من الحذف ؟",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'متأكد',
            cancelButtonText: 'الغاء'
            });
    e.preventDefault();            
    $('.confirm').on('click',function(){
        console.log( $("#" + forms[index].id));
        //    $("." + forms[index].id).unbind('submit').submit();
    }); 
    $('.cancel').on('click',function(){
    return;
    });
})
});




