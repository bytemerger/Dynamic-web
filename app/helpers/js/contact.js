function saveHeadImage(id){
    var Img = document.getElementById(id);
    const data = new FormData();
    data.append("headerImg", Img.files[0]);
    data.append("headId", id);
    console.log(Img.files);
    $.ajax({
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {

            alert(data);
            setTimeout(function(){// wait for 5 secs(2)
                location.reload(); // then reload the page.(3)
            }, 500);


        }
    });
    document.getElementById(id).value ='';
}

function edit(id) {
    $('.'+id).summernote({focus: true, height: 150});
}

function save(id) {
    var text = [];
    $('.' + id).each(function (index) {
        text[index] = $(this).summernote('code');
        console.log(text);
        $(this).summernote('destroy');

    });
    $.ajax({
        method: 'POST',
        data: {
            id: id,
            title: text[0],
            content: text[1]

        },
        success: function (data) {
            alert(data);
            $("#contact").load(location.href + " #contact");
        }
    });
}
