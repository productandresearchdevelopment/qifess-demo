
<div class="site-detail">
    <div class="header-title">Information</div>
    <div>
        <div class="container info-container">
            <span>Link ID</span> {link_id} <br> 
            <span style="color:{active_color};font-weight:bold">({active}) {active_date}</span>
        </div>
        <div class="container info-container">
            <span>Client Name</span> ({client.alias}) {client.name}
        </div>
        <div class="container info-container">
            <span>Site Name</span> {name}
        </div>
        <div class="container info-container">
            <span>Services</span>
            <div class="box-color" style="margin-right: 5px;text-align: center;background: #{service.color}">{service.alias}</div><br>{service.name}             
        </div>        
        <div class="container info-container">
            <span>Terminal Name</span> {terminal_name} <br>
            <span>Airmac</span> {airmac} <br>
            <span>Beam</span> {beam} <br>
            <span>Serial Number</span> {serial_number} <br>

        </div>        
        <div class="container info-container" style="display: flex; padding: 0px">
            <div style="flex: 1; padding: 15px; border-right: 1px solid #eee; text-align: left">
                <span>Address</span>
                {address}
            </div>
        </div>

        <div class="container info-container" style="height: 200px;">
            <span>Map</span>
            <div id="maploc" style="width: 100%; height: 100%; display: block;">
            </div>
        </div>             
        <div class="container info-container">
            <span>PIC</span>
            {pic}
            <div class="info">
                <i>(Phone: {pic_phone}, Email: {pic_email})</i>
            </div>
        </div>
        <div class="container info-container">
            <span>Description</span>
            {description}
        </div>
    
        <div class="container info-container">
        <span>Total Workorders</span>
        {workorders_count} ticket<br>
    </div>
    </div>
    <div id="list-wo" class="header-title" style="margin-top: 20px">History Workorders</div>
        <div style="margin: 10px 0px;">
        <div class="container" style="padding: 10px 10px;">

                    {woTpl}

        </div>
        </div>

</div>


