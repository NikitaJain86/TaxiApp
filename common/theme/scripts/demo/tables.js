/* ==========================================================
 * AdminKIT v1.5
 * tables.js
 * 
 * http://www.mosaicpro.biz
 * Copyright MosaicPro
 *
 * Built exclusively for sale @Envato Marketplaces
 * ========================================================== */ 

$(function()
{
    /* DataTables */
    if ($('.dynamicTable').size() > 0)
    {
        $('.dynamicTable').dataTable({
            "sPaginationType": "bootstrap",
            "fnDrawCallback": function( oSettings ) {
                        
                $(".notybutton").on("click",function(){
                    $("#gcm_id").val($(this).attr("id"));
                    $("#modal-noty").modal("show");
            
                });
                
                $(".editCat").on("click",function(){
                    $("#cat_id").val($(this).attr("id"));
                    $("#modal-cat").modal("show");
            	
                });
                
                 $(".deleteCat").off();
                
                $(".deleteCat").on("click",function(){
                   
		var did=$(this).attr("id");
bootbox.confirm("Are you sure?", function(result) 
{
	if(result){
	
		$.ajax({
                url: "./helper.php",
                type: 'POST',
                data: "action=DELETE_CAT&id="+did,
                success: function(data, textStatus, xhr) {
                $("#c"+did).fadeOut();
                     $.gritter.add({
                        title: "Success!",
                        text: data
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    $.gritter.add({
                        title: "Error",
                        text: "Please try later!!!"
                    });
                    return false;
                }
            });
	}
});


                });
                
                $(".mCatActive").change(function(){
                    if($(this).is(":checked")){
                        changeCatAccess("ACTIVE_CAT",$(this).attr("id"),$(this));
                
                    }else{
                        changeCatAccess("DEACTIVE_CAT",$(this).attr("id"),$(this));
                    }
                });
    
               
                $(".mActive").bind("change",function(event){
                    if($(this).is(":checked")){
                        changeUserAccess("ACTIVE",$(this).attr("id"),$(this));
                
                    }else{
                        changeUserAccess("DEACTIVE",$(this).attr("id"),$(this));
                    }
                    event.preventDefault();
                    event.stopPropagation();
                    return true;
                }); 
            },
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        });
                
        function changeUserAccess(type,id,act){
            $.ajax({
                url: "./helper.php",
                type: 'POST',
                data: "action="+type+"&id="+id,
                success: function(data, textStatus, xhr) {
                    
                },
                error: function(xhr, textStatus, errorThrown) {
                    $.gritter.add({
                        title: "Error",
                        text: "Please try later!!!"
                    });
                    return false;
                }
            });
        }
        function changeCatAccess(type,id,act){
            $.ajax({
                url: "./helper.php",
                type: 'POST',
                data: "action="+type+"&id="+id,
                success: function(data, textStatus, xhr) {
                    $.gritter.add({
                        title: "Success",
                        text: data
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    $.gritter.add({
                        title: "Error",
                        text: "Please try later!!!"
                    });
                    return false;
                }
            });
        }
        
        
    }
});