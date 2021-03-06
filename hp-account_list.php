<?php 
error_reporting(E_ALL);
include('includes/config.php');

$qry= "SELECT Name from login where name!='' and project like '%aruba%' order by Name ASC";
$prepareqry=$pdo->prepare($qry);
$prepareqry->execute();
$namelist=$commonobj->arrayColumn($prepareqry->fetchAll(PDO::FETCH_ASSOC),'','Name');

$id = $_GET['id'];
if(isset($_POST['title'])){
        $date = date('Y-m-d',strtotime($_POST['date']));
        $_SESSION['email'] = 'senthilkumar@css.com';
        $insertId = $commonobj->InsertRecord('task',array('title','date', 'time', 'type_of_meeting','meeting_place', 'invited_persion', 'adsent', 'create_by', 'create_at', 'update_at'),array($_POST['title'], $date, $_POST['time'], $_POST['type_meeting'],$_POST['place'],implode(",",$_POST['person']),implode(",",$_POST['ab_person']), $_SESSION['email'],$dbdatetime,$dbdatetime),'activity.php');
        header("Location:activity.php?id=".base64_encode($insertId));
}
include("includes/header.php");
?>          
<style>
    #under {
  position: fixed;
  top: 5px;
  width: 420px;
  left: 20px;
  border: 1px solid;
  height: 10%;
  background: #fff;
  z-index: 1;
}
</style>
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">
        
            <div class="row">
                <div class="col-md-12">
                    
                    <form class="form-horizontal" method="POST" id="add_task">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Manage Task</strong></h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                            </div>
                            <div class="panel-body"></p>
                            </div>
                             <!-- form-group-separated -->
                            <div class="panel-body">                                                                        
                                
                                <div class="row">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Type Of Meeting</label>
                                            <div class="col-md-5">                                            
                                                <div class="input-group">
                                                    <!-- <input type="text" class="form-control"/ id='type_meeting' name="type_meeting"> -->
                                                    <select class="form-control select under" id='type_meeting' name='type_meeting' live-search='true'>
                                                        
                                                        <option value='Weekly Review- Airwave'>Weekly Review- Airwave</option>
                                                        <option value='Weekly Review- AOS'>Weekly Review- AOS</option>
                                                        <option value='Weekly Review- Clear Pass'>Weekly Review- Clear Pass</option>
                                                        <option value='Weekly Review- HPE Switch'>Weekly Review- HPE Switch</option>
                                                        <option value='Weekly Review- Instant OS'>Weekly Review- Instant OS</option>
                                                        <option value='Weekly Review- THD'>Weekly Review- THD</option>
                                                        <option value='Weekly Review- WC'>Weekly Review- WC</option>
                                                        <option value='Weekly Review- Ops'>Weekly Review- Ops</option>
                                                    </select>
                                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                </div>                                            
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                   <!--  </div> -->
                                </div>

                            </div>
                            <div class="panel-footer text-center" >
                               <!--  <a href="activity_list.php"><input type='button' class="btn btn-danger" formnovalidate value='Cancel'></a>                                    
                                <button class="btn btn-primary ">Add Task</button> -->
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>                    
            
        </div>
        <!-- END PAGE CONTENT WRAPPER -->                                                
    </div>            
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<?php include("includes/footer.php"); ?>
<script type="text/javascript">
   $("#add_task").validate({
        ignore: [],
        rules: {                                            
                title: "required",
                date: "required",
                time:'required',
                place:'required',
                'person[]':'required',
                type_meeting: 'required',
            }                                
        }); 
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-2d'
        });
</script>