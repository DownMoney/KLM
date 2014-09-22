submitImageForm = function(fID) {
  $('addImageForm').hide();	
  parent.$('success_'+fID).hide();	
  parent.$('progress_'+fID).show();
  $('addImage').submit();	
}

check_limit = function(fID, a_mode) {
	if(a_mode) {
		//dodawanie zdjecia
		elem = parent.$$('#gallery_'+fID+' .added_img');
		el_count = elem.length;
		if(el_count==0) return;
		my_message = "Plik dodany";
		if(parent.$('gallery_count_max_limit_'+fID)) {
			max_limit = parent.$F('gallery_count_max_limit_'+fID);
			if(el_count>=max_limit) {
				parent.$('frame_add_image_'+fID).hide();
			} else {
				parent.$('frame_add_image_'+fID).show();
			}
		}
		if(parent.$('gallery_count_min_limit_'+fID)) {
			min_limit = parent.$F('gallery_count_min_limit_'+fID);
			if(el_count<min_limit) {
				my_message = "Plik dodany. Minimalna ilość plików to "+min_limit+" więc musisz dodać jeszcze "+(min_limit-el_count)+" plików.";
			}
		}
		parent.$('success_'+fID).update(my_message);
	} else {
		//usuwanie zdjecia
		elem = $$('#gallery_'+fID+' div.added_img');
		my_message = "Plik usunięty.";
		if($('gallery_count_max_limit_'+fID)) {
			max_limit = $F('gallery_count_max_limit_'+fID);
			if(elem.length>=max_limit) {
				$('frame_add_image_'+fID).hide();
			} else {
				$('frame_add_image_'+fID).show();
			}
		}
		if($('gallery_count_min_limit_'+fID)) {
			min_limit = $F('gallery_count_min_limit_'+fID);
			if(elem.length<min_limit) {
				my_message = "Plik usunięty. Minimalna ilość plików to "+min_limit+" więc musisz dodać jeszcze "+(min_limit-elem.length)+" plików.";
			}
		}
		$('success_'+fID).update(my_message);
		
		elems = $$('#gallery_'+fID+' .added_img').invoke('removeClassName', 'addedimg_2');
		elemsLength = elems.length;
		for(i=0; i<elemsLength; ++i) {
			if(i%2==1) {
				elems[i].addClassName('addedimg_2');
			}
		}
		
	}
}

ValidateGalleryRequired = function(fID) {
	elem = $$('#gallery_'+fID+' .added_img');
	if($('gallery_count_max_limit_'+fID)) {
		max_limit = $F('gallery_count_max_limit_'+fID);
		if(elem.length>max_limit) {
			$('frame_add_image_'+fID).hide();
			alert('przekroczyłeś maksymalną ilość plików!');
			form_submitted=false;
			return false;
		}
	}
	if($('gallery_count_min_limit_'+fID)) {
		min_limit = $F('gallery_count_min_limit_'+fID);
		if(elem.length<min_limit) {
			alert('minimalna ilość plików to '+min_limit+" musisz dodać jeszcze "+(min_limit-elem.length)+" plików");
			form_submitted=false;
			return false;
		}
	}
	return true;
}