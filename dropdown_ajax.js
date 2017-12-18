$('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-2d'
});
function drpdown(){
    var tlname = $('#tlname').val()=='' || $('#tlname').val()=='-- Select --'  ? '' : $('#tlname').val() ;
    var caseowner = $('#case_owner').val()=='' || $('#case_owner').val()== '-- Select --' ? '' : $('#case_owner').val() ;
    tlName_caseowner = tlname +'_' + caseowner;
    console.log(tlName_caseowner);
    $("#wait").css("display", "block");
    $.ajax({
        url: 'ajax_outage.php',
        type: 'POST',
        data: {selectList: tlName_caseowner,comefrom:'csat'},
    }).done(function(output) {
        console.log(output);
        outputArr = JSON.parse(output);
        $('#case_number').html('');
        $('#case_number').html(outputArr[0]);
        
        if(outputArr[1] != null && outputArr[1] !=''){
            $('#case_owner').html('');
            $('#case_owner').html(outputArr[1]);
            $('#case_owner').val(caseowner);
        }else{
           $('#case_owner').val('');
        }
        $("#wait").css("display", "none");
    }).fail(function() {
        console.log("error");
    });
}

function selectCase(value) {
  $.ajax({
        url: 'ajax_outage.php',
        type: 'POST',
        data: {caseid: value,comefrom:'csat_form'},
    })
    .done(function(output) {
       
       output = JSON.parse(output);
       tableArr  = output[1];
       getoutput = output[0];
       //console.log(getoutput);
       if(getoutput.length > 0){
           for (var i = 0; i < getoutput.length; i++) {
                $('#csat_que').html(getoutput[i]['que_new'])  
                $('#csat_pro_group').html(getoutput[i]['product_group'])  
                $('#csat_region').html(getoutput[i]['region'])  
                $('#csat_alert').html(getoutput[i]['alert_type'])
                var mydate = new Date(getoutput[i]['datetime_closed']);
                $('#csat_clsd_date').html(mydate.toDateString())  

                $('#csat_cmd').html(getoutput[i]['comments'])  
                $('#csat_email').html(getoutput[i]['engineer_email_id'])  
                $('#csat_nps').html(getoutput[i]['nps'])  
                $('#csat_ovr_exp').html(getoutput[i]['overall_experience'])

                $('#csat_esy_use').html(getoutput[i]['cq3_ease_of_access'])  
                $('#csat_tech_abl').html(getoutput[i]['cq7_technical_ability'])  
                $('#csat_non_tec_per').html(getoutput[i]['cq8_non_technical_performance'])  
                $('#csat_kept_info').html(getoutput[i]['cq9_kept_informed'])
                $('#csat_solution_time').html(getoutput[i]['cq10_solution_time']);

                $('#csat_lead_tier1').html(getoutput[i]['tl_tier1'] == null ? '-' : getoutput[i]['tl_tier1']);
                $('#csat_lead_tier2').html(getoutput[i]['tl_tier2'] == null ? '-' : getoutput[i]['tl_tier2'] );
                $('#csat_lead_tier3').html(getoutput[i]['tl_tier3'] == null ? '-' : getoutput[i]['tl_tier3'] );

                $('#csat_lead_tier4').html(getoutput[i]['tl_tier4'] == null ? '-' : getoutput[i]['tl_tier4'] );
                $('#csat_lead_tier5').html(getoutput[i]['tl_tier5'] == null ? '-' : getoutput[i]['tl_tier5'] );
                $('#csat_lead_cmds').html(getoutput[i]['tl_comments'] == null ? '-' : getoutput[i]['tl_comments'] );
           };
        }else{
               
              $('#csat_que').html('-')  
              $('#csat_pro_group').html('-')  
              $('#csat_region').html('-')  
              $('#csat_alert').html('-')  
              $('#csat_alert').html('-')
              $('#csat_clsd_date').html('-')  

              $('#csat_cmd').html('-')  
              $('#csat_email').html('-')  
              $('#csat_nps').html('-')  
              $('#csat_ovr_exp').html('-')
        }
    }).fail(function() {
        console.log("error");
    });
}
function LoadCatgry (value) {
    var Sub_cat;
    if(value == 'Customer'){
        Sub_cat = Array('Awaiting Customer Response','No Response','Awaiting log/Output','Customer OOO','First Follow-up','Second Follow-up','Third Follow-up');
    }else if(value == 'Bug'){
        Sub_cat = Array('Pending Customer','Pending Developer');
    }else if(value == 'Closure'){
        Sub_cat = Array('Case Closed');
    }else if(value == 'Escalated to GEC'){
        Sub_cat = Array('Case Escalated');
    }else if(value == 'Monitoring'){
        Sub_cat = Array('Awaiting Customer Response','Issue Resolved','Awaiting for Issue reoccurrence');
    }else if(value == 'RMA'){
        Sub_cat = Array('Part not available','Dead on Arrival','Incorrect Part','Incorrect Address','Pending WC');
    }else{
        Sub_cat = Array('GSC - Replication','GSC - Log Review','Awaiting TAC Response','L2 Assistance','L3 Assistance','Bug Filing','RMA Initiation','Pending Escalation');
    }
    var optionNew = [];
    Sub_cat = Sub_cat.sort();
    optionNew = "<option value=''>Nothing Selected</option>";
    for(var i=0;i<Sub_cat.length; i++){
        optionNew +="<option value='"+Sub_cat[i]+"'>"+Sub_cat[i]+"</option>";
    }
    $('#cmd_sub').html(optionNew);
    $("#cmd_sub").selectpicker('refresh');
 }
 $('#submit').on('click',function(){
    if(cmd_sub.value =='' || reason.value ==''){
        cmd_sub.value == '' ? $('#error_msg').css('display','block'):$('#error_msg').css('display','none');
        reason.value == '' ? $('#error_msg_cat').css('display','block') :$('#error_msg_cat').css('display','none');
        return false; 
    }
 });
 setTimeout(function() {
    $('.alert').fadeOut('slow');
}, 5000);

 $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
        // startDate: '+0d'
       maxDate: '0'
    });
 function edit_fun (id,date) {
    sub_id.value = id;
    $('#rec_date').val(date).attr("disabled", 'disabled');
 }
