@extends('layouts.app')

@section('title', 'Role')
@section('stylesheets')
<link href="{{asset('adminlte/component/dataTables/css/datatables.min.css')}}" rel="stylesheet">
@endsection
@push('breadcrump')
    <li class="active">Role</li>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Data Role</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            @if (in_array('create', $actionmenu))
            <a href="{{route('role.create')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah">
              <i class="fa fa-plus"></i>
            </a>
            @endif
            <a href="#" onclick="filter()" class="btn btn-default btn-sm" data-toggle="tooltip" title="Search">
                <i class="fa fa-search"></i>
              </a>
          </div>
          <!-- /. tools -->
        </div>
        <div class="box-body">
            <table class="table table-striped table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th width="100">Kode</th>
                        <th width="120">Nama</th>
                        <th width="100">Dibuat</th>
                        <th width="10">#</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="overlay hidden">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="add-filter" tabindex="-1" role="dialog"  aria-hidden="true" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pencarian</h4>
			</div>		
            <div class="modal-body">
                <form id="form-search" autocomplete="off">	
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="name">Kode</label>
                                <input type="text" name="name" class="form-control" placeholder="Kode">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="display_name">Nama</label>
                                <input type="text" name="display_name" class="form-control" placeholder="Nama">
                            </div>			
                        </div>
                    </div>   
                </form>
            </div>
            <div class="modal-footer">
                <button form="form-search" type="submit" class="btn btn-default" title="Apply"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('adminlte/component/dataTables/js/datatables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootbox/bootbox.min.js')}}"></script>
<script type="text/javascript">
function filter(){
    $('#add-filter').modal('show');
}
$(function(){
    dataTable = $('.datatable').DataTable( {
        stateSave:true,
        processing: true,
        serverSide: true,
        filter:false,
        info:false,
        lengthChange:true,
        responsive: true,
        order: [[ 4, "asc" ]],
        ajax: {
            url: "{{route('role.read')}}",
            type: "GET",
            data:function(data){
                var name = $('#form-search').find('input[name=name]').val();
                var display_name = $('#form-search').find('input[name=display_name]').val();
                data.name = name;
                data.display_name = display_name;
            }
        },
        columnDefs:[
            {
                orderable: false,targets:[0]
            },
            { className: "text-right", targets: [0] },
            { className: "text-center", targets: [4] },
            { render: function ( data, type, row ) {
                return `<div class="dropdown">
                    <button class="btn  btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @if(in_array('update', $actionmenu))
                        <li><a class="dropdown-item" href="{{url('role')}}/${row.id}/edit"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                        @endif
                        @if(in_array('read', $actionmenu))
                        <li><a class="dropdown-item" href="{{url('role/')}}/${row.id}"><i class="glyphicon glyphicon-info-sign"></i> Detail</a></li>
                        @endif
                        @if(in_array('delete', $actionmenu))
                        <li><a class="dropdown-item delete" href="#" data-id="${row.id}"><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
                        @endif
                    </ul></div>`
            },targets: [4]
            }
        ],
        columns: [
            { data: "no" },
            { data: "name" },
            { data: "display_name" },
            { data: "created_at" },
            { data: "id" },
        ]
    });
    $(".select2").select2();
    $('#form-search').submit(function(e){
        e.preventDefault();
        dataTable.draw();
        $('#add-filter').modal('hide');
    })
    $(document).on('click','.delete',function(){
        var id = $(this).data('id');
        bootbox.confirm({
			buttons: {
				confirm: {
					label: '<i class="fa fa-check"></i>',
					className: 'btn-danger'
				},
				cancel: {
					label: '<i class="fa fa-undo"></i>',
					className: 'btn-default'
				},
			},
			title:'Menghapus role?',
			message:'Data yang telah dihapus tidak dapat dikembalikan',
			callback: function(result) {
					if(result) {
						var data = {
                            _token: "{{ csrf_token() }}",
                            _method:'delete'
                        };
						$.ajax({
							url: `{{url('role')}}/${id}`,
							dataType: 'json', 
							data:data,
							type:'POST',
                            beforeSend:function(){
                                $('.overlay').removeClass('hidden');
                            }
                        }).done(function(response){
                            if(response.status){
                                $('.overlay').addClass('hidden');
                                $.gritter.add({
                                    title: 'Success!',
                                    text: response.message,
                                    class_name: 'gritter-success',
                                    time: 1000,
                                });
                                dataTable.ajax.reload( null, false );
                            }
                            else{
                                $.gritter.add({
                                    title: 'Warning!',
                                    text: response.message,
                                    class_name: 'gritter-warning',
                                    time: 1000,
                                });
                            }
                        }).fail(function(response){
                            var response = response.responseJSON;
                            $('.overlay').addClass('hidden');
                            $.gritter.add({
                                title: 'Error!',
                                text: response.message,
                                class_name: 'gritter-error',
                                time: 1000,
                            });
                        })		
					}
			}
		});
    })
})
</script>
@endpush