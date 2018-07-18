function delete_row(row){
	var box = $("#mb-remove-row");
	box.addClass("open");
	var route = "{{ path('remove_client', {'client': 'test'})|escape('js') }}";
	    
			 //var url = "{{ path('remove_client', {'client': 'id'})|escape('js') }}";
			 var url = '{{ path("remove_client", {"client": "id"}) }}'; 
			 url = url.replace("id", row);
	 
		 $('.mb-control-yes').attr('href',url);
		 //$('.mb-control-yes').attr('href', route );
}
