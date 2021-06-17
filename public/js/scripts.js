getPagination('#table-id');
$('#maxRows').trigger('change');
function getPagination (table){

    $('#maxRows').on('change',function(){
        $('.pagination').html('');
        var trnum = 0 ;
        var maxRows = parseInt($(this).val());
    
        var totalRows = $(table+' tbody tr').length;
        $(table+' tr:gt(0)').each(function(){
            trnum++;
            if (trnum > maxRows ){
                
                $(this).hide();
            }if (trnum <= maxRows ){$(this).show();}
        });
        if (totalRows > maxRows){
            var pagenum = Math.ceil(totalRows/maxRows);

            for (var i = 1; i <= pagenum ;){
            $('.pagination').append('<li data-page="'+i+'">\
                                <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
                                </li>').show();
            }

    
        }
        $('.pagination li:first-child').addClass('active');
    
    
showig_rows_count(maxRows, 1, totalRows);

    $('.pagination li').on('click',function(e){
    e.preventDefault();
            var pageNum = $(this).attr('data-page');
            var trIndex = 0 ;
            $('.pagination li').removeClass('active');
            $(this).addClass('active');
    

showig_rows_count(maxRows, pageNum, totalRows);

    
    
            $(table+' tr:gt(0)').each(function(){
                trIndex++;
                if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                    $(this).hide();		
                }else {$(this).show();} 
            });
                });
    });

}	

$(function(){
default_index();
});

function showig_rows_count(maxRows, pageNum, totalRows) {

var end_index = maxRows*pageNum;
    var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
    var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
    $('.rows_count').html(string);
}

function default_index() {
$('table tr:eq(0)').prepend('<th> No </th>')

                var id = 0;

                $('table tr:gt(0)').each(function(){	
                    id++
                    $(this).prepend('<td>'+id+'</td>');
                });
}

function FilterkeyWord_all_table() {

var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

var input, filter, table, tr, td, i;
input = document.getElementById("search_input_all");
var input_value =     document.getElementById("search_input_all").value;
    filter = input.value.toLowerCase();
if(input_value !=''){
    table = document.getElementById("table-id");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
    
    var flag = 0;
    
    for(j = 0; j < count; j++){
        td = tr[i].getElementsByTagName("td")[j];
        if (td) {
        
            var td_text = td.innerHTML;  
            if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {

            flag = 1;
            } else {
            }
        }
        }
    if(flag==1){
                tr[i].style.display = "";
    }else {
        tr[i].style.display = "none";
    }
    }
}else {
$('#maxRows').trigger('change');
}
}
$('#logout').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
$('#delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
$("#button-arrow").toggleClass("arrow-right");
});
$("#layout").click(function(e) {
e.preventDefault();
if($("#layout-icon").hasClass("fa-table")){
$("#card-layout").css({"display":"none"});
$("#layout-icon").removeClass("fa-table");
$("#layout-icon").toggleClass("fa-th");
$("#table-layout").css({"display":"block"});
}
else if($("#layout-icon").hasClass("fa-th")){
$("#table-layout").css({"display":"none"});
$("#layout-icon").removeClass("fa-th");
$("#layout-icon").toggleClass("fa-table");
$("#card-layout").css({"display":"inline-flex"});
}
});
