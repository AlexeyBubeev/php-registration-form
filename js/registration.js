$(function(){

  var wrapper = $( ".file_upload" ),
  inp = wrapper.find( "input" ),
  btn = wrapper.find( "button" ),
  lbl = wrapper.find( "div" );

  btn.focus(function(){
    inp.focus()
  });
  // Crutches for the :focus style:
  inp.focus(function(){
    wrapper.addClass( "focus" );
  }).blur(function(){
    wrapper.removeClass( "focus" );
  });
  var file_api = ( window.File && window.FileReader && window.FileList && window.Blob ) ? true : false;
  inp.change(function(){
    var file_name;
    if( file_api && inp[ 0 ].files[ 0 ] ) 
      file_name = inp[ 0 ].files[ 0 ].name;
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


  $('#send').click(function(e){
    e.preventDefault();
    var valid = '';
    var required =' is required.';
    var login = $('#account_reg #login').val();
    var password = $('#account_reg #password').val();
    var rpassword = $('#account_reg #rpassword').val();
    var email = $('#account_reg #email').val();
    var honeypot = $('#account_reg #honeypot').val();
    var humancheck = $('#account_reg #humancheck').val();

    if(login = ''){
        valid ='<p> Your Name '+ required +'</p>';
    }
    if(password='' || company.length<=6){
        valid +='<p> Password '+ required +'</p>';
    }
    if(rpassword != password){
        valid +='<p> password must match </p>';
    }
    if(!email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i))
    {
        valid +='<p> Your Email' + required +'</p>';
    }

    if (honeypot != 'http://') {
        valid += '<p>Spambots are not allowed.</p>';    
    }

    if (humancheck != '') {
        valid += '<p>A human user' + required + '</p>'; 
    }

    if(valid !=''){
        $('#account_reg #response').removeClass().addClass("error")
        .html('<strong> Please Correct the errors Below </strong>' + valid).fadeIn('fast');
    }
    else{
        //$('form #response').removeClass().addClass('processing').html('Processing...').fadeIn('fast');
        var formData = $('#account_reg').serialize();
        $('#send').val("Please wait...");
        submitForm(formData);
    }
  });
  function submitForm(formData) {
    $.post('reg2.php',formData, function(data){
      //console.log(data);
      $('#send').val("Send");
      if (data === '1') {
        alert('ok!');
      }
      else {
        alert('wrong shit');
      }
    });
  };

});


