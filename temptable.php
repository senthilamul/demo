<?php	
	$backlog_temp_table = "`id` varchar(50) DEFAULT NULL ,`case_owner_scrubbing` varchar(50) DEFAULT NULL,`case_owner_scrubbing1` varchar(50) DEFAULT NULL,`team_manager` varchar(50) DEFAULT NULL,`team` varchar(50) DEFAULT NULL,`queue` varchar(50) DEFAULT NULL,`project` varchar(50) DEFAULT NULL,`product_group` varchar(50) DEFAULT NULL,`region` varchar(50) DEFAULT NULL,`case_origin` varchar(50) DEFAULT NULL,`day` varchar(50) DEFAULT NULL,`weekday` varchar(50) DEFAULT NULL,`calendar_week` varchar(50) DEFAULT NULL,`fiscal_week` varchar(50) DEFAULT NULL,`calendar_month` varchar(50) DEFAULT NULL,`fiscal_month` varchar(50) DEFAULT NULL,`fiscal_quarter` varchar(50) DEFAULT NULL,`calendar_quarter` varchar(100) DEFAULT NULL,`calendar_year` varchar(100) DEFAULT NULL,`fiscal_year` varchar(100) DEFAULT NULL,`age` varchar(100) DEFAULT NULL,`0_to_5` varchar(100) DEFAULT NULL,`6_to_10` varchar(100) DEFAULT NULL,`11_to_19` varchar(100) DEFAULT NULL,`gra20` varchar(100) DEFAULT NULL,`last_update_age` varchar(100) DEFAULT NULL,`compliance_>_3` varchar(100) DEFAULT NULL,`compliance_>_30` varchar(100) DEFAULT NULL,`compliance_>_60` varchar(100) DEFAULT NULL,`last_update_split_ups` varchar(100) DEFAULT NULL,`date` varchar(100) DEFAULT NULL,`case_number` varchar(100) DEFAULT NULL,`support_type` varchar(100) DEFAULT NULL,`milestone_status` varchar(100) DEFAULT NULL,`asset_country_name` varchar(100) DEFAULT NULL,`status` varchar(100) DEFAULT NULL,`account_page_level` varchar(100) DEFAULT NULL,`product_category` varchar(100) DEFAULT NULL,`product_number` varchar(100) DEFAULT NULL,`opened_date` varchar(100) DEFAULT NULL,`case_owner_alias` varchar(100) DEFAULT NULL,`case_owner_role` varchar(100) DEFAULT NULL,`created_alias` varchar(100) DEFAULT NULL,`case_last_modified_by` varchar(100) DEFAULT NULL,`case_last_modified_alias` varchar(100) DEFAULT NULL,`parent_case_number` varchar(100) DEFAULT NULL,`parent_case_id` varchar(100) DEFAULT NULL,`type` varchar(100) DEFAULT NULL,`case_record_type` varchar(100) DEFAULT NULL,`case_reason` varchar(100) DEFAULT NULL,`description` varchar(100) DEFAULT NULL,`case_last_modified_date` varchar(100) DEFAULT NULL,`date_time_closed` varchar(100) DEFAULT NULL,`closed_date` varchar(100) DEFAULT NULL,`age_days` varchar(100) DEFAULT NULL,`open` varchar(100) DEFAULT NULL,`closed` varchar(100) DEFAULT NULL,`case_currency` varchar(100) DEFAULT NULL,`selfservice_commented` varchar(100) DEFAULT NULL,`new_selfservice_comment` varchar(100) DEFAULT NULL,`case_id` varchar(100) DEFAULT NULL,`business_hours` varchar(100) DEFAULT NULL,`business_hours1` varchar(100) DEFAULT NULL,`entitlement_process_start_time` varchar(100) DEFAULT NULL,`entitlement_process_end_time` varchar(100) DEFAULT NULL,`customer_email` varchar(100) DEFAULT NULL,`created_by` varchar(100) DEFAULT NULL,`case_origin1` varchar(100) DEFAULT NULL,`region1` varchar(100) DEFAULT NULL,`case_country_timezone` varchar(100) DEFAULT NULL,`physical_country` varchar(100) DEFAULT NULL,`update_hour` varchar(100) DEFAULT NULL,`case_age_business_days` varchar(100) DEFAULT NULL,`case_owner` varchar(100) DEFAULT NULL,`case_owner_manager` varchar(100) DEFAULT NULL,`escalated` varchar(100) DEFAULT NULL,`severity` varchar(100) DEFAULT NULL,`account_name` varchar(100) DEFAULT NULL,`case_date_time_last_modified` varchar(100) DEFAULT NULL,`product_line` varchar(100) DEFAULT NULL,`subject` varchar(100) DEFAULT NULL,`entitlement_summary` varchar(100) DEFAULT NULL,`entitlement_exception_process` varchar(100) DEFAULT NULL";

	$email = $_SESSION['username'];
	if($email != ''){
	    $SessionUser = $commonobj->getQry("SELECT * FROM aruba_esc where manager_mail ='$email'");
	    $userType ='Manager';
	    $filterQry = " and tl_status = '1' and mgr_status='0'";


	    if(empty($SessionUser)){
		    $SessionUser0 = $commonobj->getQry("SELECT * FROM aruba_esc where tl_mail ='$email'");
		    $userType ='TL';
		    $filterQry = " and tl_status = '0'";
		}
	}
	

	if($email != ''){
	    $SessionUser1 = $commonobj->getQry("SELECT * FROM aruba_csat where manager_mail ='$email'");
	    $userType1 ='Manager';
	    $filterQry1 = " and tl_status = '1' and mgr_status='0'";

		if(empty($SessionUser1)){
		    $SessionUser2 = $commonobj->getQry("SELECT * FROM aruba_csat where tl_mail ='$email'");
		    $userType1 ='TL';
		    $filterQry1 = " and tl_status = '0'";
		}
	}

	$TempCSAT = "`id` varchar(50) NOT NULL,`overall` varchar(50) DEFAULT NULL,`team` varchar(50) DEFAULT NULL,`que_new` varchar(50) DEFAULT NULL,`wlan_ns` varchar(50) DEFAULT NULL,`product_group` varchar(50) DEFAULT NULL,`region` varchar(50) DEFAULT NULL,`case_origin` varchar(50) DEFAULT NULL,`day` varchar(50) DEFAULT NULL,`weekday` varchar(50) DEFAULT NULL,`calendar_week` varchar(50) DEFAULT NULL,`fiscal_week` varchar(50) DEFAULT NULL,`calendar_month` varchar(50) DEFAULT NULL,`fiscal_month` varchar(50) DEFAULT NULL,`fiscal_quarter` varchar(50) DEFAULT NULL,`calendar_quarter` varchar(50) DEFAULT NULL,`calendar_year` varchar(50) DEFAULT NULL,`fiscal_year` varchar(50) DEFAULT NULL,`overall_experience` varchar(50) DEFAULT NULL,`rma` varchar(50) DEFAULT NULL,`date` varchar(10) DEFAULT NULL,`case_number` varchar(50) DEFAULT NULL,`comments` varchar(50) DEFAULT NULL,`lead` varchar(50) DEFAULT NULL,`overall_experience1` varchar(50) DEFAULT NULL,`alert_type` varchar(50) DEFAULT NULL,`loyalty_index` varchar(50) DEFAULT NULL,`nps` varchar(50) DEFAULT NULL,`opened_date` varchar(50) DEFAULT NULL,`datetime_closed` varchar(50) DEFAULT NULL,`closed_date` varchar(50) DEFAULT NULL,`case_owner` varchar(50) DEFAULT NULL,`case_owner_manager` varchar(50) DEFAULT NULL,`manager_name` varchar(100) NOT NULL,`survey_recd_date` varchar(50) NOT NULL,`nps_1` varchar(100) DEFAULT NULL,`tenure` varchar(50) NOT NULL,`go_live` varchar(50) NOT NULL,`bucket` varchar(50) NOT NULL,`product_easy_of_use` varchar(20) DEFAULT NULL,`ease_of_access_score` varchar(20) DEFAULT NULL,`technical_ability_score` varchar(20) DEFAULT NULL,`non_technical_performance_score` varchar(20) DEFAULT NULL,`kept_informed_score` varchar(20) DEFAULT NULL,`solution_time_score` varchar(20) DEFAULT NULL,`month` varchar(50) DEFAULT NULL,`type` varchar(50) DEFAULT NULL,`case_id_or_claim_id` varchar(50) DEFAULT NULL,`engineer_name` varchar(50) DEFAULT NULL,`open_date1` varchar(50) DEFAULT NULL,`closed_date1` varchar(50) DEFAULT NULL,`calendar_month_closed` varchar(50) DEFAULT NULL,`overall_experience2` varchar(50) DEFAULT NULL,`new_alert_type` varchar(50) DEFAULT NULL,`loyalty_index1` varchar(50) DEFAULT NULL,`nps1` varchar(50) DEFAULT NULL,`team1` varchar(50) DEFAULT NULL,`cq4t_ease_of_access_follow_up_reason_codes` varchar(50) DEFAULT NULL,`cq10a_reason_for_overall_satisfaction_for_cq1_ratings_9_10` varchar(50) DEFAULT NULL,`cq10b_reason_for_overall_satisfaction_for_cq1_ratings_0_8` varchar(50) DEFAULT NULL,`cq13b_reasons_for_recommendation_score_given` text,`que1` varchar(20) DEFAULT NULL,`calendar_week_closed` varchar(20) DEFAULT NULL,`region1` varchar(20) DEFAULT NULL,`product_group1` varchar(20) DEFAULT NULL,`quarter_calendar_wise` varchar(20) DEFAULT NULL,`survey_received_date` varchar(20) DEFAULT NULL,`survey_week` varchar(20) DEFAULT NULL,`page_level` varchar(20) DEFAULT NULL,`survey_month` varchar(20) DEFAULT NULL,`product_ease_of_use_cq16` varchar(20) DEFAULT NULL,`fiscal_quarter1` varchar(20) DEFAULT NULL,`customer_country` varchar(20) DEFAULT NULL,`cq3_ease_of_access` text,`cq7_technical_ability` text,`cq8_non_technical_performance` text,`cq9_kept_informed` text,`cq10_solution_time` text,`calendar_week_open` varchar(50) DEFAULT NULL,`calendar_month_open` varchar(50) DEFAULT NULL,`engineer_email_id` varchar(50) DEFAULT NULL,`team_lead_mail_id` varchar(50) DEFAULT NULL,`case_origin1` varchar(50) DEFAULT NULL,`product_or_product_number` varchar(50) DEFAULT NULL,`product_description` varchar(50) DEFAULT NULL,`tenure1` varchar(50) DEFAULT NULL,`bucket_wise` varchar(50) DEFAULT NULL,`tenure_bucket` varchar(50) DEFAULT NULL,`account` text";

	$TempEsc ="`id` varchar(50) NOT NULL,`calendar_year` varchar(50) DEFAULT NULL,`fiscal_year` varchar(50) DEFAULT NULL,`fiscal_quarter` varchar(50) DEFAULT NULL,`calendar_quarter` varchar(50) DEFAULT NULL,`calendar_month` varchar(50) DEFAULT NULL,`fiscal_month` varchar(50) DEFAULT NULL,`calendar_week` varchar(50) DEFAULT NULL,`fiscal_week` varchar(50) DEFAULT NULL,`date` varchar(50) DEFAULT NULL,`merge` varchar(50) DEFAULT NULL,`wlan_ns` varchar(15) NOT NULL,`product` varchar(50) DEFAULT NULL,`queue` varchar(50) DEFAULT NULL,`case_owner` varchar(50) DEFAULT NULL,`team` varchar(50) DEFAULT NULL,`manager_name` varchar(100) DEFAULT NULL,`case` varchar(50) DEFAULT NULL,`date1` varchar(50) DEFAULT NULL,`day` varchar(100) DEFAULT NULL,`week` varchar(100) DEFAULT NULL,`month` varchar(100) DEFAULT NULL,`quarter` varchar(100) DEFAULT NULL,`case1` varchar(100) DEFAULT NULL,`product_group` varchar(100) DEFAULT NULL,`region` varchar(100) DEFAULT NULL,`engineer` varchar(100) DEFAULT NULL,`role` varchar(100) DEFAULT NULL,`team_name` varchar(100) DEFAULT NULL,`tier_1` varchar(100) DEFAULT NULL,`tier_2` varchar(100) DEFAULT NULL,`tier_3` varchar(100) DEFAULT NULL,`tier_4` varchar(100) DEFAULT NULL,`tier_5` varchar(100) DEFAULT NULL,`rca_comments` varchar(100) DEFAULT NULL";
?>