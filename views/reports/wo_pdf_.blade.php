<style>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .subtitle{font-family: "Times New Roman", Times, serif;font-size: 14;font-weight: bold; text-transform: uppercase;border: none;text-align:center;vertical-align:top;padding:3px 5px;}  
.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top;padding: 3px}
.page-break {
        page-break-after: always;
    }
.title{font-family: "Times New Roman", Times, serif;font-size: 30;text-transform: uppercase;border: none;text-align:center;vertical-align:top;padding:3px 5px;}    
    header { position: fixed; top: -10px; left: 80%; right: 0px;height: 30px; }
    footer { position: fixed; bottom: -60px; left: 70%; right: 0px; height: 50px; }
</style>

<body>
    <header>
      @if($data->owner->id==1)
        <img src="{{ public_path('images/logo_p1.jpeg') }}" style="height: 50">
      @else <img src="{{ public_path('images/logo_5mb.png') }}" style="height: 50px">
      @endif
    </header>
    <footer>{{ $data->owner->name }}</footer>

    <h2 class="title" style="padding-top: 200px">{{ $data->activity->name }} REPORT</h2>    
    <h2 class="title">{{ $data->service->name }}</h2>
    <h2 class="title">{{ $data->owner->name }}</h2>
    <div style="height:20px"></div>
    <h2 class="title">Nama Site</h2>
    <h2 class="title">{{ $data->site->name }}</h2>
        <div style="height:20px"></div>
    <h2 class="title">LINK ID SITE</h2>
    <h2 class="title">{{ $data->site->link_id }}</h2>
        <div class="page-break"></div>

    <table class="tg" style="table-layout: fixed; width: 100%;padding-top: 80px">
        <tr>
          <td class="tg-0pky" style="padding: 55px; padding-right: 220px" colspan="12">
            @if($data->owner->id==1)
              <img src="{{ public_path('images/logo_p1.jpeg') }}" style="height: 150">
            @else <img src="{{ public_path('images/logo_5mb.png') }}" style="height: 150px">
            @endif <br>{{ $data->owner->name }}<br> {{ $data->owner->address }}
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" style="height:10px;border: none"colspan="12"></td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="12">No Kontrak : 
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
                @if($detail->detail->name=='COF ID' && $detail->value<>''){{ $detail->value }}
                @elseif($detail->detail->name=='PO ID' && $detail->value<>'') {{ $detail->value }}
                @endif
            @endforeach
          @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="6">Identifikasi Dokumen</td>
          <td class="tg-0pky" colspan="6">No Dokumen</td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="6">{{ $data->activity->name }} REPORT</td>
          <td class="tg-0pky" colspan="6"></td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="2"></td>
          <td class="tg-0pky" colspan="2">Pelaksana</td>
          <td class="tg-0pky" colspan="2">Nama</td>
          <td class="tg-0pky" colspan="2">Jabatan</td>
          <td class="tg-0pky" colspan="2">Tanda Tangan</td>
          <td class="tg-0pky" colspan="2">Tanggal</td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="2">Dipersiapkan Oleh</td>
          <td class="tg-0pky" colspan="2">{{ $data->vendor->alias}}</td>
          <td class="tg-0pky" colspan="2">{{ $data->fieldtech->name}}</td>
          <td class="tg-0pky" colspan="2">
            @foreach($data->actions as $act)
              @if($act->status_id==1450){{ $act->createdBy->role->name}}
              @endif
            @endforeach  </td>
          <td class="tg-0pky" colspan="2"></td>
          <td class="tg-0pky" colspan="2"></td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="2">Diperiksa Oleh</td>
          <td class="tg-0pky" colspan="2">NOC</td>
          <td class="tg-0pky" colspan="2">
            @foreach($data->actions as $act)
              @if($act->status_id==1510){{ $act->createdBy->name}}
              @endif
            @endforeach  </td>
          <td class="tg-0pky" colspan="2">
            @foreach($data->actions as $act)
              @if($act->status_id==1510){{ $act->createdBy->role->name}}
              @endif
            @endforeach  </td>
          <td class="tg-0pky" colspan="2"></td>
          <td class="tg-0pky" colspan="2"></td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="2">Diketahui Oleh</td>
          <td class="tg-0pky" colspan="2">Project</td>
          <td class="tg-0pky" colspan="2">{{ $data->createdBy->name }}</td>
          <td class="tg-0pky" colspan="2">{{ $data->createdBy->role->name }}</td>
          <td class="tg-0pky" colspan="2"></td>
          <td class="tg-0pky" colspan="2"></td>
        </tr>
    </table>

    <div class="page-break"></div>

    <table class="tg" style="table-layout: fixed; width: 100%;padding-top: 80px">
      <tr>
        <td class="subtitle" colspan="12">General Site Information/Data Location</td>
      </tr>
      <tr>
        <td class="tg-0pky" style="border: none" colspan="12">Data Location</td>
      </tr>
      <tr>
        <td class="tg-0pky" style="font-weight: bold;text-align: center;" colspan="4">Items</td>
        <td class="tg-0pky" style="font-weight: bold;text-align: center;" colspan="8">Value</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">Nama Lokasi</td>
        <td class="tg-0pky" colspan="8">{{ $data->site->name }}</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">Alamat</td>
        <td class="tg-0pky" colspan="8">{{ $data->site->address }}</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">Latitude</td>
        <td class="tg-0pky" colspan="8">{{ $data->site->lat }}</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">Longitude</td>
        <td class="tg-0pky" colspan="8">{{ $data->site->long }}</td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">PIC di lokasi</td>
        <td class="tg-0pky" colspan="8">
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
                @if($detail->detail->name=='Name' && $detail->value<>''){{ $detail->value }}
                @elseif($detail->detail->name=='Name' && $detail->value=='') {{ $data->site->pic }}
                @endif
            @endforeach
          @endforeach
        </td>
      </tr>
      <tr>
        <td class="tg-0pky" colspan="4">Nomor Telepon</td>
        <td class="tg-0pky" colspan="8">
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
                @if($detail->detail->name=='Phone' && $detail->value<>''){{ $detail->value }}
                @elseif($detail->detail->name=='Phone' && $detail->value=='') {{ $data->site->pic_phone }}
                @endif
            @endforeach
          @endforeach
        </td>
      </tr>
      <tr>
        <td class="tg-0pky" style="height:5px;border: none" colspan="12"></td>
      </tr>
        <tr>
        <td class="tg-0pky" style="border: none" colspan="12">Electrical Condition</td>
      </tr>
      <tr>
        <td class="tg-0pky" style="text-align:center;vertical-align:top" colspan="12">Avaibility</td>
      </tr>
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
                 @if($detail->detail->group=='A. Availability')
                  <tr>
                    <td class="tg-0pky" colspan="4">{{ $detail->detail->name }}</td>
                    <td class="tg-0pky" colspan="8">{{ $detail->value }}</td>
                  </tr>
                @endif
            @endforeach
          @endforeach
      <tr>
        <td class="tg-0pky" style="text-align:center;vertical-align:top" colspan="12">Quality</td>
      </tr>
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
                 @if($detail->detail->group=='B. Quality')
                  <tr>
                    <td class="tg-0pky" colspan="4">{{ $detail->detail->name }}</td>
                    <td class="tg-0pky" colspan="8">{{ $detail->value }}</td>
                  </tr>
                @endif
            @endforeach
          @endforeach
    </table>

    <div class="page-break"></div>

    <table class="tg" style="table-layout: fixed; width: 100%;padding-top: 80px">
       <tr>
          <td class="subtitle" colspan="12">Data Implementation</td>
        </tr>
        <tr>
          <td class="tg-0pky" style="border: none" colspan="12">Service Data</td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">Items</td>
          <td class="tg-0pky" colspan="8">Description</td>
        </tr>
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                   @if($detail->detail->group=='B. Service Data')
                    <tr>
                      <td class="tg-0pky" colspan="4">{{ $detail->detail->name }}</td>
                      <td class="tg-0pky" colspan="8">{{ $detail->value }}</td>
                    </tr>
                  @endif
              @endforeach
            @endforeach
        <tr>
          <td class="tg-0pky" colspan="12">Equipment Data</td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">VSAT</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='D. VSAT'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">Antenna Location</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='C. Antenna Location' && $detail->detail->name=='Location'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Type</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='C. Antenna Location' && $detail->detail->name=='Type'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Pedestal Type</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='C. Antenna Location' && $detail->detail->name=='Pedestal Type'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">Indoor Unit Location</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='E. IDU' && $detail->detail->name=='Location'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Indoor Unit</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='E. IDU' && $detail->detail->name=='Indoor Unit'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Supporting Part</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='E. IDU' && $detail->detail->name=='Supporting Part'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">Outdoor Access Point #1</td>
          <td class="tg-0pky" colspan="8"></td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Location</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Location'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Type</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Type'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Range</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Range'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Audience</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Audience'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Security</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Security'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Duration Setting/Bandwith</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='F. ODU 1' && $detail->detail->name=='Duration / Bandwidth'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="4">Outdoor Access Point #2</td>
          <td class="tg-0pky" colspan="8"></td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Location</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Location'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Type</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Type'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Range</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Range'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Audience</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Audience'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Security</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Security'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
        <tr>
          <td class="tg-0pky"></td>
          <td class="tg-0pky" colspan="3">Duration Setting/Bandwith</td>
          <td class="tg-0pky" colspan="8">
            @foreach($data->actions as $act)
              @foreach($act->details as $detail)
                  @if($detail->detail->group=='G. ODU 2' && $detail->detail->name=='Duration / Bandwidth'){{ $detail->value }}
                  @endif
              @endforeach
            @endforeach
          </td>
        </tr>
    </table> 

    <div class="page-break"></div>
    
    <h2 class="subtitle" style="text-align: center;padding-top: 80px">Documentation Of Photos</h2>
    <h3 class="tg-0pky">Arrival</h3>  
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1310)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach

    <h3 class="tg-0pky" style="padding-top: 80px">Survey</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1320)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Devices Check</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1410)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach   

    <h3 class="tg-0pky" style="padding-top: 80px">Foundation</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1412)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Mounting</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1414)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Post Installation</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1416)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Pointing</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1420)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Pulling</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1430)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach 

    <h3 class="tg-0pky" style="padding-top: 80px">Indoor Installation</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1440)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach  

    <h3 class="tg-0pky" style="padding-top: 80px">Commisioning</h3>    
          <?php $count = 0; ?>  
          @foreach($data->actions as $act)
            @foreach($act->details as $detail)
              @foreach($detail->files as $files)
                  @if(substr($detail->detail_id, 0, 4)==1450)
                  <?php $count++ ?>
                      <table class="tg" style="table-layout: fixed; width: 100%;">
                        @if($count>1)
                      <tr><td class="tg-0pky" style="border: none;padding-top: 80px" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @else
                      <tr><td class="tg-0pky" style="border: none;" colspan="12"> {{ $detail->detail->name }}</td></tr>
                      @endif
                      <tr><td class="tg-0pky"colspan="12"> <img src="{{ public_path('storage/uploads/') }}{{ $files->filename }}" style="height: 500px;display: block;text-align:center;vertical-align:middle;max-width:100%;max-height:100%;"></td></tr>
                    </table>    
                    <div class="page-break"></div>              
                  @endif
              @endforeach
            @endforeach
          @endforeach   
    <table class="tg" style="table-layout: fixed; width: 100%;padding-top: 80px">
      <tr>
          <td class="tg-c3ow" colspan="12">Bill Of Quantity</td>
        </tr>
        <tr>
          <td class="tg-0pky">No</td>
          <td class="tg-0pky" colspan="3">Name</td>
          <td class="tg-0pky" colspan="3">Model</td>
          <td class="tg-0pky" colspan="2">Serial No</td>
          <td class="tg-0pky" colspan="3">Description</td>
        </tr>
        <tr>
          <td class="tg-0pky" colspan="12">A. Perangkat</td>
        </tr>
        <?php $count = 0; ?>
        @foreach($data->parts as $part)
        @if($part->type=="EQUIPMENT")
        <?php $count++ ?>
        <tr>
          <td class="tg-0pky">{{ $count }}.</td>
          <td class="tg-0pky" colspan="3">{{ $part->name }}</td>
          <td class="tg-0pky" colspan="3">{{ $part->model }}</td>
          <td class="tg-0pky" colspan="2">{{ $part->serial }}</td>
          <td class="tg-0pky" colspan="3">{{ $part->description }}</td>
        </tr>
        @endif
      @endforeach
        <tr>
          <td class="tg-0pky" colspan="12">B. Material</td>
        </tr>
        <?php $count = 0; ?>
        @foreach($data->parts as $part)
        @if($part->type=="MATERIAL")
        <?php $count++ ?>
        <tr>
          <td class="tg-0pky">{{ $count }}.</td>
          <td class="tg-0pky" colspan="3">{{ $part->name }}</td>
          <td class="tg-0pky" colspan="3">{{ $part->model }}</td>
          <td class="tg-0pky" colspan="2">{{ $part->serial }}</td>
          <td class="tg-0pky" colspan="3">{{ $part->description }}</td>
        </tr>
        @endif
      @endforeach      
    </table>                                                                                                         
</body>
