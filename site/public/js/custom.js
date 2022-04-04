// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................

//Contact Send

function  SendContact(ContactName,ContactMobile,ContactEmail,ContactMsg){
    if(ContactName.length == 0){
        toastr.error('Name is Empty !');
    }else if(ContactMobile.length == 0){
        toastr.error('Mobile Number is Empty !');
    }else if(ContactEmail.length == 0){
        toastr.error('Email  is Empty !');
    }else if(ContactMsg.length == 0){
        toastr.error('Message  is Empty !');
    }else{
        axios.post('/contactsend',{
            contact_name:
            contact_mobile:
            contact_email:
            contact_msg:
        })
            .then(function(response){}).catch(function(error){});
    }
}
