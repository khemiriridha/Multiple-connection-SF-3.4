$(function(){
    function onSuccess(){
        $("#cp_photo").parent("a").find("span").html("Choose another photo");
        var img = $("#cp_target").find("#crop_image")
        if(img.length === 1){ 
 
            $("#cp_img_path").val(img.attr("src"));
			$("#tbl_admin_logo").val(img.attr("src"));//
			$("#tbl_user_photo").val(img.attr("src"));
            img.cropper({aspectRatio: 1,
                        done: function(data) {
                            $("#ic_x").val(data.x);
                            $("#ic_y").val(data.y);
                            $("#ic_h").val(data.height);
                            $("#ic_w").val(data.width);
                        }
            });
            $("#cp_accept").prop("disabled",false).removeClass("disabled");
            $("#cp_accept").on("click",function(){
				var l = window.location;
				var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];				
			 
                $("#user_image").html('<img src="'+base_url+'/web/img/loaders/default.gif">');

                $("#modal_change_photo").modal("hide");
				var options = { 
				target:     '#user_image', 
				success:    function(res) { 
                   //console.log(res);
					} 
				};
				$('#cp_crop').ajaxForm(options).submit();;
                //$("#cp_crop").ajaxForm({target: '#user_image'}).submit();
                $("#cp_target").html("Veuillez ajouter un Logo !!!");
                $("#cp_photo").val("").parent("a").find("span").html("Select");
                $("#cp_accept").prop("disabled",true).addClass("disabled");
                //$("#cp_img_path").val("");
				//$("#tbl_admin_logo").val("");
            });           
        }
    }
    $("#cp_photo").on("change",function(){
        if($("#cp_photo").val() == '') return false;
		var l = window.location;
		var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];	
        $("#cp_target").html('<img src="'+base_url+'/web/img/loaders/default.gif"/>');        
        $("#cp_upload").ajaxForm({target: '#cp_target',success: onSuccess}).submit(); 
	
    });
    
    
});      