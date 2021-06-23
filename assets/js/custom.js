function successmessage(heading, messge) {
    $.toast({
        heading: heading,
        text: messge,
        icon: 'success',
        position: 'top-right',
    });
}

function errormessage(heading, messge) {
	$.toast({
		heading: heading,
		text: messge,
		icon: 'error',
		position: 'top-right',

  });
}
$(document).ready(function () {

    $(document).on('change', '#profile_image', function () {
        CheckFileExtention(this);
    });

    var CheckFileExtention = function (input) {

        if (input.files) {
            $('.image_error').text("");
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(input.value)) {
                $('.image_error').show();
                $('.image_error').text('Please upload file having extensions .jpeg/.jpg/.png only.');
                input.value = '';
                return false;
            } else {
            $('.image_error').text('');
            }
        }

    };


    $('#modal-video').on('hidden.bs.modal', function (e) {
        $(".videodiv video")[0].pause(); 
        // $('#post_video').html('<source src="" type="video/mp4"></source>' );
        // $("#post_video video")[0].load();
    });

    $(document).on("click", "#playvideomdl", function() {
        var src = $(this).attr('data-src');
        $('.videodiv video source').attr('src',src );
        $(".videodiv video")[0].load();
        // $(".videodiv video")[0].play(); 
    });


    if($('#user-listing').length > 0){
        var dataTable = $('#user-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
            //'searching': false, // Remove default Search Control
                'ajax': {
                'url': base_url+'admin/user/showUserList',
                'data': function(data){
                }
            }
        });
    }

    if($('#country-listing').length > 0){
        var dataTable = $('#country-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/country/showCountryList',
                'data': function(data){
                }
            }
        });
    }

    if($('#video-listing').length > 0){
        var dataTable = $('#video-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/media/showMediaList',
                'data': function(data){
                }
            }
        });
    }

    if($('#comment-listing').length > 0){
        var dataTable = $('#comment-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/media/comment/showMediaCommentList',
                'data': function(data){
                }
            }
        });
    }

    if($('#gift-listing').length > 0){
        var dataTable = $('#gift-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/gift/showGiftList',
                'data': function(data){
                }
            }
        });
    }

    if($('#gift-cat-listing').length > 0){
        var dataTable = $('#gift-cat-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/gift/category/showGiftCategoryList',
                'data': function(data){
                }
            }
        });
    }

    if($('#coinpkg-listing').length > 0){
        var dataTable = $('#coinpkg-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/coin_package/showCoinPackageList',
                'data': function(data){
                }
            }
        });
    }

    if($('#offer-coinpkg-listing').length > 0){
        var dataTable = $('#offer-coinpkg-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/coin_package/offer/showCoinOfferList',
                'data': function(data){
                }
            }
        });
    }

    if($('#branding-image-listing').length > 0){
        var dataTable = $('#branding-image-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/coin_package/branding_image/showBrandingImageList',
                'data': function(data){
                }
            }
        });
    }

    if($('#campaign-listing').length > 0){
        var dataTable = $('#campaign-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/campaign/showCampaignList',
                'data': function(data){
                }
            }
        });
    }
       
    if($('#chat-profile-listing').length > 0){
        var dataTable = $('#chat-profile-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/chat/profile/showChatProfileList',
                'data': function(data){
                }
            }
        });
    }

    if($('#chat-message-listing').length > 0){
        var dataTable = $('#chat-message-listing').dataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            "order": [[ 0, "desc" ]],
                'ajax': {
                'url': base_url+'admin/chat/message/showChatMessageList',
                'data': function(data){
                }
            }
        });
    }


    $(document).on('change', '#country_media', function() {
        imagesPreview(this, '#photo_gallery');
    });
  
    $(document).on('change', '#video_file', function() {
        videoPreview(this, '#video_preview');
    });

    $(document).on('change', '#thumb_image', function() {
        imagesPreview(this, '#thumb_preview');
    });

    $(document).on('change', '#media_images', function() {
        multipleimagesPreview(this, '#photo_gallery',1);
    });

    $(document).on('change', '#media_videos', function() {
        multiplevideosPreview(this, '#video_gallery');
    });

    $(document).on('change', '#gift_cat_media', function() {
        imagesPreview(this, '#photo_gallery');
    });

    $(document).on('change', '#gift_media', function() {
        imagesPreview(this, '#photo_gallery');
    });

    $(document).on('change', '#coin_pkg_image', function() {
        imagesPreview(this, '#photo_gallery');
    });
    
    $(document).on('change', '#offer_coin_pkg_image', function() {
        imagesPreview(this, '#photo_gallery');
    });

    $(document).on('change', '#icon', function() {
        imagesPreview(this, '#icon_preview');
    });

    $(document).on('change', '#banner_image', function() {
        imagesPreview(this, '#banner_preview');
    });

    $(document).on('change', '#interestial_image', function() {
        imagesPreview(this, '#interestial_preview');
    });
    
    $(document).on('change', '#rewarded_video', function() {
        videoPreview(this, '#video_preview');
    });

    $(document).on('change', '#branding_image', function() {
        var Id = $('#branding_id').val();
        multipleimagesPreview(this, '#photo_gallery',0,Id);
    });

    $(document).on('change', '#profile_image', function() {
        imagesPreview(this, '#photo_gallery');
    });

    $(document).on('change', '#message_image', function() {
        imagesPreview(this, '#photo_gallery');
    });

    $(document).on('change', '#message_voice', function() {
        voicePreview(this, '#voice_image');
    });

    var imagesPreview = function(input, placeToInsertImagePreview) {
  
        if (input.files) {
            var filesAmount = input.files.length;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif|\.webp)$/i;
            var fileCategory = (input.value).split('.').pop().toLowerCase();
            var validImageCategorys = ["gif", "jpeg", "jfif", "png", "jpg", "webp"];

            if(!allowedExtensions.exec(input.value)){
                iziToast.error({
                    title: 'Error!',
                    message: 'Please upload correct file.',
                    position: 'topRight'
                });
                input.value = '';
                return false;
            }else{
  
                var reader = new FileReader();

                reader.onload = function(event) {
                    $(placeToInsertImagePreview).html('<div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><img src="'+event.target.result+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    };
  
    var videoPreview = function(input, placeToInsertImagePreview) {
  
        if (input.files) {
            var filesAmount = input.files.length;
            var allowedExtensions = /(\.mp4|\.mpeg|\.mpg|\.mov|\.avi|\.3gp|\.f4v|\.webm|\.vlc)$/i;

            if(!allowedExtensions.exec(input.value)){
                iziToast.error({
                    title: 'Error!',
                    message: 'Please upload correct file.',
                    position: 'topRight'
                });
                input.value = '';
                return false;
            }else{
  
                var reader = new FileReader();

                reader.onload = function(event) {
                    $(placeToInsertImagePreview).html('<div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><video width="150" height="150" class="displayimg1" controls=""> <source src="'+event.target.result+'" type="video/mp4"> </video> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    };
    var voicePreview = function(input, placeToInsertImagePreview) {
  
        if (input.files) {
            var filesAmount = input.files.length;
            var allowedExtensions = /(\.mp3|\.aac)$/i;

            if(!allowedExtensions.exec(input.value)){
                iziToast.error({
                    title: 'Error!',
                    message: 'Please upload correct file.',
                    position: 'topRight'
                });
                input.value = '';
                return false;
            }else{
  
                var reader = new FileReader();

                reader.onload = function(event) {
                    $(placeToInsertImagePreview).html('<audio controls> <source src="'+event.target.result+'" type="audio/mpeg"> </audio>');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    };

    var multipleimagesPreview = function(input, placeToInsertImagePreview,flag=0,Id=0) {
  
        if (input.files) {
            var filesAmount = input.files.length;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif|\.webp)$/i;
            for (i = 0; i < filesAmount; i++) {
                if(!allowedExtensions.exec(input.value)){
                    iziToast.error({
                        title: 'Error!',
                        message: 'Please upload correct file.',
                        position: 'topRight'
                    });
                    input.value = '';
                    return false;
                }else{
    
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        if(flag == 0 && Id != 0){
                            $(placeToInsertImagePreview).html('<div class="col-12 col-md-4 col-lg-4 mt-4"> <div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><img src="'+event.target.result+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_gallery_img">cancel</i></div> </div></div></div>');
                        }else{
                            $(placeToInsertImagePreview).append('<div class="col-12 col-md-4 col-lg-4 mt-4"> <div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><img src="'+event.target.result+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_gallery_img">cancel</i></div> </div></div></div>');
                        }
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    };

    var multiplevideosPreview = function(input, placeToInsertImagePreview,flag=0) {
  
        if (input.files) {
            var filesAmount = input.files.length;
            var allowedExtensions = /(\.mp4|\.mpeg|\.mpg|\.mov|\.avi|\.3gp|\.f4v|\.webm|\.vlc)$/i;
            for (i = 0; i < filesAmount; i++) {
                if(!allowedExtensions.exec(input.value)){
                    iziToast.error({
                        title: 'Error!',
                        message: 'Please upload correct file.',
                        position: 'topRight'
                    });
                    input.value = '';
                    return false;
                }else{
    
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $(placeToInsertImagePreview).append('<div class="col-12 col-md-4 col-lg-4 mt-4"> <div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><video width="150" height="150" class="displayimg1" controls=""> <source src="'+event.target.result+'" type="video/mp4"> </video> <div class="middle"><i class="material-icons remove_gallery_vid">cancel</i></div> </div></div></div>');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    };

    $(document).on('click','.remove_img', function(){

        var img_len = $('.borderwrap').length-1;
        var p_img = $(this).closest("div").parent().parent().attr('data-href');
        $(this).closest("div").parent().parent().remove();

    });

    
    $(document).on('click','.remove_gallery_img', function(){

        var img_len = $('.borderwrap').length-1;
        var p_img = $(this).closest("div").parent().parent().attr('data-href');
        $(this).closest("div").parent().parent().parent().remove();
  
        var upload_img = $('#hidden_media_images').val();
        var temp = upload_img.replace(p_img+",",'');
  
        if(upload_img == temp){
          var temp = upload_img.replace(p_img,'');
        }
        $('#hidden_media_images').val(temp);
        $('#hidden_media_images').attr('value',temp);
  
      });

      $(document).on('click','.remove_gallery_vid', function(){

        var img_len = $('.borderwrap').length-1;
        var p_img = $(this).closest("div").parent().parent().attr('data-href');
        $(this).closest("div").parent().parent().parent().remove();
  
        var upload_img = $('#hidden_media_videos').val();
        var temp = upload_img.replace(p_img+",",'');
  
        if(upload_img == temp){
          var temp = upload_img.replace(p_img,'');
        }
        $('#hidden_media_videos').val(temp);
        $('#hidden_media_videos').attr('value',temp);
  
      });

      
    $('#CountryModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateCountry")[0].reset();
        $('.modal-title').text('Add Country');
        $('#country_id').val(0);
        $('#country_media').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateCountry").validate();
        validator.resetForm();
    });

    $("#country-listing").on("click", ".UpdateCountry", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Country');
        var country = $(this).attr('data-name');
        $('#country_id').val($(this).attr('data-id'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#country').val(country);
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateCountry").validate({
        rules: {
            country: {
                required: true,
                remote: {
                    url: base_url+'admin/country/CheckExistCountry',
                    type: "post",
                    data: {
                        country: function () { return $("#country").val(); },
                        country_id: function () { return $("#country_id").val(); },
                    }
                }
            },
            country_media:{
                required:  {
                    depends: function(element) {
                        return ($('#country_id').val() == 0)
                    }
                },
                accept: "jpg|jpeg|png|jfif|webp",
            },
            "media_images[]":{
                required:  {
                    depends: function(element) {
                        return ($('#country_id').val() == 0)
                    }
                },
                accept: "jpg|jpeg|png|jfif|webp",
            },
            "media_videos[]":{
                required:  {
                    depends: function(element) {
                        return ($('#country_id').val() == 0)
                    }
                },
                accept: "mp4|mpeg|mpg|mov|avi|3gp|f4v|webm|vlc",
            }
        },
        messages: {
            country: {
                required: "Please Enter Country Name",
                remote: "Country already Exist"
            },
            country_media: {
                required: "Please Select Country File",
            },
            "media_images[]": {
                required: "Please Select Image Gallery",
            },
            "media_videos[]": {
                required: "Please Select Video Gallery",
            },
        }
    });

    $(document).on('submit', '#addUpdateCountry', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateCountry")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/country/addUpdateCountry',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#CountryModal').modal('hide');
                if (data.success == 1) {
                    $('#country-listing').DataTable().ajax.reload(null, false);
                    $('.total_country').text(data.total_country);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $('#CommentModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateComment")[0].reset();
        $('.modal-title').text('Add Country');
        $('#comment').val("");
        $('#comment_id').val("");
        $('#country_id').val("");
        var validator = $("#addUpdateComment").validate();
        validator.resetForm();
    });

    $("#comment-listing").on("click", ".UpdateComment", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Country');
        var comment = $(this).attr('data-name');
        $('#comment_id').val($(this).attr('data-id'));
        $('#country_id').val($(this).attr('data-country'));
        $('#comment').val(comment);
        $('.loader').hide();
    });

    $("#addUpdateComment").validate({
        rules: {
            comment: {
                required: true,
            },
            country_id: {
                required: true,
            }
        },
        messages: {
            comment: {
                required: "Please Enter Comment",
            },
            country_id: {
                required: "Please Select Country",
            }
        }
    });

    $(document).on('submit', '#addUpdateComment', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateComment")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/media/comment/addUpdateMediaComment',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#CommentModal').modal('hide');
                if (data.success == 1) {
                    $('#comment-listing').DataTable().ajax.reload(null, false);
                    $('.total_comment').text(data.total_comment);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $("#addUpdateMedia").validate({
        rules: {
            video_file: {
                required:  {
                    depends: function(element) {
                        return ($('#media_id').val() == 0)
                    }
                }
            },
            thumb_image: {
                required:  {
                    depends: function(element) {
                        return ($('#media_id').val() == 0)
                    }
                }
            },
            media_name: {
                required: true,
            },
            country_id: {
                required: true,
            },
            bio: {
                required: true,
            },
            rate: {
                required: true,
            }
        },
        messages: {
            video_file: {
                required: "Please Select Video File",
            },
            thumb_image: {
                required: "Please Select Thumbnail Image",
            },
            media_name: {
                required: "Please Enter Media Name",
            },
            country_id: {
                required: "Please Select Country",
            },
            bio: {
                required: "Please Enter Bio",
            },
            rate: {
                required: "Please Enter Rate",
            }
        },  
    });
  
    $(document).on('submit', '#addUpdateMedia', function (e) {
        e.preventDefault();
        var formdata = new FormData($("#addUpdateMedia")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/media/addUpdateMedia',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('.loader').hide();
                if (data.success == 1) {
                    window.location.href = base_url+'admin/media/list';
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                iziToast.error({
                    title: 'Error!',
                    message: data.message,
                    position: 'topRight'
                });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $('#GiftCategoryModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateGiftCategory")[0].reset();
        $('.modal-title').text('Add Gift Category');
        $('#gift_cat_id').val(0);
        $('#gift_cat_media').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateGiftCategory").validate();
        validator.resetForm();
    });

    $("#gift-cat-listing").on("click", ".UpdateGiftCategory", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Gift Category');
        var gift_cat_name = $(this).attr('data-name');
        $('#gift_cat_id').val($(this).attr('data-id'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#gift_cat_name').val(gift_cat_name);
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateGiftCategory").validate({
        rules: {
            gift_cat_name: {
                required: true,
                remote: {
                    url: base_url+'admin/gift/category/CheckExistGiftCategory',
                    type: "post",
                    data: {
                        gift_cat_name: function () { return $("#gift_cat_name").val(); },
                        gift_cat_id: function () { return $("#gift_cat_id").val(); },
                    }
                }
            }, 
            gift_cat_media:{
                required:  {
                    depends: function(element) {
                        return ($('#gift_cat_id').val() == 0)
                    }
                }
            }
        },
        messages: {
            gift_cat_name: {
                required: "Please Enter Category Name",
                remote: "Category already Exist"
            },
            gift_cat_media: {
                required: "Please Select Category Media",
            }
        }
    });

    $(document).on('submit', '#addUpdateGiftCategory', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateGiftCategory")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/gift/category/addUpdateGiftCategory',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#GiftCategoryModal').modal('hide');
                if (data.success == 1) {
                    $('#gift-cat-listing').DataTable().ajax.reload(null, false);
                    $('.total_gift_category').text(data.total_gift_category);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $('#GiftModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateGift")[0].reset();
        $('.modal-title').text('Add Gift Category');
        $('#gift_id').val(0);
        $('#coins').val("");
        $('#gift_cat_id').val("");
        $('#gift_media').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateGift").validate();
        validator.resetForm();
    });

    $("#gift-listing").on("click", ".UpdateGift", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Gift Category');
        var coins = $(this).attr('data-coins');
        $('#coins').val(coins);
        $('#gift_id').val($(this).attr('data-id'));
        $('#gift_cat_id').val($(this).attr('data-cat_id'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateGift").validate({
        rules: {
            coins: {
                required: true,
            }, 
            gift_media:{
                required:  {
                    depends: function(element) {
                        return ($('#gift_id').val() == 0)
                    }
                }
            }
        },
        messages: {
            coins: {
                required: "Please Enter Gift Coins",
            },
            gift_media: {
                required: "Please Select Gift Media",
            }
        }
    });

    $(document).on('submit', '#addUpdateGift', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateGift")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/gift/addUpdateGift',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#GiftModal').modal('hide');
                if (data.success == 1) {
                    $('#gift-listing').DataTable().ajax.reload(null, false);
                    $('.total_gift').text(data.total_gift);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $('#CoinPkgModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateCoinPkg")[0].reset();
        $('.modal-title').text('Add Coin Package');
        $('#coin_pkg_id').val(0);
        $('#coin_amount').val("");
        $('#price').val("");
        $('#playstore_product_id').val("");
        $('#coin_pkg_image').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateCoinPkg").validate();
        validator.resetForm();
    });

    $("#coinpkg-listing").on("click", ".UpdateCoinPkg", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Coin Package');
        var coin_amount = $(this).attr('data-coin_amount');
        $('#coin_amount').val(coin_amount);
        $('#coin_pkg_id').val($(this).attr('data-id'));
        $('#price').val($(this).attr('data-price'));
        $('#playstore_product_id').val($(this).attr('data-playstore_id'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateCoinPkg").validate({
        rules: {
            coin_amount: {
                required: true,
            }, 
            price: {
                required: true,
            },
            playstore_product_id: {
                required: true,
            },
            coin_pkg_image:{
                required:  {
                    depends: function(element) {
                        return ($('#coin_pkg_id').val() == 0)
                    }
                },
                accept: "jpg|jpeg|png|jfif|webp",
            }
        },
        messages: {
            coin_amount: {
                required: "Please Enter Coin Amount",
            },
            price: {
                required: "Please Enter Price",
            },
            playstore_product_id: {
                required: "Please Enter Playstore Product ID",
            },
            coin_pkg_image: {
                required: "Please Select Coin Package Media",
            }
        }
    });

    $(document).on('submit', '#addUpdateCoinPkg', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateCoinPkg")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/coin_package/addUpdateCoinPackage',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#CoinPkgModal').modal('hide');
                if (data.success == 1) {
                    $('#coinpkg-listing').DataTable().ajax.reload(null, false);
                    $('.total_coin_pkg').text(data.total_coin_pkg);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $('#OfferCoinPkgModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateOfferCoinPkg")[0].reset();
        $('.modal-title').text('Add Offer Coin Package');
        $('#offer_id').val(0);
        $('#coin_amount').val("");
        $('#price').val("");
        $('#playstore_product_id').val("");
        $('#coin_pkg_image').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateOfferCoinPkg").validate();
        validator.resetForm();
    });

    $("#offer-coinpkg-listing").on("click", ".UpdateOfferCoinPkg", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Offer Coin Package');
        var coin_amount = $(this).attr('data-coin_amount');
        $('#coin_amount').val(coin_amount);
        $('#offer_id').val($(this).attr('data-id'));
        $('#price').val($(this).attr('data-price'));
        $('#playstore_product_id').val($(this).attr('data-playstore_id'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateOfferCoinPkg").validate({
        rules: {
            coin_amount: {
                required: true,
            }, 
            price: {
                required: true,
            },
            playstore_product_id: {
                required: true,
            },
            offer_coin_pkg_image:{
                required:  {
                    depends: function(element) {
                        return ($('#offer_id').val() == 0)
                    }
                }
            }
        },
        messages: {
            coin_amount: {
                required: "Please Enter Coin Amount",
            },
            price: {
                required: "Please Enter Price",
            },
            playstore_product_id: {
                required: "Please Enter Playstore Product ID",
            },
            offer_coin_pkg_image: {
                required: "Please Select Offer Coin Package Media",
            }
        }
    });

    $(document).on('submit', '#addUpdateOfferCoinPkg', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateOfferCoinPkg")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/coin_package/offer/addUpdateCoinOffer',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#OfferCoinPkgModal').modal('hide');
                if (data.success == 1) {
                    $('#offer-coinpkg-listing').DataTable().ajax.reload(null, false);
                    $('.total_coin_pkg_offer').text(data.total_coin_pkg_offer);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $('#BrandingImgModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateBrandingImg")[0].reset();
        $('.modal-title').text('Add Branding Image');
        $('#branding_id').val(0);
        $('#branding_image').val("");
        $('#branding_image').addAttr('multiple');
        $('#photo_gallery').html('');
        var validator = $("#addUpdateBrandingImg").validate();
        validator.resetForm();
    });

    $("#branding-image-listing").on("click", ".UpdateBrandingImg", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Branding Image');
        $('#branding_id').val($(this).attr('data-id'));
        $('#branding_image').removeAttr('multiple');
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="col-12 col-md-4 col-lg-4 mt-4"><div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateBrandingImg").validate({
        rules: {
            "branding_image[]":{
                required:  {
                    depends: function(element) {
                        return ($('#branding_id').val() == 0)
                    }
                },
                accept: "jpg|jpeg|png|jfif|webp",
            }
        },
        messages: {
            "branding_image[]": {
                required: "Please Select Brnading Images",
            }
        }
    });

    $(document).on('submit', '#addUpdateBrandingImg', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateBrandingImg")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/coin_package/branding_image/addUpdateBrandingImage',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#BrandingImgModal').modal('hide');
                if (data.success == 1) {
                    $('#branding-image-listing').DataTable().ajax.reload(null, false);
                    $('.total_branding_img').text(data.total_branding_img);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $("#addUpdateAdmob").validate({
        rules: {
            publisher_id:{
                required:  true
            },
            banner_id:{
                required:  true
            },
            interestial_id:{
                required:  true
            },
            rewarded_id:{
                required:  true
            }
        },
        messages: {
            publisher_id: {
                required: "Please Enter Publisher Id",
            },
            banner_id: {
                required: "Please Enter Banner Id",
            },
            interestial_id: {
                required: "Please Enter Interestial Id",
            },
            rewarded_id: {
                required: "Please Enter Rewarded Id",
            }
        }
    });

    $(document).on('submit', '#addUpdateAdmob', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateAdmob")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/settings/addUpdateAdmob',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                if (data.success == 1) { 
                    $('.hidden_id').val(data.data);                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $("#addUpdateFacebook").validate({
        rules: {
            banner_id:{
                required:  true
            },
            interestial_id:{
                required:  true
            },
            rewarded_id:{
                required:  true
            }
        },
        messages: {
            banner_id: {
                required: "Please Enter Banner Id",
            },
            interestial_id: {
                required: "Please Enter Interestial Id",
            },
            rewarded_id: {
                required: "Please Enter Rewarded Id",
            }
        }
    });

    $(document).on('submit', '#addUpdateFacebook', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateFacebook")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/settings/addUpdateFacebook',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                if (data.success == 1) {                    
                    $('.hidden_id').val(data.data); 
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $("#addUpdateOther").validate({
        rules: {
            video_ad_bonus:{
                required:  true
            },
            log_in_bonus:{
                required:  true
            },
            refer_friend_bonus:{
                required:  true
            },
            seconds_for_ad:{
                required:  true
            },
            seconds_for_call:{
                required:  true
            },
            razorpay_key_id:{
                required:  true
            },
            razorpay_key_secret:{
                required:  true
            },
            more_apps_url:{
                required:  true
            },
            privacy_policy:{
                required:  true
            }
        },
        messages: {
            video_ad_bonus: {
                required: "Please Enter Video Ad Bonus",
            },
            log_in_bonus: {
                required: "Please Enter Log In Bonus",
            },
            refer_friend_bonus: {
                required: "Please Enter Refer Friend Bonus",
            },
            seconds_for_ad: {
                required: "Please Enter Seconds For Ad",
            },
            seconds_for_call: {
                required: "Please Enter Seconds For Call",
            },
            razorpay_key_id: {
                required: "Please Enter Razorpay Key Id",
            },
            razorpay_key_secret: {
                required: "Please Enter Razorpay Key Secret",
            },
            more_apps_url: {
                required: "Please Enter More Apps URL",
            },
            privacy_policy: {
                required: "Please Enter Privacy Ploicy",
            }
        }
    });

    $(document).on('submit', '#addUpdateOther', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateOther")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/settings/addUpdateOther',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                if (data.success == 1) {  
                    $('.hidden_id').val(data.data);                  
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });


    $(document).on('click','.device_type',function(){
        var device_type = $(this).val();
        if(device_type == 1){
            if ($(this).is(':checked')) {
                $('.andriod_url').removeClass('hide');
            }else{
                $('.andriod_url').addClass('hide');
            }
        }
        if(device_type == 2){
            if ($(this).is(':checked')) {
                $('.ios_url').removeClass('hide');
            }else{
                $('.ios_url').addClass('hide');
            }
        }
            
    });

    $("#addUpdateCampaign").validate({
        rules: {
            icon: {
                required:  {
                    depends: function(element) {
                        return ($('#campaign_id').val() == 0)
                    }
                }
            },
            banner_image: {
                required:  {
                    depends: function(element) {
                        return ($('#campaign_id').val() == 0)
                    }
                }
            },
            interestial_image: {
                required:  {
                    depends: function(element) {
                        return ($('#campaign_id').val() == 0)
                    }
                }
            },
            rewarded_video: {
                required:  {
                    depends: function(element) {
                        return ($('#campaign_id').val() == 0)
                    }
                }
            },
            title: {
                required: true,
            },
            button_text: {
                required: true,
            },
            "device_type[]": {
                required: true,
            },
            andriod_url: {
                required: true,
            },
            ios_url: {
                required: true,
            },
            description: {
                required: true,
            }
        },
        messages: {
            icon: {
                required: "Please Select Icon File",
            },
            banner_image: {
                required: "Please Select Banner Image",
            },
            interestial_image: {
                required: "Please Select Interestial Image",
            },
            rewarded_video: {
                required: "Please Select Rewarded Video",
            },
            title: {
                required: "Please Enter Campaign Title",
            },
            button_text: {
                required: "Please Enter Button Text",
            },
            "device_type[]": {
                required: "Please Select Device Type",
            },
            andriod_url: {
                required: "Please Enter Andriod URL",
            },
            ios_url: {
                required: "Please Enter Ios URL",
            },
            description: {
                required: "Please Enter Description",
            }
        },  
    });
  
    $(document).on('submit', '#addUpdateCampaign', function (e) {
        e.preventDefault();
        var formdata = new FormData($("#addUpdateCampaign")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/campaign/addUpdateCampaign',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('.loader').hide();
                if (data.success == 1) {
                    window.location.href = base_url+'admin/campaign/list';
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                iziToast.error({
                    title: 'Error!',
                    message: data.message,
                    position: 'topRight'
                });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $(document).on('change','.changeCampaignStatus',function(){
        var campaign_id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Changed it!';
        var btn = 'btn-danger';
        swal({
            title: "Are you sure?",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: btn,
            confirmButtonText: confirmButtonText,
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm){           
                
                $.ajax({
                    url: base_url+'admin/campaign/changeCampaignStatus',
                    data: {campaign_id:campaign_id,status:status},
                    type: 'POST',
                    cache : false,
                    dataType : 'json',
                    success: function ( data ) {
                        if(data.status == 1)
                        {
                            swal("Disable!", "Campaign Status Change successfully!", "success");
                            $('#campaign-listing').DataTable().ajax.reload(null, false);
                        }
                        else
                        {
                            errormessage('Error', 'Campaign Status Change failed');
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
    });
    

    $('#ChatProfileModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateChatProfile")[0].reset();
        $('.modal-title').text('Add Branding Image');
        $('#profile_id').val(0);
        $('#name').val("");
        $('#bio').val("");
        $('#profile_image').val("");
        $('#photo_gallery').html('');
        var validator = $("#addUpdateChatProfile").validate();
        validator.resetForm();
    });

    $("#chat-profile-listing").on("click", ".UpdateChatProfile", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Branding Image');
        $('#profile_id').val($(this).attr('data-id'));
        $('#name').val($(this).attr('data-name'));
        $('#bio').val($(this).attr('data-bio'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        if(media){
            $('#photo_gallery').append('<div class="col-12 col-md-4 col-lg-4 mt-4"><div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div></div>');
            
        }
        $('.loader').hide();
    });

    $("#addUpdateChatProfile").validate({
        rules: {
            name:{
                required: true
            },
            profile_image:{
                required:  {
                    depends: function(element) {
                        return ($('#profile_id').val() == 0)
                    }
                },
                accept: "jpg|jpeg|png|jfif|webp",
            },
            bio:{
                required: true
            },
        },
        messages: {
            name: {
                required: "Please Enter Profile Name",
            },
            profile_image: {
                required: "Please Select Profile Images",
            },
            bio: {
                required: "Please Enter Bio",
            }
        }
    });

    $(document).on('submit', '#addUpdateChatProfile', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateChatProfile")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/chat/profile/addUpdateChatProfile',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#ChatProfileModal').modal('hide');
                if (data.success == 1) {
                    $('#chat-profile-listing').DataTable().ajax.reload(null, false);
                    $('.total_chat_profile').text(data.total_chat_profile);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $(document).on('click','.message_type',function(){
        var type = $(this).val();
        if(type == 1){
            $('.type_image').removeClass('hide');
            $('.type_voice').addClass('hide');
            $('.type_text').addClass('hide');
        }
        if(type == 2){
            $('.type_image').addClass('hide');
            $('.type_voice').removeClass('hide');
            $('.type_text').addClass('hide');
        }
        if(type == 3){
            $('.type_image').addClass('hide');
            $('.type_voice').addClass('hide');
            $('.type_text').removeClass('hide');
        }  
    });

    $('#ChatMessageModal').on('hidden.bs.modal', function(e) {
        $("#addUpdateChatMessage")[0].reset();
        $('.modal-title').text('Add Chat Messages');
        $('#message_id').val(0);
        $('#message_type').val("");
        $('#content').val("");
        $('#message_image').val("");
        $('#message_voice').val("");
        $('.type_image').addClass("hide");
        $('.type_voice').addClass("hide");
        $('.type_text').addClass("hide");
        $('#photo_gallery').html('');
        $('#voice_image').html('');
        var validator = $("#addUpdateChatMessage").validate();
        validator.resetForm();
    });

    $("#chat-message-listing").on("click", ".UpdateChatMessage", function() {
        $('.loader').show();
        $('.modal-title').text('Edit Chat Messages');
       
        $('#message_id').val($(this).attr('data-id'));
        var type = $(this).attr('data-type');
        $('#message_type').val($(this).attr('data-type'));
        $('#content').val($(this).attr('data-content'));
        var media = $(this).attr('data-media');
        var url = $(this).attr('data-url');
        $('#photo_gallery').html('');
        $('#voice_image').html('');
        $('.type_image').addClass("hide");
        $('.type_voice').addClass("hide");
        $('.type_text').addClass("hide");
        if(type == 1){
            $('.type_image').removeClass("hide");
            if(media){
                $('#photo_gallery').append('<div class="col-12 col-md-4 col-lg-4 mt-4"><div class="borderwrap" data-href="'+media+'"><div class="filenameupload"><img src="'+url+''+media+'" width="130" height="130"> <div class="middle"><i class="material-icons remove_img">cancel</i></div> </div></div></div>');
                
            }
        }
        if(type == 2){
            $('.type_voice').removeClass("hide");
            if(media){
                $('#voice_image').append('<audio controls> <source src="'+url+media+'" type="audio/mpeg"> </audio>');
                
            }
        }
        if(type == 3){
            $('.type_text').removeClass("hide");
            $('#message_text').val(media);
        }
        $('.loader').hide();
    });

    $("#addUpdateChatMessage").validate({
        rules: {
            message_type:{
                required: true
            },
            message_image:{
                required:  {
                    depends: function(element) {
                        return ($('#message_id').val() == 0 && $('#message_type').val() == 1)
                    }
                },
            },
            message_voice:{
                required:  {
                    depends: function(element) {
                        return ($('#message_id').val() == 0 && $('#message_type').val() == 2)
                    }
                },
            },
            message_text:{
                required:  {
                    depends: function(element) {
                        return ($('#message_type').val() == 3)
                    }
                },
            },
            content:{
                required: true
            },
        },
        messages: {
            message_type: {
                required: "Please Select Message Type",
            },
            message_image: {
                required: "Please Select Message Image",
            },
            message_voice: {
                required: "Please Select Message Voice",
            },
            message_text: {
                required: "Please Enter Message Text",
            },
            content: {
                required: "Please Enter Bio",
            }
        }
    });

    $(document).on('submit', '#addUpdateChatMessage', function (e) {
        e.preventDefault();
        
        var formdata = new FormData($("#addUpdateChatMessage")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/chat/message/addUpdateChatMessage',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               
                $('.loader').hide();
                $('#ChatMessageModal').modal('hide');
                if (data.success == 1) {
                    $('#chat-message-listing').DataTable().ajax.reload(null, false);
                    $('.total_chat_message').text(data.total_chat_message);
                    
                    iziToast.success({
                        title: 'Success!',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error!',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });

    $("#sendNotification").validate({
        rules: {
            notification_title: {
            required: true,
          },
          notification_message: {
            required: true,
          },
        },
        messages: {
            notification_title: {
            required: "Please Enter Title",
          },
          notification_message: {
            required: "Please Enter Message",
          },
        },
  
      });
  
      $(document).on('submit', '#sendNotification', function (e) {
        e.preventDefault();
        var formdata = new FormData($("#sendNotification")[0]);
        $('.loader').show();
        $.ajax({
            url:  base_url+'admin/notification/sendNotification',
            type: 'POST',
            data: formdata,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('.loader').hide();
                $('#notification_message').val('');
                $('#notification_title').val('');
                $('#notify_image').val('');
                $("#photo_gallery").attr('style','display:none')
                if (data.success == 1) {
                    iziToast.success({
                    title: 'Success!',
                    message: data.message,
                    position: 'topRight'
                    });
                } else {
                    iziToast.error({
                    title: 'Error!',
                    message: data.message,
                    position: 'topRight'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
});

if($("#updateAdminProfile").length > 0){

    $('#updateAdminProfile').validate({
        rules: {
          admin_name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
          admin_name: {
                required: "Please enter userame",
            },
            email: {
                required: "Please enter email",
            },
            password: {
                required: "Please enter password",
            }
        },
    });

    $(document).on('submit', '#updateAdminProfile', function(e) {
      e.preventDefault();
      var formdata = new FormData($("#updateAdminProfile")[0]);
        $('.loader').show();
        $.ajax({
            url: base_url+'admin/login/updateadminprofile',
            type: "post",
            data: formdata,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                $('.loader').hide();
                if (response.status == 1) {
                  $('.author-box-name').text(response.admin_name);
                  $('.author-box-email').text(response.admin_email);
                  if(response.admin_profile){
                      $('.author-box-profile').attr('src',response.admin_profile_url);
                      $('.hdn_profile_image').val(response.admin_profile);
                  }
                  $("#profile_image").val('');

                  iziToast.success({
                    title: 'Success!',
                    message: 'Profile Updated Successfully',
                    position: 'topRight'
                  });
                } else {
                  iziToast.error({
                    title: 'Error!',
                    message: 'Profile Not Updated',
                    position: 'topRight'
                  });
                }
            },
        });
        return false;
    });

}

function deletedata(id,action_type)
{
    if(action_type == "user")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "country")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "comment")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "video")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "gift")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "gift_category")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "coin_package")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "offer_coin_package")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "branding_image")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "campaign")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "chat_profile")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }
    if(action_type == "chat_message")
    {  
        var text = 'You will not be able to recover this data!';   
        var confirmButtonText = 'Yes, Delete it!';
        var btn = 'btn-danger';
    }

    swal({
        title: "Are you sure?",
        text: text,
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: btn,
        confirmButtonText: confirmButtonText,
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm){

        $.ajax({
            url: base_url+'admin/dashboard/DeleteData',
            data: {id:id,action_type:action_type},
            type: "post",
            cache: false,
            dataType: "json",
            success: function ( data ) {

                if(data.success == 1)
                {
                    if(action_type == "country")
                    {
                        swal("Disable!", "Country has been disable!", "success");
                        $('#country-listing').DataTable().ajax.reload(null, false);
                        $('.total_country').text(data.total_country);
                    }
                    else if(action_type == "comment")
                    {
                        swal("Disable!", "Comment has been disable!", "success");
                        $('#comment-listing').DataTable().ajax.reload(null, false);
                        $('.total_comment').text(data.total_comment);
                    }
                    else if(action_type == "user")
                    {
                        swal("Disable!", "User has been disable!", "success");
                        $('#user-listing').DataTable().ajax.reload(null, false);
                        $('.total_user').text(data.total_user);
                    }
                    else if(action_type == "video")
                    {
                        swal("Disable!", "Video has been disable!", "success");
                        $('#video-listing').DataTable().ajax.reload(null, false);
                        $('.total_media').text(data.total_media);
                    }
                    else if(action_type == "gift")
                    {
                        swal("Disable!", "Gift has been disable!", "success");
                        $('#gift-listing').DataTable().ajax.reload(null, false);
                        $('.total_gift').text(data.total_gift);
                    }
                    else if(action_type == "gift_category")
                    {
                        swal("Disable!", "Gift Category has been disable!", "success");
                        $('#gift-cat-listing').DataTable().ajax.reload(null, false);
                        $('.total_gift_category').text(data.total_gift_category);
                    }
                    else if(action_type == "coin_package")
                    {
                        swal("Disable!", "Coin Pacakge has been disable!", "success");
                        $('#coinpkg-listing').DataTable().ajax.reload(null, false);
                        $('.total_coin_pkg').text(data.total_coin_pkg);
                    }
                    else if(action_type == "offer_coin_package")
                    {
                        swal("Disable!", "Offer Coin Pacakge has been disable!", "success");
                        $('#offer-coinpkg-listing').DataTable().ajax.reload(null, false);
                        $('.total_coin_pkg_offer').text(data.total_coin_pkg_offer);
                    }
                    else if(action_type == "branding_image")
                    {
                        swal("Disable!", "Branding Image has been disable!", "success");
                        $('#branding-image-listing').DataTable().ajax.reload(null, false);
                        $('.total_branding_img').text(data.total_branding_img);
                    }
                    else if(action_type == "campaign")
                    {
                        swal("Disable!", "Campaign has been disable!", "success");
                        $('#campaign-listing').DataTable().ajax.reload(null, false);
                        $('.total_campaign').text(data.total_campaign);
                    }
                    else if(action_type == "chat_profile")
                    {
                        swal("Disable!", "Chat Profile has been disable!", "success");
                        $('#chat-profile-listing').DataTable().ajax.reload(null, false);
                        $('.total_chat_profile').text(data.total_chat_profile);
                    }
                    else if(action_type == "chat_message")
                    {
                        swal("Disable!", "Chat Message has been disable!", "success");
                        $('#chat-message-listing').DataTable().ajax.reload(null, false);
                        $('.total_chat_message').text(data.total_chat_message);
                    }
                    else
                    {
                        swal("Delete!", "Your data has been deleted!", "success");
                    }
                }
            }
        });
      } else {
        swal("Cancelled", "Your imaginary file is safe :)", "error");
      }
    });
}
