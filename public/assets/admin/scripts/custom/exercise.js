var TableManaged = function () {

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            // begin first table
            $('#sample_1').dataTable({
                "aoColumns": [
                  null,
                  null,                  
                  null,                  
                  { "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 20,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [
                    /*
                    { 'bSortable': false, 'aTargets': [0] },
                    { "bSearchable": false, "aTargets": [ 0 ] }
                    */
                ]
            });

            jQuery('#sample_1 .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }                    
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                 $(this).parents('tr').toggleClass("active");
            });

            jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
            //jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        }

    };

}();


var WbTableManaged = function () {

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            // begin first table
            $('#sample_1').dataTable({
                "aoColumns": [
                    null,
                    { "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 20,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [
                    /*
                    { 'bSortable': false, 'aTargets': [0] },
                    { "bSearchable": false, "aTargets": [ 0 ] }
                    */
                ]
            });

            jQuery('#sample_1 .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                $(this).parents('tr').toggleClass("active");
            });

            jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
            //jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

            jQuery('input.question').on('click', function(){

                if($(this).is(':checked')) {
                    var qId = $(this).data('id');
                    var question = $(this).data('question');
                    var rowCount = $('.selectedQuestions').length;
                    if( rowCount == 1) {
                        $('.selectedQuestions:first').addClass('hide');
                    }

                    if(checkQuestion(qId)) {
                        return true;
                    }

                    var html = '<tr class="selectedQuestions question_'+ rowCount +'">';
                    html += '<td>'+ question;
                    html += '<input type="hidden" name="question_id[]" value="'+ qId +'">';
                    html += '</td>';
                    html += '<td><input type="text" name="position[]" value="'+ rowCount +'"></td>';
                    html += '<td><a class="btn btn-xs red" title="Delete Record" onclick="deleteQuestion('+ rowCount +')"><i class="fa fa-trash-o"></i></a></td>';
                    html += '</tr>';

                    $( html ).insertAfter( ".selectedQuestions:last" );
                }
            })

        }

    };

}();

var MFTableManaged = function () {

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            // begin first table
            $('#sample_1').dataTable({
                "aoColumns": [
                    null,
                    { "bSortable": false }
                ],
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 20,
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [
                    /*
                    { 'bSortable': false, 'aTargets': [0] },
                    { "bSearchable": false, "aTargets": [ 0 ] }
                    */
                ]
            });

            jQuery('#sample_1 .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                        $(this).parents('tr').addClass("active");
                    } else {
                        $(this).attr("checked", false);
                        $(this).parents('tr').removeClass("active");
                    }
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample_1').on('change', 'tbody tr .checkboxes', function(){
                $(this).parents('tr').toggleClass("active");
            });

            jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-medium input-inline"); // modify table search input
            jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
            //jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

            jQuery('.question').on('change', function(){

                var set = jQuery(this).attr("data-set");
                $('.question').not(this).prop('checked', false);

                if($(this).is(':checked')) {
                    var qId = $(this).data('id');
                    var question = $(this).data('question');

                    if(checkQuestion(qId)) {
                        return true;
                    }

                    var html = '<tr class="selectedQuestions question_'+ qId +'">';
                    html += '<td>'+ question;
                    html += '<input type="hidden" name="question_id" value="'+ qId +'">';
                    html += '</td>';
                    html += '<td><a class="btn btn-xs red selectedQuestionId" title="Delete Record" rel="'+qId+'" onclick="MFdeleteQuestion('+ qId +')"><i class="fa fa-trash-o"></i></a></td>';
                    html += '</tr>';

                    $( '#selectedQuestionList>tbody' ).html( html );
                }else{
                    var qid = $('.selectedQuestionId').attr('rel');
                    MFdeleteQuestion(qid);

                }
                jQuery.uniform.update(set);
            });
        }

    };

}();

function deleteQuestion(id) {
    $('.question_'+id).remove();

    var rowCount = $('.selectedQuestions').length;
    if( rowCount == 1) {
        $('.selectedQuestions:first').removeClass('hide');
    }
}

function MFdeleteQuestion(id){
    $('.question_'+id).remove();
    var html = '<tr class="selectedQuestions">'+
        '<td colspan="3" align="center">Select questions from bank given below</td>'+
        '</tr>';
    $( '#selectedQuestionList>tbody' ).html( html );
}

function checkQuestion(qId) {
    var  isExist = false;
    $('input[name=question_id\\[\\]]').each(function(index,$this){
        if($($this).val() == qId)
            isExist = true;
    })
    return isExist;
}