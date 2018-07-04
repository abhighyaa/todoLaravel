$(document).ready(function(){
    $("#toggleable").hide();
    $(".onhover").hide();
    $("body").on('click','#toggle',function(){
        $("#toggleable").toggle();
        $("#A").toggleClass("A col-md-3");
    });

    $("body").on('keyup','#search',function(){
        var str = $(this).val();
        
            
        
        $.ajax({
            type:'POST',
            url:"/search",
            data: { 
                _token : $('meta[name="csrf-token"]').attr('content'), 
                'val': str 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            // data:'_token = <?php echo csrf_token() ?>',
            success:function(data){
               
                res ="";
                for (i in data["msg"]){
                   res +=  '<div class="task">\
                                <a href="/task/'+data.msg[i].id+'"><h3>\
                                <b>'+ data.msg[i].task+'</b></h3></a><br>\
                                '+ data.msg[i].description+'\
                                <br><br><br><hr><br>\
                            </div>';
                }
                
                    // res += data.msg[i];
                //console.log(count(data["msg"]));
              $(".card-body").html(res);
            },
            error:function(){
                $(".content").html("An error has occured !");
            } 
         });
    });

    $(".old").click(function(){
        $("#old").show();
    });

    $(".delete").click(function(){
        text=$(this).next().html();
        // alert(text);
        $.ajax({
            type:'POST',
            url:"/delete/label",
            data: { 
                _token : $('meta[name="csrf-token"]').attr('content'), 
                'label': text
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            // data:'_token = <?php echo csrf_token() ?>',
            success:function(data){
                //console.log(data);
               location.reload(true);
               alert("Deleted");
            },
            error:function(){
                alert("An error has occured !");
            } 
         
        });
    });

    var changed;
    $("body").on('click','.editlab',function(){
        changed=$(this).prev().text();
        $(this).prev().text("");
        $(this).prev().append('<input autofocus class="width" placeholder="'+changed+'">\
        &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" id="changed">Done</button>');
        
    });

    $("body").on('click','#changed',function(){
        newlabel = $(".width").val();
       
        if(newlabel!=""){
            // alert(newlabel);
            // alert(changed);
            $.ajax({
                type:'POST',
                url:"/change/label",
                data: { 
                    _token : $('meta[name="csrf-token"]').attr('content'), 
                    'label': changed,
                    'newlabel': newlabel 
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                
                success:function(data){
                    //console.log(data);
                    location.reload(true);
                },
                error:function(){
                    alert("An error has occured !");
                } 
            
            });

        }
    });

    $("body").on('mouseover','.task',function(){
        $(".onhover").show();
        $(".check").hide();
    });
    $("body").on('mouseleave','.task',function(){
        $(".onhover").hide();
        $(".check").show();
    });

    $("body").on('click','.deletetask',function(){
        id=$(this).next().text();
        
        if(confirm("Are you sure you want to delete a note?(Can be restored from bin within a week)"))
            window.location.replace("/delete/"+id);
        else
            window.reload(true);
    });


    $("body").on('click','.deletecompletely',function(){
        id=$(this).next().text();
        
        if(confirm("Are you sure you want to delete a note?\nIt will never be recovered then!!"))
            window.location.replace("/deletecompletely/"+id);
        else
            window.reload(true);
    });
    $(".close").hide();
    $("body").on('mouseover',".labelshow",function(){
        $(this).children(".close").show();
    });
    $("body").on('mouseleave',".labelshow",function(){
        $(".close").hide();
    });

    closebtns = document.getElementsByClassName("close");
    var i;

    for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function() {
        label = $(this).prev().text();
        task = $(this).next().text();
        $.ajax({
            type:'POST',
            url:"/remove/"+task+"/"+label,
            data: { 
                _token : $('meta[name="csrf-token"]').attr('content'), 
                'label': label,
                'task': task 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            
            success:function(data){
                //console.log(data);
                location.reload(true);
            },
            error:function(){
                alert("An error has occured !");
            } 
        
        });
        this.parentElement.style.display = 'none';
    });
    }
    $(".toadd").hide();
    $("body").on('click',".addlabel",function(){
        $(this).next().show();
    })

    $("body").on('change','.toaddcheck',function(){
        label = $(this).val();
        task =  $(this).next().text();
        $.ajax({
            type:'POST',
            url:"/add/"+label+"/to/"+task,
            data: { 
                _token : $('meta[name="csrf-token"]').attr('content'), 
                'label': label,
                'task': task 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            
            success:function(data){
                //console.log(data);
                location.reload(true);
            },
            error:function(){
                alert("An error has occured !");
            } 
        
        });
    });
   
    if(($(".undo").attr("src"))=="/images/finallydone.png"){
        $(".undo").parents(".strike").siblings("#title").children().children().addClass("strikethrough");
    }

    $("body").on('dblclick',".task",function(){
        task = $(this).next().text();
        window.location.replace("/task/"+task+"/edit");
    });

    // $('#sortable').sortable({
    //     start : function(event, ui) {
    //         var start_pos = ui.item.index();
    //         ui.item.data('start_pos', start_pos);
    //     },
    //     update : function(event, ui) {
    //         var index = ui.item.index();
    //         var start_pos = ui.item.data('start_pos');
            
    //         //update the html of the moved item to the current index
    //         $('#sortable li:nth-child(' + (index + 1) + ')').html(index);
            
    //         if (start_pos < index) {
    //             //update the items before the re-ordered item
    //             for(var i=index; i > 0; i--){
    //                 $('#sortable li:nth-child(' + i + ')').html(i - 1);
    //             }
    //         }else {
    //             //update the items after the re-ordered item
    //             for(var i=index+2;i <= $("#sortable li").length; i++){
    //                 $('#sortable li:nth-child(' + i + ')').html(i-1);
    //             }
    //         }
    //     },
    //     axis : 'y'
    // });
 });


