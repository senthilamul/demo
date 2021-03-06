<?php
set_time_limit(0);
include "includes/config.php";
include 'includes/session_check.php';
if (isset($_POST['frm_submit'])) {
	extract($_POST);
	 $managername = $manager;
	 $teamname = $tlname;
	 $queName = $que_new;
	 $productgroupname = $productgroup;
	$Qry.= $manager == 'Overall' || $manager == '' ? '' :"and manager_name = '$manager'"; 		
	$Qry.= $tlname == 'Overall' || $tlname == ''? '' :" and team = '$tlname'";
	$Qry.= $que_new == 'Overall' || $que_new == '' ? '' :" and que_new = '$que_new'";
	$Qry.= $productgroup == 'Overall' || $productgroup == '' ? '' :" and product_group = '$productgroup'"; 		
}

$CsatArr = $commonobj->getQry("SELECT calendar_week,calendar_month,case_number,manager_name,team,que_new,wlan_ns,product_group,region,alert_type,overall_experience,case_origin,case_owner,nps FROM aruba_csat where LENGTH (case_number) > 7 and (alert_type in ('Normal','Red') or nps in ('Passive','Red')) $Qry $filterQry1 order by case_number asc");

$EscArr = $commonobj->getQry("SELECT calendar_week,calendar_month,`case`,manager_name,team,queue,wlan_ns,product_group,region,case_owner FROM aruba_esc where  LENGTH (`case`) > 7 $Qry $filterQry order by `case` asc");

