@extends("admin.layout.main")
@section('content')
            <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">{{$admin->name}}的角色列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="/admin/roles/{{$admin->id}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                @foreach($allRoles as $role)
                                <div class="checkbox">
    <label>
        <input type="checkbox" name="roles[]" @if($myRoles->contains($role)) checked @endif value="{{$role->id}}">{{$role->name}}
    </label>
</div>
                                @endforeach
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    @include("admin.layout.error")

                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- /.content -->
    @endsection