$(document).ajaxStart(function(){
        $("#wait").css("display", "block");
    });
    $(document).ajaxComplete(function(){
        $("#wait").css("display", "none");
    });
    $("button").click(function(){
        $("#txt").load("demo_ajax_load.asp");
    });


function tireselect () {
	var tier1 = $('#tier1').val() == '' ? '' : $('#tier1').val();
	var tier2 = $('#tier2').val() == '' ? '' : $('#tier2').val();
	var tier3 = $('#tier3').val() == '' ? '' : $('#tier3').val();
	var tier4 = $('#tier4').val() == '' ? '' : $('#tier4').val();
	var tier5 = $('#tier5').val() == '' ? '' : $('#tier5').val();
	var tier2drop,tier3drop,tier4drop,tier5drop;
	$("#wait").css("display", "block");
	var tierval = tier1+'_'+tier2+'_'+tier3+'_'+tier4+'_'+tier5;
	console.info(tierval);
	$.ajax({
		url: 'ajax_outage.php',
		type: 'POST',
		data: {selectdropdown: tierval,comefrom:'csat_esc'},
	})
	.done(function(OutPut) {
		var OP = JSON.parse(OutPut);
		//console.log(OP);
		var tier2Arr = OP[2];
		var tier3Arr = OP[3];
		var tier4Arr = OP[4];
		var tier5Arr = OP[5];
		if(tier2Arr !=  null && tier2Arr !=''  ){
			tier2drop = "<option value=''>-- Select --</option>";
		    for(var i=0;i< tier2Arr.length; i++){
		        tier2drop+="<option value='"+tier2Arr[i]+"'>"+tier2Arr[i]+"</option>";
		    }
		    $('#tier2').html(tier2drop)
		    $('#tier2').val(tier2)
		}
		if(tier3Arr !=  null && tier3Arr !=''  ){
			tier3drop = "<option value=''>-- Select --</option>";
		    for(var i=0;i< tier3Arr.length; i++){
		        tier3drop+="<option value='"+tier3Arr[i]+"'>"+tier3Arr[i]+"</option>";
		    }
		    $('#tier3').html(tier3drop)
		    $('#tier3').val(tier3)

		}
		if(tier4Arr !=  null && tier4Arr !=''  ){
			tier4drop = "<option value=''>-- Select --</option>";
		    for(var i=0;i< tier4Arr.length; i++){
		        tier4drop+="<option value='"+tier4Arr[i]+"'>"+tier4Arr[i]+"</option>";
		    }
		    $('#tier4').html(tier4drop)
		    $('#tier4').val(tier4)

		}
		if(tier5Arr !=  null && tier5Arr !=''  ){
			tier5drop = "<option value=''>-- Select --</option>";
		    for(var i=0;i< tier5Arr.length; i++){
		        tier5drop+="<option value='"+tier5Arr[i]+"'>"+tier5Arr[i]+"</option>";
		    }
		    $('#tier5').html(tier5drop)
		    $('#tier5').val(tier5)

		}
		

	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		$("#wait").css("display", "none");
		//console.log("complete");
	});
	
}