include "includes/header.php";
	?>
	<!-- <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script> -->
	<form method="POST" id="frmsrch">    
	<input type="hidden" name="_token" value="<?php echo $token; ?>">
	<input type="hidden" name="frm_submit">           
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="dsat_form.php">DSAT OE/NPS</a></li>
                    <li><a href="esc.php">Escalation</a></li>
                </ul>
                <div class="page-title">                    
                    <div class="portlet">
				        <div class="portlet-body">

							<div class="form-group col-sm-2 col-md-3 col-xs-6">
								<select class="form-control" id="manager" name="manager" onchange="reload()">
				                	<option value="">Manager</option>
				                	<?php $getdropdownArr = $commonobj->getQry("SELECT Distinct manager_name from aruba_csat where alert_type !='Green' and  LENGTH (case_number) > 7 and manager_name<>''");
				                		foreach ($getdropdownArr as $key => $value) {
				                			echo "<option value='$value[manager_name]'>$value[manager_name]</option>";
				                		}
				                	?>
				                </select>
				                <script> 
				                     jQuery("#manager").val("<?php echo $managername?>");
				                </script>
				            </div>
							<div class="form-group col-sm-2 col-md-3 col-xs-6">
							    <select class="form-control" id="tlname" name="tlname" onchange="reload()">
									<option value="">Overall TL</option>
									<?php $getdropdownArr = $commonobj->getQry("SELECT Distinct team from aruba_csat where alert_type !='Green' and  LENGTH (case_number) > 7 and team<>'' $Qry ");
				                		foreach ($getdropdownArr as $key => $value) {
				                			echo "<option value='".$value['team']."'>$value[team]</option>";
				                		}
				                	?>
				                </select>
				                <script> 
				                     jQuery("#tlname").val("<?php echo $teamname?>");
				                </script>
				            </div>
							<div class="form-group col-sm-2 col-md-3 col-xs-6">
								<select class="form-control" id="que_new" name="que_new" onchange="reload()">
				                	<option value="">Overall Region</option>
				                	<?php $getdropdownArr = $commonobj->getQry("SELECT Distinct que_new from aruba_csat where alert_type !='Green' and  LENGTH (case_number) > 7 and que_new<>''");
				                		foreach ($getdropdownArr as $key => $value) {
				                			echo "<option value='$value[que_new]'>$value[que_new]</option>";
				                		}
				                	?>
				                </select>
				                <script> 
				                     jQuery("#que_new").val("<?php echo $queName?>");
				                </script>
				            </div>
				            <div class="form-group col-sm-2 col-md-3 col-xs-6">
								<select class="form-control" id="productgroup" name="productgroup" onchange="reload()">
				                	<option value="">Overall Product</option>
				                	<?php $getdropdownArr = $commonobj->getQry("SELECT Distinct product_group from aruba_csat where alert_type !='Green' and  LENGTH (case_number) > 7 and product_group<>''");
				                		foreach ($getdropdownArr as $key => $value) {
				                			echo "<option value='$value[product_group]'>$value[product_group]</option>";
				                		}
				                	?>
				                </select>
				                <script> 
				                     jQuery("#region").val("<?php echo $productgroupname?>");
				                </script>
				            </div>
				        </div>
				    </div>
					<!--<button class="btn btn-primary pull-right">Submit</button>-->
				</div>
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><b>DSAT/Normal</b> Pending</h3>
                                    <div class="btn-group pull-right">
                                        <!-- <span type='submit' class="btn btn-danger dropdown-toggle" data-target="#modal_basic" data-toggle="modal"><i class="fa fa-bars"></i> Export Data</span> -->
                                        <span class="btn btn-danger" data-toggle="modal" data-target="#modal_basic"><i class="fa fa-bars"></i>Export Data</span>
                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body" style="overflow:scroll;">
                                    <table id="customers2" class="table datatable">
										<thead>
											<tr>
												<th>Case Number</th>
												<th>Week</th>
												<th>Month</th>
												<th>Project</th>
												<th>Queue</th>
												<th>Region</th>
												<th>Case Origin</th>
												<th>Product Group</th>
												<th>Alert Type</th>
												<th>NPS</th>
												<th>Overall Experience</th>
												<th>Case Owner</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											foreach ($CsatArr as $key => $value) { 
											?>
												<tr>
													<td><?=$value['case_number']?></td>
													<td><?=$value['calendar_week']?></td>
													<td><?=$value['calendar_month']?></td>
													<td><?=$value['wlan_ns']?></td>
													<td><?=$value['que_new']?></td>
													<td><?=$value['region']?></td>
													<td><?=$value['case_origin']?></td>
													<td><?=$value['product_group']?></td>
													<td><?=$value['alert_type']?></td>
													<td><?=$value['nps']?></td>
													<td><?=$value['overall_experience']?></td>
													<td><?=$value['case_owner']?></td>
													<td><a href="dsat_form.php?id=<?=base64_encode($value['case_number'])?>&type=csat"><i class="fa fa-pencil"></a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>    
								</div>
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Case Number: <?=$value['case_number']?></h4>
											</div>
											<div class="modal-body">
												   
															
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <!-- END DATATABLE EXPORT -->

                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><b>Escalation</b>Pending</h3>
                                    <!-- <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                        </ul>
                                    </div>   -->                                  
                                    
                                </div>
                                <div class="panel-body" style="overflow:scroll;">
                                    <table id="customers2" class="table datatable">
										<thead>
											<tr>
												<th>Case Number</th>
												<th>Week</th>
												<th>Month</th>
												<th>Project</th>
												<th>Queue</th>
												<th>Region</th>
												<th>Product Group</th>
												<th>Team Lead</th>
												<th>Case Owner</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											foreach ($EscArr as $key => $value) { 
											?>
												<tr>
													<td><?=$value['case']?></td>
													<td><?=$value['calendar_week']?></td>
													<td><?=$value['calendar_month']?></td>
													<td><?=$value['wlan_ns']?></td>
													<td><?=$value['queue']?></td>
													<td><?=$value['region']?></td>
													<td><?=$value['product_group']?></td>
													<td><?=$value['team']?></td>
													<td><?=$value['case_owner']?></td>
													<td><a href="esc.php?id=<?=base64_encode($value['case'])?>&type=esc"><i class="fa fa-pencil"></a></td>
												</tr>
											<?php } ?>
										</tbody>
									</table>    
								</div>
								<div class="modal fade" id="myModal" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Case Number: <?=$value['case_number']?></h4>
											</div>
											<div class="modal-body">
												   
															
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
                        </div>
                    </div>
					
                </div>         
                <!-- END PAGE CONTENT WRAPPER -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->  
			<div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Basic Modal</h4>
	                    </div>
	                    <div class="modal-body">
		                    	<div class="panel-body">
		                    		<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Select</label>
                                        <div class="col-md-8 col-xs-12">
                                            <select class="form-control select" style="display: none;" id='report'>
                                            	<option value="">-- Selected --</option>
                                            	<option value="aruba_csat">CSAT</option>
                                            	<option value="aruba_esc">Escalation</option>
                                            </select>
                                            <span class="help-block">Select Raw Data</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Select</label>
                                        <div class="col-md-8 col-xs-12">
                                            <select class="form-control select" style="display: none;" data-live-search="true" id='selectmonth'>
                                            	<option value="">-- Selected --</option>
                                               <?php $csatMonth = $commonobj->getQry("SELECT distinct calendar_month from aruba_csat order by id desc ");
                                               		foreach ($csatMonth as $key => $value) {
                                               			echo "<option value='$value[calendar_month]'>$value[calendar_month]</option>";
                                               		}
                                               ?>
                                            </select>
                                            <span class="help-block">Select Download Month</span>
                                        </div>
                                    </div>
                                </div>
	                    </div>
	                    <div class="modal-footer">
	                    	<button type="button" class="btn btn-primary" data-dismiss="modal" id='submitmonth'><i class="fa fa-pencil"></i>Submit</button>
	                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	</form> 

	<?php 
	include("includes/footer.php");
	?>
	<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script> 
	<script type="text/javascript" src="dropdown_ajax.js"></script> 