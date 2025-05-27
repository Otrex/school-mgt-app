var image_crop = $('.image-crop').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('.crop-wrapper').hide();
$('#change').hide();
$('#submit').hide();
$('.profile-image').on('change', function () {
    $('.crop-wrapper').show();
    $('#change').show();
    $('cropped-image').show();
    $('.display-picture').hide();

    var reader = new FileReader();

    reader.onload = function (e) {
        image_crop.croppie('bind', {
            url: e.target.result
        }).then(function () {
            console.log('jQuery bind complete');
            console.log(reader.readAsDataURL(this.files[0]));
        });
    };

    reader.readAsDataURL(this.files[0]);
});

$('#change').on('click', function (ev) {
    image_crop.croppie('result', {
        type: 'base64',
        size: 'viewport'
    }).then(function (blob) {
        // Hide cropper view
        $('.crop-wrapper').hide();
        $('#submit').show();

        var crop_img = document.getElementById('crop-img');

        // set the cropped image blob to a hidden field
        crop_img.value = blob.slice(22);

        // preview the cropped image
        $('#preview').attr("src", blob);
        crop_img.dispatchEvent(new Event('input'));
    });
});

$('.remove').on('click', function (ev) {
    $('.display-picture').show();
    $('.crop-wrapper').hide();
});
