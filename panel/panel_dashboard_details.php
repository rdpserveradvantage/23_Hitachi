<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
	  <div class="card">
		<div class="card-body">
		  <h4 class="card-title">Panel Details</h4>
		    <div class="row">
			    <div class="col-md-4">
				  <div class="form-group">
					<label>Panel Id</label>
					<input type="text" class="form-control form-control-sm" id="PanelId" readonly placeholder="PanelId" aria-label="PanelId">
				  </div>
				</div>  
				<div class="col-md-4">
				  <div class="form-group">
					<label>Panel IP</label>
					<input type="text" class="form-control form-control-sm" id="PanelIP" readonly placeholder="PanelIP" aria-label="PanelIP">
				  </div>
				</div> 
				<div class="col-md-4">
				  <div class="form-group">
					<label>Panel Port</label>
					<input type="text" class="form-control form-control-sm" id="PanelPort" readonly placeholder="PanelPort" aria-label="PanelPort">
				  </div>
				</div> 
			</div>
			<div class="row">
			    <div class="col-md-4">
				  <div class="form-group">
					<label>Panel Make</label>
					<input type="text" class="form-control form-control-sm" id="PanelMake" placeholder="PanelMake" aria-label="PanelMake" readonly>
				  </div>
				</div>  
				<div class="col-md-4">
				  <div class="form-group">
					<label>Panel Type</label>
					<input type="text" class="form-control form-control-sm" id="PanelType" readonly placeholder="PanelType" aria-label="PanelType">
				  </div>
				</div> 
				<div class="col-md-4">
				  <div class="form-group">
					<label>Panel Model</label>
					<input type="text" class="form-control form-control-sm" id="PanelModel" readonly placeholder="PanelModel" aria-label="PanelModel">
				  </div>
				</div> 
			</div>
			<div class="row">
			    <div class="col-md-4">
				  <div class="form-group">
					<label>Alternate IP</label>
					<input type="text" class="form-control form-control-sm" id="AlternateIP" readonly placeholder="AlternateIP" aria-label="AlternateIP">
				  </div>
				</div>  
				<div class="col-md-4">
				  <div class="form-group">
					<label>Current IP</label>
					<input type="text" class="form-control form-control-sm" id="CurrentIP" readonly placeholder="CurrentIP" aria-label="CurrentIP">
				  </div>
				</div> 
				<div class="col-md-4">
				  <div class="form-group">
					<label>Panel Status</label>
					<br>
					<div class="badge badge-success badge-pill" id="panel_status" style="display:none;">Active</div>
				  </div>
				</div> 
			</div>
		</div>
	  </div>
	</div>
	<div class="col-md-6 grid-margin stretch-card">
	   <div class="card">
						  						  
		<div class="card-body">
		 <h4 class="card-title">Panel Zone Status</h4> 
				 <div class="row">							 
			   <input type="image" src="image/calci.jpg" alt="CAL" align="left" onclick="zone_status_panel();return false;" style="padding: 7px;">
			   </div>
			   <div class="row" style="border-bottom:1px solid #333;margin-bottom:8px;">
			      <button class='badge badge-success badge-pill mb-2'>Closed</button>
				  <button class="badge badge-danger badge-pill mb-2">Open</button>
				  <button class="badge badge-warning badge-pill mb-2">Pending</button>
				   <button class="badge badge-info badge-pill mb-2">Sounder Reset</button>
			   </div>
			   <div class="row" id="zone_status_panel">
			   
			   </div>
		</div>
	  </div>
	</div>
</div>