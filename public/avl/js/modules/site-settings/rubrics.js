$(document).ready(function() {
  $( "#datepicker" ).datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'yy-mm-dd',
    yearRange: "2000:",
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
  });

  // upload image rubric
  $('#upload--photos').uploadifive({
      'auto'			: true,
      'removeCompleted' : true,
      'buttonText'	: 'Выберите Изображение',
      'height'	    : '100%',
      'width'			: '100%',
      'checkScript'	: '/admin/ajax/check',
      'uploadScript'	: '/admin/ajax/rubrics-images',
      'fileType'		: 'image/*',
      'formData'		: {
          '_token'      : $('meta[name="_token"]').attr('content'),
          'rubric_id'	  : $('#rubric_id').val(),
       },
      'folder'		: '/uploads/tmps/',

      'onUploadComplete' : function( file, data ) {
          var $data = JSON.parse(data);
          if ($data.success) {
              var html =
              '<li id="mediaSortable_' + $data.file.id + '" class="col-md-2 float-left ui-sortable-handle">'+
                  '<div class="card">'+
                      '<div class="card-header">'+
                        '<div class="row">'+
                          '<div class="col-lg-4 col-md-4 col-sm-4 text-center"> <a href="#" class="change--status" data-model="Media" data-id="' + $data.file.id + '"><i class="fa fa-eye"></i></a> </div>'+
                          '<div class="col-lg-4 col-md-4 col-sm-4 text-center"> <a href="#" class="toMainPhoto" data-model="Media" data-id="' + $data.file.id + '"><i class="fa fa-circle-o"></i></a> </div>'+
                          '<div class="col-lg-4 col-md-4 col-sm-4 text-center"> <a href="#" class="deleteMedia" data-model="Media" data-id="' + $data.file.id + '"><i class="fa fa-trash-o"></i></a> </div>'+
                        '</div>'+
                      '</div>'+
                      '<div class="card-body p-0"><img src="/image/resize/260/230/' + $data.file.src + '"></div>'+
                      '<div class="card-footer p-0 bg-white">'+
                            '<ul class="nav nav-tabs">';
                              $.each($data.file.langs, function($key, $value) {
                                  var active = ($value.key == 'ru') ? 'active show' : '';
                                  html += '<li class="nav-item p-0">'+
                                  '<a class="nav-link ' + active + '" href="#tab--title-item-' + $data.file.id + '-' + $value.key + '" data-toggle="tab" aria-expanded="false">'+
                                      $value.key +
                                  '</a></li>';
                              });
                            html +=
                            '</ul>'+
                            '<div class="tab-content">';
                                $.each($data.file.langs, function($key, $value) {
                                    var active = ($value.key == 'ru') ? 'active' : '';
                                    html += '<div class="p-0 tab-pane ' + active + '" id="tab--title-item-' + $data.file.id + '-' + $value.key + '">'+
                                              '<textarea class="form-control border-0 media--' + $data.file.id + '" data-lang="' + $value.key + '" placeholder="' + $value.key + '">'+ $data.file.title_ru +'</textarea>'+
                                              '<button type="button" class="btn btn-primary btn-sm btn-block save--media-content" data-id="' + $data.file.id + '">Save</button>'+
                                            '</div>';
                                });
                            html += '</div>'+
                      '</div>'+
                  '</div>'+
              '</li>';
              $('#sortable').prepend(html);
          }

          if ($data.errors) {
              messageError($data.errors);
          }
      }
  });

  // upload files
  $('#upload--files').uploadifive({
        'auto'			: true,
        'removeCompleted' : true,
        'buttonText'	: 'Выберите файл для загрузки',
        'height'	    : '100%',
        'width'			: '100%',
        'checkScript'	: '/admin/ajax/check',
        'uploadScript'	: '/admin/ajax/rubrics-files',
        'folder'		: '/uploads/tmps/',
        'onUpload'     : function(filesToUpload) {
            $('#upload--files').data('uploadifive').settings.formData = {
                '_token'      : $('meta[name="_token"]').attr('content'),
                'rubric_id'	  : $('#rubric_id').val(),
                'lang'        : $("#select--language-file").val()
            };
        },
        'onUploadComplete' : function( file, data ) {
            var $data = JSON.parse(data);
            if ($data.success) {
                var html =
                  '<li class="col-md-12 list-group-item files--item" id="mediaSortable_' + $data.file.id + '">'+
                    '<div class="img-thumbnail">'+
                      '<div class="input-group">'+
                        '<div class="input-group-prepend">'+
                          '<span class="input-group-text" style="cursor: move;"><img src="/avl/img/icons/flags/' + $data.file.lang + '--16.png" alt=""></a></span>'+
                          '<span class="input-group-text"><a href="#" class="good" data-model="Media" data-id="' + $data.file.id + '"><i class="fa fa-eye"></i></a></span>'+
                          '<span class="input-group-text"><a href="/file/save/' + $data.file.id + '" target="_blank"><i class="fa fa-download"></i></a></span>'+
                          '<span class="input-group-text"><a href="#" class="deleteMedia" data-model="Media" data-id="' + $data.file.id + '"><i class="fa fa-trash-o"></i></a></span>'+
                        '</div>'+
                        '<input type="text" id="title--' + $data.file.id + '" class="form-control" name="" value="' + $data.file['title_' + $data.file.lang] + '">'+
                        '<div class="input-group-append">'+
                          '<span class="input-group-text"><a href="#" class="save--file-name" data-id="' + $data.file.id + '"><i class="fa fa-floppy-o"></i></a></span>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</li>';
                $('#sortable-files').prepend(html);
            }

            if ($data.errors) {
                messageError($data.errors);
            }
        }
    });

  $("body").on('click', '.deleteMedia', function(e) {
    e.preventDefault();
    var self       = $(this),
        id         = self.data('id'),
        model      = self.data('model');
    $.ajax({
        url: '/admin/ajax/deleteMedia/'+ id,
        type: 'POST',
        async: false,
        dataType: 'json',
        data : { _token: $('meta[name="_token"]').attr('content'), model: model},
        success: function(data) {
            if (data.errors) {
                messageError(data.errors);
            } else {
                self.parents('#mediaSortable_' + id).remove();
            }
        }
    });
  });

  // Save filename
  $("body").on('click', '.save--file-name', function(e) {
    e.preventDefault();
    var id         = $(this).attr('data-id');
    var title      = $("#title--" + id).val();
    console.log(title);

    $.ajax({
        url: '/admin/ajax/saveFileName/'+ id,
        type: 'POST',
        async: false,
        dataType: 'json',
        data : { _token: $('meta[name="_token"]').attr('content'), title: title},
        success: function(data) {
          if (data.errors) {
            messageError(data.errors);
          } else {
            messageSuccess(data.success);
          }
        }
    });
  });

  $("body").on('click', '.toMainPhoto', function(e) {
    e.preventDefault();
    var self       = $(this),
        id         = self.data('id'),
        model      = self.data('model');
    $.ajax({
        url: '/admin/ajax/mainPhoto/'+ id,
        type: 'POST',
        async: false,
        dataType: 'json',
        data : { _token: $('meta[name="_token"]').attr('content'), news_id: $("#news_id").val(), model: model},
        success: function(data) {
            if (data.errors) {
                messageError(data.errors);
            } else {
                $(".toMainPhoto i.fa").removeClass('fa-check-circle-o').addClass('fa-circle-o');
                self.find('i.fa').removeClass('fa-circle-o').addClass('fa-check-circle-o');
            }
        }
    });
  });

});
