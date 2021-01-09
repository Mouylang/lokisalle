
$(document).ready(function(){

    $('.js-btn-delete-room').on('click',function(){
        let idToDelete = this.value;
        $('.js-confirm-suppression').attr('href','/room/'+ idToDelete +'/delete' )
    });


}

);