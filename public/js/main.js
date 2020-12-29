
var url = 'http://proyecto-laravel-master.com.devel/';
window.addEventListener('load',function(){

    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    // boton de like 

        function like(){

            $('.btn-like').unbind('click').click(function(){
                
                $(this).addClass('btn-dislike').removeClass('btn-like');
                $(this).attr('src',url +'img/heart-red.png');


                $.ajax({
                url:url +'like/'+$(this).data('id'),
                type:'GET',
                }).done(function(response){

                     if(response.like){
                        console.log('has dado like a la publicacion')
                     }else{
                        console.log('error al dar like')
                     }
                    

                })

                dislike();
            })
        }
        like();
    //boton de dislike
        function dislike(){
                

                $('.btn-dislike').unbind('click').click(function(){
                    
                    $(this).addClass('btn-like').removeClass('btn-dislike');
                    $(this).attr('src',url +'/img/heart-black.png');


                    $.ajax({
                        url:url +'dislike/'+$(this).data('id'),
                        type:'GET',
                        }).done(function(response){
        
                             if(response.like){
                                console.log('has dado dislike a la publicacion')
                             }else{
                                console.log('error al dar dislike')
                             }
                            
        
                        })

                    like();
                })

            }
       

        dislike();
    })