 <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title">Panel Communication Details</h4>
		    <div class="row" style="margin-bottom:10px;">
			    <div class="col-md-6"></div>
			    <div class="col-md-6">
			     <div id="reportrange" class="form-control"   data-cancel-class="btn-light"  style="float:right;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span id="selectedValue"></span> 
                    </div>

                    <input type="hidden" id="start" name="start" value="<?php echo date('Y-m-d');?>">
                    <input type="hidden" id="end" name="end" value="<?php echo date('Y-m-d');?>">
			    </div>	
			</div>
           <div class="row">
			<div class="col-12"  id="ticketview_tbody">
			  <div class="table-responsive">
				<table id="order-listing" class="table">
				  <thead>
					<tr>
						<th>SrNo</th><th>Msg From</th><th>Type</th>
						<th>Zone</th><th>Mac ID</th><th>Panel IP</th>
						<th>Msg Received Date</th><th>Message</th><th>Panel Model</th>
						<th>Msg DateTime</th><th>Alarm Code</th><th>Alarm Desc</th><th>Receive Port</th>
					</tr>
				  </thead>
				  <tbody>
				  
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>  
</div>	