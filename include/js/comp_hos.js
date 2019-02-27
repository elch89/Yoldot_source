// Check all checkboxes
$(function() {
    $('.chk_boxes').click(function() {
        $('.chk_boxes1').prop('checked', this.checked);
    });
});

//for sticky table head
function moveScroll(){
    var scroll = $(window).scrollTop();
	var table_one = $("#table-1");
	var bottom_anc = $("#bottom_anchor");
	if(table_one.length && bottom_anc.length){
		var anchor_top = $("#table-1").offset().top;
    	var anchor_bottom = $("#bottom_anchor").offset().top;
    	if (scroll>anchor_top && scroll<anchor_bottom) {
    		clone_table = $("#clone");
    		if(clone_table.length === 0){
        		clone_table = $("#table-1").clone();
        		clone_table.attr('id', 'clone');
        		clone_table.css({position:'fixed',
                 	'pointer-events': 'none',
                 	top:'80px'});
        		clone_table.width($("#table-1").width());
        	$("#table-container").append(clone_table);
        	$("#clone").css({visibility:'hidden'});
        	$("#clone thead").css({visibility:'visible', 'pointer-events':'auto'});
    		}
    	} 
		else {
    		$("#clone").remove();
    	}
	}   
}
$(window).scroll(moveScroll);