$(function(){

/* nice img */

/*** nice img ***/

/* nice input type[file] */

  var wrapper = $( ".file_upload" ),
  inp = wrapper.find( "input" ),
  btn = wrapper.find( "button" ),
  lbl = wrapper.find( "div" );

  btn.focus(function(){
    inp.focus()
  });

  inp.focus(function(){
    wrapper.addClass( "focus" );
  }).blur(function(){
    wrapper.removeClass( "focus" );
  });
  var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;
  inp.change(function(){
    $("#label_image").children('span').empty();
    lbl.text('Файл не выбран');
    var file_name;
    if( file_api && inp[ 0 ].files[ 0 ] ) { // проверка файла
      file_name = inp[ 0 ].files[ 0 ].name;
      imagefile = inp[ 0 ].files[ 0 ].type;
      file_size = inp[ 0 ].files[ 0 ].size;
      var match= ["image/jpeg","image/png","image/jpg","image/gif"];
      if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))) {
        $('#label_image').children('span').text('Выбранный файл не является изображением');
        return false;
      }
      if(file_size > 524288) {
        $('#label_image').children('span').text('Размер файла не должен превышать 500Кб');
        return false;
      }

    }
    else
      file_name = inp.val().replace( "C:\\fakepath\\", '' );
    if( ! file_name.length ) return;
    if( lbl.is( ":visible" ) ){
      lbl.text( file_name );
      btn.text( "Выбрать" );
    }
    else btn.text( file_name );
  }).change();

  $( window ).resize(function(){
    $( ".file_upload input" ).triggerHandler( "change" );
  });

/*** nice input type[file] ***/

/* form tabs */
  $('.tab a').on('click', function (e) {
    e.preventDefault();
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    target = $(this).attr('href');
    $('.tab-content > div').not(target).hide();
    $(target).fadeIn(600);
    if ($('#login_tab').hasClass("active")){ // скрываем поля регистрации для формы входа
      $('.signup_label').hide();
      $('#go_submit').text('Войти');
      $('#type_id').val(2);
    }
    else{
      $('.signup_label').show();
      $('#go_submit').text('Зарегистрироваться');
      $('#type_id').val(1);
    }
  });
/*** form tabs ***/

/* form validation + submit */

  $('.v_input').change(function(){ // чистим error
    $(this).parent().children('span').empty().fadeOut('fast');
  });

  $('#go_submit').click(function(e){
    e.preventDefault();

    if($('#name_id').val().length == 0){
      $('#label_name').children('span').text('Это поле должно быть заполнено.').fadeIn('fast');
      return;
    }
    if($('#password_id').val().length == 0){
      $('#label_password').children('span').text('Это поле должно быть заполнено.').fadeIn('fast');
      return;
    }
    if($('#password_id').val().length<=6){
      $('#label_password').children('span').text('Слабый пароль. Пароль должен быть больше 6 символов.').fadeIn('fast');
      return;
    }
    if ($('#signup_tab').hasClass("active")){ // не проверяем поля регистрации для входа
      if(!$('#email_id').val().match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)){
        $('#label_email').children('span').text('Проверьте, правильно ли заполнено поле.').fadeIn('fast');
        return;
      }
    }
    //var formData = $('#form_reg').serialize();
//  formDatfa = new FormData(this);
//  $('#main_status').text('Пожалуйста подождите,ваш запрос обрабатывается...').fadeIn('fast');
//  submitForm(formDatfa);
    $('#form_reg').submit();
  });
/*
  function submitForm(formData) {
    $.post('registration.php',formData, function(data){
      //console.log(data);
      $("#main_status").html(data);

      if (data === '1') {
        alert('ok!');
      }
      else {
        alert('wrong shit');
      }
    });
  };

  function submitForm(formData) {
    $.ajax({
      url: "registration.php", // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      async: false,
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData: false,        // To send DOMDocument or non processed data file it is set to false
      success: function(data) {
        //$('#main_status').fadeOut('fast');
        $("#main_status").html(data);
      }
    });
  };
*/
/*** form validation + submit ***/




});