$('#sve-btn').click(function(event) {
    $.confirm({
    // theme: 'supervan',
    animation: 'news',
    closeAnimation: 'news',
    title: 'Alert!',
    content: "Are You Sure Want to Complete Survey<br> Once You Confirm Can't Overwrite",
        buttons: {
            confirm: function () {
                // if($('#case_number').val() != ''){
                    $( "#add_form" ).submit();
                // }else{
                //     $.alert('Please Complete Survey');
                // }
            },
            cancel: function () {
                
            },
        }
    });
});

$("#add_form").validate();

$("#reporttype").change(function(){
   var selectdate= $("#reporttype").val();
   $("#wait").css("display", "block");
    $.ajax({
      url: 'ajax_outage.php',
      type: 'POST',
      data: {report:selectdate,comefrom:'dsat_trend'},
      success: function(output) {
        var res = jQuery.parseJSON(output);
        //console.log(res);
        $("#selectrange").html("");
        tier3drop = "<option value=''>-- Select --</option>";
        for(var i=0;i< res.length; i++){
            tier3drop+="<option value='"+res[i]+"'>"+res[i]+"</option>";
        }
        $('#selectrange').html(tier3drop)
        $("#wait").css("display", "none");
      }
    }); 
});

function getfun (argument) {
    $('#form_name').val(argument);
}

function esc_drpdown(){
    var tlname = $('#esc_tlname').val()=='' || $('#esc_tlname').val()=='-- Select --'  ? '' : $('#esc_tlname').val() ;
    var caseowner = $('#esc_case_owner').val()=='' || $('#esc_case_owner').val()== '-- Select --' ? '' : $('#esc_case_owner').val() ;
    tlName_caseowner = tlname +'_' + caseowner;
    console.log(tlName_caseowner);
    $("#wait").css("display", "block");
    $.ajax({
        url: 'ajax_outage.php',
        type: 'POST',
        data: {selectList: tlName_caseowner,comefrom:'escalation'},
    }).done(function(output) {
        //console.log(output);
        outputArr = JSON.parse(output);
        $('#esc_case_number').html('');
        $('#esc_case_number').html(outputArr[0]);
        
        if(outputArr[1] != null && outputArr[1] !=''){
            $('#esc_case_owner').html('');
            $('#esc_case_owner').html(outputArr[1]);
            $('#esc_case_owner').val(caseowner);
        }else{
           $('#esc_case_owner').val('');
        }
        $("#wait").css("display", "none");
    }).fail(function() {
        console.log("error");
    });
}

