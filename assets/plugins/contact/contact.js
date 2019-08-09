
jQuery(document).ready(function($) {
    "use strict";

    //Contact
    $('form.contactForm').submit(function(){
        $('button#btn-submit').html('Sending Message <i class="fa fa-refresh fa-spin"></i>');
        var f = $(this).find('.form-group'),
            ferror = false,
            emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i,
            phoneExp = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        f.children('input,select').each(function(){ // run all inputs

            var i = $(this); // current input
            var rule = i.attr('data-rule');

            if( rule !== undefined ){
                var ierror=false; // error flag for current input
                var pos = rule.indexOf( ':', 0 );
                if( pos >= 0 ){
                    var exp = rule.substr( pos+1, rule.length );
                    rule = rule.substr(0, pos);
                }else{
                    rule = rule.substr( pos+1, rule.length );
                }

                switch( rule ){
                    case 'required':
                        if( i.val()==='' ){ ferror=ierror=true; }
                        break;

                    case 'minlen':
                        if( i.val().length<parseInt(exp) ){ ferror=ierror=true; }
                        break;

                    case 'email':
                        if( !emailExp.test(i.val()) ){ ferror=ierror=true; }
                        break;

                    case 'checked':
                        if( !i.attr('checked') ){ ferror=ierror=true; }
                        break;

                    case 'regexp':
                        exp = new RegExp(exp);
                        if( !exp.test(i.val()) ){ ferror=ierror=true; }
                        break;
                    case 'phone':
                        ferror = ierror = !phoneExp.test(i.val());
                        break;
                }
                i.next('.validation').html( ( ierror ? (i.attr('data-msg') !== undefined ? i.attr('data-msg') : 'Wrong Input') : '' ) ).show('blind');
            }
        });
        f.children('textarea').each(function(){ // run all inputs

            var i = $(this); // current input
            var rule = i.attr('data-rule');

            if( rule !== undefined ){
                var ierror=false; // error flag for current input
                var pos = rule.indexOf( ':', 0 );
                if( pos >= 0 ){
                    var exp = rule.substr( pos+1, rule.length );
                    rule = rule.substr(0, pos);
                }else{
                    rule = rule.substr( pos+1, rule.length );
                }

                switch( rule ){
                    case 'required':
                        if( i.val()==='' ){ ferror=ierror=true; }
                        break;

                    case 'minlen':
                        if( i.val().length<parseInt(exp) ){ ferror=ierror=true; }
                        break;
                }
                i.next('.validation').html( ( ierror ? (i.attr('data-msg') != undefined ? i.attr('data-msg') : 'Wrong Input') : '' ) ).show('blind');
            }
        });
        if( ferror ) return false;
        else var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "contact/form_post",
            data: str,
            success: function(msg){
                // alert(msg);
                if(msg == 'OK') {
                    $('button#btn-submit').html('Message Sent').css({'background':'#92ffa6'}).attr('type','button');
                    $("#sendmessage").addClass("show");
                    $("#errormessage").removeClass("show");
                    $('.contactForm').find("input, textarea").val("");
                }
                else {
                    $('button#btn-submit').html('Send Message');
                    $("#sendmessage").removeClass("show");
                    $("#errormessage").addClass("show");
                    $('#errormessage').html(msg);
                }

            }
        });
        return false;
    });

});