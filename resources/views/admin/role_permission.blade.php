@extends("admin.layout.main")
@section("content")
            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{$role->name}}的权限列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/admin/role/permissions/{{$role->id}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                @foreach($allPermissions as $permission)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" @if($role->hasPermission($permission)) checked @endif  name="permissions[]" value="{{$permission->id}}"> {{$permission->name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
    @endsection