function esc_selectCase(value) {
  $.ajax({
        url: 'ajax_outage.php',
        type: 'POST',
        data: {caseid: value,comefrom:'escalation'},
    })
    .done(function(output) {
       
       output = JSON.parse(output);
       console.log(output);
       tableArr  = output[1];
       getoutput = output[0];
       
       if(getoutput.length > 0){
           for (var i = 0; i < getoutput.length; i++) {
                $('#esc_que').html(getoutput[i]['queue'])  
                $('#esc_pro_group').html(getoutput[i]['product'])  
                $('#esc_region').html(getoutput[i]['region']) 
                var mydate = new Date(getoutput[i]['date']);
                $('#esc_clsd_date').html(mydate.toDateString())  

                $('#esc_cmd').html(getoutput[i]['comments'])  
                $('#esc_mgr_name').html(getoutput[i]['manager_name'])  
                $('#esc_role').html(getoutput[i]['role'])

                $('#esc_lead_tier1').html(getoutput[i]['tier_1'] == null ?'-':getoutput[i]['tier_1'] );
                $('#esc_lead_tier2').html(getoutput[i]['tier_2'] == null ?'-':getoutput[i]['tier_2']);
                $('#esc_lead_tier3').html(getoutput[i]['tier_3'] == null ?'-':getoutput[i]['tier_3']);

                $('#esc_lead_tier4').html(getoutput[i]['tier_4'] == null ?'-':getoutput[i]['tier_4']);
                $('#esc_lead_tier5').html(getoutput[i]['tier_5'] == null ?'-':getoutput[i]['tier_5']);
                $('#esc_lead_cmds').html(getoutput[i]['rca_comments'] == null ?'-':getoutput[i]['rca_comments']);
                $('#esc_lead_excep').html(getoutput[i]['tl_exception'] == null ?'-':getoutput[i]['tl_exception']);


                $('#esc_lead_tier1').html(getoutput[i]['tier_1'] == null ?'-':getoutput[i]['tier_1'] );
                $('#esc_lead_tier2').html(getoutput[i]['tier_2'] == null ?'-':getoutput[i]['tier_2']);
                $('#esc_lead_tier3').html(getoutput[i]['tier_3'] == null ?'-':getoutput[i]['tier_3']);

                $('#esc_lead_tier4').html(getoutput[i]['tier_4'] == null ?'-':getoutput[i]['tier_4']);
                $('#esc_lead_tier5').html(getoutput[i]['tier_5'] == null ?'-':getoutput[i]['tier_5']);
                $('#esc_lead_cmds').html(getoutput[i]['rca_comments'] == null ?'-':getoutput[i]['rca_comments']);
                $('#esc_lead_excep').html(getoutput[i]['tl_exception'] == null ?'-':getoutput[i]['tl_exception']);
           };
        }else{
               
              $('#esc_que').html('-')  
              $('#esc_pro_group').html('-')  
              $('#esc_region').html('-')  
              $('#esc_alert').html('-')  
              $('#esc_alert').html('-')
              $('#esc_clsd_date').html('-')  

              $('#esc_cmd').html('-')  
              $('#esc_email').html('-')  
              $('#esc_nps').html('-')  
              $('#esc_ovr_exp').html('-')
        }
    }).fail(function() {
        console.log("error");
    });
}
function esc_tireselect () {
    var tier1 = $('#esc_tier1').val() == '' ? '' : $('#esc_tier1').val();
    var tier2 = $('#esc_tier2').val() == '' ? '' : $('#esc_tier2').val();
    var tier3 = $('#esc_tier3').val() == '' ? '' : $('#esc_tier3').val();
    var tier4 = $('#esc_tier4').val() == '' ? '' : $('#esc_tier4').val();
    var tier5 = $('#esc_tier5').val() == '' ? '' : $('#esc_tier5').val();
    var tier2drop,tier3drop,tier4drop,tier5drop;
    $("#wait").css("display", "block");
    var tierval = tier1+'_'+tier2+'_'+tier3+'_'+tier4+'_'+tier5;
    console.info(tierval);
    $.ajax({
        url: 'ajax_outage.php',
        type: 'POST',
        data: {selectdropdown: tierval,comefrom:'esc_tier_ajax'},
    })
    .done(function(OutPut) {
        var OP = JSON.parse(OutPut);
        //console.log(OP);
        var tier2Arr = OP[2];
        var tier3Arr = OP[3];
        var tier4Arr = OP[4];
        var tier5Arr = OP[5];
        console.log(tier2Arr);
        if(tier2Arr !=  null && tier2Arr !=''  ){
            tier2drop = "<option value=''>-- Select --</option>";
            for(var i=0;i< tier2Arr.length; i++){
                tier2drop+="<option value='"+tier2Arr[i]+"'>"+tier2Arr[i]+"</option>";
            }
            $('#esc_tier2').html(tier2drop)
            $('#esc_tier2').val(tier2)
        }
        if(tier3Arr !=  null && tier3Arr !=''  ){
            tier3drop = "<option value=''>-- Select --</option>";
            for(var i=0;i< tier3Arr.length; i++){
                tier3drop+="<option value='"+tier3Arr[i]+"'>"+tier3Arr[i]+"</option>";
            }
            $('#esc_tier3').html(tier3drop)
            $('#esc_tier3').val(tier3)

        }
        if(tier4Arr !=  null && tier4Arr !=''  ){
            tier4drop = "<option value=''>-- Select --</option>";
            for(var i=0;i< tier4Arr.length; i++){
                tier4drop+="<option value='"+tier4Arr[i]+"'>"+tier4Arr[i]+"</option>";
            }
            $('#esc_tier4').html(tier4drop)
            $('#esc_tier4').val(tier4)

        }
        if(tier5Arr !=  null && tier5Arr !=''  ){
            tier5drop = "<option value=''>-- Select --</option>";
            for(var i=0;i< tier5Arr.length; i++){
                tier5drop+="<option value='"+tier5Arr[i]+"'>"+tier5Arr[i]+"</option>";
            }
            $('#esc_tier5').html(tier5drop)
            $('#esc_tier5').val(tier5)

        }
        

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        $("#wait").css("display", "none");
        //console.log("complete");
    });
    
}
