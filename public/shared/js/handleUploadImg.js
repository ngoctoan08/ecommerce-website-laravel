
$(document).ready(function(){
    // Lắng nghe sự kiện khi người dùng chọn ảnh
    document.getElementById('trigger_file').addEventListener('click', () => {
        document.getElementById('img_feedback').click()
    })

    $('#img_feedback').change(function(event){
        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var imageUrl = URL.createObjectURL(files[i]);
            var img = $('<img>').attr('src', imageUrl);
            $('#uploadedImages').append(img);
        }
    });
});